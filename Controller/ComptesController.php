<?php
/**
 * @var \App\Model\Entity\Compte $connectedUser
 */

namespace App\Controller;

use App\Model\Entity\Compte;
use App\Model\Entity\Programme;
use ComptesDB;
use ComptesVoyagesDB;
use ProgrammesDB;
use VoyagesDB;
use DateTime;

require_once 'DBObjects/ComptesDB.php';
require_once 'DBObjects/ComptesVoyagesDB.php';
require_once 'DBObjects/ProgrammesDB.php';
require_once 'DBObjects/VoyagesDB.php';
require_once 'Controller/AppController.php';

define("AGE_MIN", 15);
define("AGE_MAX", 89);

class ComptesController extends AppController
{
    private $comptesDB;
    private $comptesVoyageDB;
    private $programmeDB;
    private $voyageDB;

    public function __construct()
    {
        $this->comptesDB = new ComptesDB();
        $this->comptesVoyageDB = new ComptesVoyagesDB();
        $this->programmeDB = new ProgrammesDB();
        $this->voyageDB = new VoyagesDB();
    }

    public function index()
    {
        if (isset($_SESSION["connectedUser"])) {
            $connectedUser = $_SESSION["connectedUser"];
            $compteType = $connectedUser->getType();
        }

        //Vérification des permissions
        $this->isAuthorized(['admin', 'prof']);

        $array_comptes = array();
        //Requêtes au serveur SQL
        if ($compteType === 'prof') {

            $usersId = $this->comptesVoyageDB->getEtuIdsFromProfId($connectedUser->getIdCompte());
            foreach ($usersId as $userId) {
                $compteEtu = $this->comptesDB->getCompteFromId($userId);
                array_push($array_comptes, $compteEtu);
            }

        } else if ($compteType === 'admin') {
            $array_comptes = $this->comptesDB->getAllComptes();
        }

        //Passe les variables à la vue
        $this->set('comptes', $array_comptes);
    }

    public function view($id = null)
    {
        if (isset($_SESSION["connectedUser"])) {
            $connectedUser = $_SESSION["connectedUser"];
            $compteType = $connectedUser->getType();
        }

        //Vérification des permissions
        $this->isAuthorized(['admin', 'prof', 'etudiant']);


        if ($compteType === 'etudiant' && $id != $connectedUser->getIdCompte()) {
            return $this->redirectParam1('Noauth', 'AccessDenied', $id);
        }
        if ($compteType === 'prof') {

            $students = $this->comptesVoyageDB->getEtuIdsFromProfId($connectedUser->getIdCompte());

            if ($id !== $connectedUser->getIdCompte() && !in_array($id, $students)) {
                return $this->redirect('Noauth', 'AccessDenied');
            }
        }

        $compte = $this->comptesDB->getCompteFromId($id);
        $listVoyage = $this->voyageDB->getVoyageForId($id);


        //Passe les variables à la vue
        $this->set('compte', $compte);
        $this->set('listVoyage', $listVoyage);


    }

