<?php

namespace App\Controller;

use ActivationsDB;
use App\Model\Entity\ComptesVoyage;
use App\Model\Entity\Destination;
use App\Model\Entity\Voyage;
use ComptesVoyagesDB;
use DestinationsDB;
use VoyagesDB;
require_once 'DBObjects/VoyagesDB.php';
require_once 'DBObjects/ComptesVoyagesDB.php';
require_once 'DBObjects/ActivationsDB.php';
require_once 'DBObjects/DestinationsDB.php';
require_once 'Controller/AppController.php';
require_once 'Entity/Destination.php';
require_once 'Entity/Voyage.php';

class VoyagesController extends AppController
{
    public function index()
    {
        $this->isAuthorized(['admin','prof','etudiant']);

        $voyagesDB = new VoyagesDB();
        $comptesVoyagesDB = new ComptesVoyagesDB();

        $connectedUser = $_SESSION["connectedUser"];
        $connectedUserType = $connectedUser->getType();

        if($connectedUserType == 'admin')
        {
            $voyages = $voyagesDB->getAllVoyages();
        }
        else
        {
            $voyages = $comptesVoyagesDB->getVoyagesFromCompteId($connectedUser->getIdCompte());
        }

        $this->set('voyages',$voyages);


        if(!empty($_POST))
        {
            $activationsDB = new ActivationsDB();
            if(empty($_POST['code_activation']))
            {
                $this->flashBad("Veuillez entrer un code d'activation!");
                return $this->redirect("Voyages", "Index");
            }

            if($activationsDB->isValidCode($_POST['code_activation']))
            {
                if(!empty($activation = $activationsDB->getActivationFromCode($_POST['code_activation']))){

                    if (!$comptesVoyagesDB->compteVoyageExist($connectedUser->getIdCompte(), $activation->getVoyage()->getIdVoyage())) {
                        $compteVoyage = new ComptesVoyage(
                            $connectedUser->getIdCompte(),
                            $activation->getVoyage()->getIdVoyage(),
                            null
                        );

                        if ($comptesVoyagesDB->addCompteVoyage($compteVoyage)) {
                            $activationsDB->setActivationActif0or1($activation, 0);
                            $this->flashGood('Le voyage a été ajouté.');
                            return $this->redirect('voyages', 'index');
                        } else {
                            $this->flashBad('Erreur d\'association');
                            return $this->redirect('voyages', 'index');;
                        }
                    } else {
                        $this->flashBad('Vous faites déjà parti de ce voyage');
                        return $this->redirect('voyages', 'index');;
                    }
                }
                else{
                    $this->flashBad("Le code d'activation est invalide");
                    return $this->redirect('voyages', 'index');;
                }
            }
            else
            {
                $this->flashBad('Le code d\'activation est invalide');
                return $this->redirect('voyages','index');;
            }

        }
    }

    public function view($id = null)
    {
        $this->isAuthorized(['admin','prof','etudiant']);

        $voyageDB = new VoyagesDB();
        $comptesVoyagesDB = new ComptesVoyagesDB();

        $userCount = $comptesVoyagesDB->getUserCountByVoyageId($id);
        $voyage = $voyageDB->getVoyageFromId($id);

        $this->set('voyage',$voyage);
        $this->set('userCount',$userCount);

    }


    // THIS ISN'T CALLED ANYMORE
    // VOYAGES NEEDS TO BE CREATED THREW PROPOSITION
    public function add()
    {
        $this->isAuthorized(['admin','prof']);

        $connectedUser = $_SESSION["connectedUser"];

        $destinationDB = new DestinationsDB();
        $destinations = $destinationDB->getAllActifDestinations();

        $this->set('destinations',$destinations);

        if(!empty($_POST)) {

            $date_limite_str = $_POST['date_limite']['year'] . "-" . $_POST['date_limite']['month'] . "-" . $_POST['date_limite']['day'];
            $date_depart_str = $_POST['date_depart']['year'] . "-" . $_POST['date_depart']['month'] . "-" . $_POST['date_depart']['day'];
            $date_retour_str = $_POST['date_retour']['year'] . "-" . $_POST['date_retour']['month'] . "-" . $_POST['date_retour']['day'];

            $date_limite = date("Y-m-d",strtotime($date_limite_str));
            $date_depart = date("Y-m-d",strtotime($date_depart_str));
            $date_retour = date("Y-m-d",strtotime($date_retour_str));

            $date_now = date("Y-m-d");

            if ($date_retour < $date_now || $date_depart < $date_now || $date_limite < $date_now) {
                $this->flashBad('Les date doivent être dans le future');
                return $this->redirect('Voyages', 'Add');
            }

            if ($date_retour < $date_depart) {
                $this->flashBad('La date de retour doit être après la date de départ');
                return $this->redirect('Voyages', 'Add');
            }
            if ($date_depart < $date_limite) {
                $this->flashBad('La date de départ doit être après la date limite d\'inscription');
                return $this->redirect('Voyages', 'Add');
            }
            $voyageDB = new VoyagesDB();
            $compteVoyageDB = new ComptesVoyagesDB();

            $destination = $destinationDB->getDestinationFromId($_POST['id_destination']);

            $voyage = new Voyage(
                null,
                null,
                $_POST['ville'],
                $_POST['cout'],
                $date_depart,
                $date_limite,
                $date_retour,
                1,
                0,
                $destination,
                $_POST['nom_projet'],
                $_POST['note']);

            if ($voyageDB->addVoyage($voyage)) {
                $insertedVoyageId = $voyageDB->getLastInsertedId();
                $compteVoyage = new ComptesVoyage(
                    $connectedUser->getIdCompte(),
                    $insertedVoyageId,
                    null);
                if ($compteVoyageDB->addCompteVoyage($compteVoyage)) {
                    $this->flashGood('Le voyage été enregistrée.');
                    return $this->redirect('voyages', 'index');
                } else {
                    $this->flashBad('Le voyage n\'a pas pu être enregistrée . Veuillez réessayer');
                    return $this->redirect('Voyages', 'Add');
                }
            } else {
                $this->flashBad('Le voyage n\'a pas pu être enregistrée . Veuillez réessayer');
                return $this->redirect('Voyages', 'Add');
            }
        }
    }