    public function edit($id = null)
    {
        if (isset($_SESSION["connectedUser"])) {
            $connectedUser = $_SESSION["connectedUser"];
            $compteType = $connectedUser->getType();
        }

        //Vérification des permissions
        $this->isAuthorized(['admin', 'prof', 'etudiant']);

        if ($compteType !== 'admin') {
            if ($id !== $connectedUser->getIdCompte()) {
                return $this->redirect('Noauth', 'AccessDenied');
            }
        }

        $programmes = $this->programmeDB->getAllProgrammes();
        $compte = $this->comptesDB->getCompteFromId($id);

        //Passe les variables à la vue
        $this->set('array_prog', $programmes);
        $this->set('compte', $compte);

        if (isset($_POST['promote'])) {
            if ($_POST['promote'] == "true") {
                if ($this->comptesDB->promoteUserToProf($id)) {
                    $this->flashGood("L'utilisateur sélecionné a été promu accompagnateur avec succès!");
                    return $this->redirectParam1('Comptes', 'index', $id);
                }
                $this->flashBad("Une erreur est survenu lors de la promotion");
                return $this->redirectParam1('Comptes', 'index', $id);
            }
            $this->flashBad("Une erreur est survenu lors de la promotion");
            return $this->redirectParam1('Comptes', 'index', $id);
        }

        //Gère la réponse de la vue
        if (!empty($_POST)) {

            //Vérification des données reçue de la vue
            if (isset($_POST['mot_de_passe'])) {
                if ($_POST['mot_de_passe'] !== $_POST['mot_de_passe_confirme']) {
                    $this->flashBad('Les mots de passe ne correspondent pas');
                    return $this->redirectParam1("Comptes", "Edit", $id);
                }

                if ($this->comptesDB->updateMDP($id, $_POST['mot_de_passe'])) {
                    $this->flashGood('Les modifications de mot de passe ont été enregistrées.');

                    //Redirige à la page approprié
                    return $this->redirectParam1('Comptes', 'view', $id);
                }
                $this->flashBad('Les modifications de mot de passe n\'ont pas pu être enregistrées. Veuillez réessayer');
                return $this->redirectParam1("Comptes", "Edit", $id);

            }
            if (isset($_POST['pseudo'])) {
                $pseudoExiste = $this->comptesDB->pseudoExist($_POST['pseudo'], $compte->getIdCompte());

                if ($pseudoExiste) {
                    $this->flashBad('Ce nom d\'utilisateur existe déjà');
                    return $this->redirectParam1("Comptes", "Edit", $id);
                }


                $compte->setPseudo($_POST['pseudo']);
                $compte->setCourriel($_POST['courriel']);
                $compte->setNom($_POST['nom']);
                $compte->setPrenom($_POST['prenom']);
                $date_naissance_str = $_POST['date_naissance']['year'] . "-" . $_POST['date_naissance']['month'] . "-" . $_POST['date_naissance']['day'];

                $pas31 = array(4, 6, 9, 11);

                $days = array(30, 31);

                if (in_array($_POST['date_naissance']['month'], $pas31) && ($_POST['date_naissance']['day'] == 31)) {
                    $this->flashBad('Le compte n\'a pas pu être modifié. Mauvaise saisie de date.');
                    return $this->redirectParam1('Comptes', 'Edit', $id);
                }

                if (!$this->isLeap($_POST['date_naissance']['year'])) {
                    array_push($days, 29);
                }

                if (($_POST['date_naissance']['month'] == 2) && (in_array($_POST['date_naissance']['day'], $days))) {
                    $this->flashBad('Le compte n\'a pas pu être modifié. Mauvaise saisie de date.');
                    return $this->redirectParam1('Comptes', 'Edit', $id);
                }

                $date_naissance = date("Y-m-d", strtotime($date_naissance_str));
                $age = date_diff(date_create($date_naissance), new DateTime());

                if ($age->y <= AGE_MIN) {
                    $this->flashBad('La compte n\'a pas pu être modifié. La personne doit être agée d\'au moins 15 ans.');
                    return $this->redirectParam1('Comptes', 'Edit', $id);
                }
                elseif ($age->y >= AGE_MAX) {
                    $this->flashBad('La compte n\'a pas pu être modifié. La personne ne peut être agée de 90 ans ou plus.');
                    return $this->redirectParam1('Comptes', 'Edit', $id);
                }

                $compte->setDateNaissance($date_naissance);
                $compte->setTelephone($_POST['telephone']);
                $compte->setType($_POST['type']);
                $compte->setActif(isset($_POST['actif']) ? 1 : 0);


                $programme = $this->programmeDB->getProgrammeFromNom($_POST['id_programme']);
                $compte->setProgramme($programme);


                //Enregistre l’entité
                if(!$this->comptesDB->pseudoExist($compte->getPseudo(),$compte->getIdCompte()))
                {
                    if ($this->comptesDB->updateCompte($compte)) {
                        $this->flashGood('Les modifications du compte ont été enregistrées.');

                        //Redirige à la page approprié
                        if ($connectedUser->getType() === 'etudiant') {
                            return $this->redirectParam1('Comptes', 'view', $id);
                        } else {
                            return $this->redirect('Comptes', 'index');
                        }

                    }
                }
                else
                {
                    $this->flashBad('Le nom d\'utilisateur existe déjà');
                    return $this->redirectParam1("Comptes", "Edit", $id);
                }

                $this->flashBad('Les modifications du compte n\'ont pas pu être enregistrées. Veuillez réessayer');
                return $this->redirectParam1("Comptes", "Edit", $id);
            }
        }
    }