    public function edit($id = null)
    {
        $this->isAuthorized(['admin','prof']);

        $destinationDB = new DestinationsDB();
        $destinations = $destinationDB->getAllActifDestinations();

        $voyageDB = new VoyagesDB();
        $voyage = $voyageDB->getVoyageFromId($id);


        $this->set('destinations',$destinations);
        $this->set('voyage',$voyage);


        if(!empty($_POST)) {


            $date_limite_str = $_POST['date_limite']['year'] . "-" . $_POST['date_limite']['month'] . "-" . $_POST['date_limite']['day'];
            $date_depart_str = $_POST['date_depart']['year'] . "-" . $_POST['date_depart']['month'] . "-" . $_POST['date_depart']['day'];
            $date_retour_str = $_POST['date_retour']['year'] . "-" . $_POST['date_retour']['month'] . "-" . $_POST['date_retour']['day'];

            $options = array('date_limite','date_depart','date_retour');


            $pas31 = array(4,6,9,11);

            foreach ($options as $option){
                $days = array(30,31);

                if(in_array($_POST[$option]['month'],$pas31) && ($_POST[$option]['day'] == 31)){
                    $this->flashBad('Le voyage n\'a pas pu être modifié. Mauvaise saisie de date.');
                    return $this->redirectParam1('Voyages', 'Edit', $id);
                }

                if(!$this->isLeap($_POST[$option]['year'])){
                    array_push($days,29);
                }

                if(($_POST[$option]['month'] == 2) && (in_array($_POST[$option]['day'],$days))){
                    $this->flashBad('Le voyage n\'a pas pu être modifié. Mauvaise saisie de date.');
                    return $this->redirectParam1('Voyages', 'Edit', $id);
                }

            }


            $date_limite = date("Y-m-d", strtotime($date_limite_str));
            $date_depart = date("Y-m-d", strtotime($date_depart_str));
            $date_retour = date("Y-m-d", strtotime($date_retour_str));


            $date_now = date("Y-m-d");

            if ($date_retour < $date_now || $date_depart < $date_now || $date_limite < $date_now) {
                $this->flashBad('Les date doivent être dans le future');
                return $this->redirectParam1('Voyages', 'Edit', $id);
            }

            if ($date_retour < $date_depart) {
                $this->flashBad('La date de retour doit être après la date de départ');
                return $this->redirectParam1('Voyages', 'Edit', $id);
            }
            if ($date_depart < $date_limite) {
                $this->flashBad('La date de départ doit être après la date limite d\'inscription');
                return $this->redirectParam1('Voyages', 'Edit', $id);
            }

            $destination = $destinationDB->getDestinationFromId($_POST['id_destination']);

            $voyage->setVille($_POST['ville']);
            $voyage->setCout($_POST['cout']);
            $voyage->setDateDepart($date_depart);
            $voyage->setDateLimite($date_limite);
            $voyage->setDateRetour($date_retour);
            $voyage->setDestination($destination);
            $voyage->setNomProjet($_POST['nom_projet']);
            $voyage->setNote($_POST['note']);
            $voyage->setActif(isset($_POST['actif'])?1:0);


            if ($voyageDB->updateVoyage($voyage)) {

                    $this->flashGood('Le voyage été modifié.');
                    return $this->redirect('voyages', 'index');
            } else {
                $this->flashBad('Le voyage n\'a pas pu être modifié . Veuillez réessayer');
                return $this->redirectParam1('Voyages', 'Edit', $id);
            }

        }


    }
}