    public function login()
    {
        //Gère la réponse de la vue
        if (!empty($_POST)) {

            $tempUser = $this->comptesDB->getCompteFromPseudoAndMDP($_POST['pseudo'], $_POST['mot_de_passe']);
            //Vérifie l'identité du compte
            if (isset($tempUser)) {
                if ($tempUser->getActif() == 1) {
                    $_SESSION["connectedUser"] = $tempUser;
                    $this->redirect('voyages', 'index');

                } else {
                    $this->flashBad('Votre compte est desactivé');
                    $this->redirect('Comptes', 'Login');
                }
            } else {
                $this->flashBad('Votre nom d\'utilisateur ou mot de passe est incorrect');
                $this->redirect('Comptes', 'Login');
            }

        }
    }

    public function logout()
    {
        $this->flashGood('Vous êtes déconnecté');
        unset($_SESSION['connectedUser']);
        $this->redirect('comptes', 'login');
    }

    public function add()
    {
        //Vérification des permissions
        $this->isAuthorized(['admin']);

        $programmes = $this->programmeDB->getAllProgrammes();

        $this->set('array_prog', $programmes);

        //Gère la réponse de la vue
        if (!empty($_POST)) {

            //Vérification des données reçue de la vue
            if (!isset($_POST['mot_de_passe']) || !isset($_POST['mot_de_passe_confirme']) || !($_POST['mot_de_passe'] === $_POST['mot_de_passe_confirme'])) {
                $this->flashBad('Les mots de passe ne correspondent pas');
                return $this->redirect("Comptes", "Add");
            }

            $pseudoExiste = $this->comptesDB->pseudoExistOnlyPseudo($_POST['pseudo']);

            if ($pseudoExiste) {
                $this->flashBad('Ce nom d\'utilisateur existe déjà');
                return $this->redirect("Comptes", "Add");
            }

            $date_naissance_str = $_POST['date_naissance']['year'] . "-" . $_POST['date_naissance']['month'] . "-" . $_POST['date_naissance']['day'];

            $pas31 = array(4, 6, 9, 11);

            $days = array(30, 31);

            if (in_array($_POST['date_naissance']['month'], $pas31) && ($_POST['date_naissance']['day'] == 31)) {
                $this->flashBad('Le compte n\'a pas pu être ajouté. Mauvaise saisie de date.');
                return $this->redirect('Comptes', 'Add');
            }

            if (!$this->isLeap($_POST['date_naissance']['year'])) {
                array_push($days, 29);
            }

            if (($_POST['date_naissance']['month'] == 2) && (in_array($_POST['date_naissance']['day'], $days))) {
                $this->flashBad('La compte n\'a pas pu être ajouté. Mauvaise saisie de date.');
                return $this->redirect('Comptes', 'Add');
            }

            $date_naissance = date("Y-m-d", strtotime($date_naissance_str));
            $age = date_diff(date_create($date_naissance), new DateTime());

            if ($age->y <= AGE_MIN) {
                $this->flashBad('La compte n\'a pas pu être ajouté. La personne doit être agée d\'au moins 15 ans.');
                return $this->redirect('Comptes', 'Add');
            }
            elseif ($age->y >= AGE_MAX) {
                $this->flashBad('La compte n\'a pas pu être ajouté. La personne ne peut être agée de 90 ans ou plus.');
                return $this->redirect('Comptes', 'Add');
            }

            $programme = $this->programmeDB->getProgrammeFromId($_POST['id_programme']);


            //Remplis l’entité par assignation de masse
            $compte = new Compte(
                null,
                $_POST['pseudo'],
                $_POST['mot_de_passe'],
                $_POST['select_type_acc'],
                $_POST['actif'],
                $_POST['courriel'],
                $_POST['nom'],
                $_POST['prenom'],
                $date_naissance,
                $_POST['telephone'],
                $programme
            );

            //Enregistre l’entité
            if ($this->comptesDB->addCompte($compte)) {
                $this->flashGood('Le compte a été créé.');

                //Redirige à la page approprié
                return $this->redirect('comptes', 'index');

            }
            $this->flashBad('Le compte n\'a pas pu être créé. Réessayer plus tard.');
            return $this->redirect("Comptes", "Add");
        }
    }

}
