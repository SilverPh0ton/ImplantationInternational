<?php

namespace App\Controller;

//use ___DB;
//require_once 'DBObjects/___DB.php';
use App\Model\Entity\Categorie;
use App\Model\Entity\Compte;
use App\Model\Entity\Destination;
use App\Model\Entity\Programme;
use App\Model\Entity\Question;
use App\Model\Entity\Valeur;
use App\Model\Entity\Voyage;
use App\Model\Entity\VoyagesQuestion;
use CategoriesDB;
use ComptesDB;
use ComptesVoyagesDB;
use QuestionsDB;
use ValeursDB;
use VoyagesDB;
use VoyagesQuestionsDB;

require_once 'Entity/Categorie.php';
require_once 'Entity/Compte.php';
require_once 'Entity/Destination.php';
require_once 'Entity/Programme.php';
require_once 'Entity/Question.php';
require_once 'Entity/Valeur.php';
require_once 'Entity/Voyage.php';
require_once 'Entity/VoyagesQuestion.php';

require_once  'DBObjects/ComptesVoyagesDB.php';
require_once  'DBObjects/VoyagesDB.php';
require_once  'DBObjects/ComptesDB.php';
require_once  'DBObjects/CategoriesDB.php';
require_once  'DBObjects/QuestionsDB.php';
require_once  'DBObjects/ValeursDB.php';
require_once  'DBObjects/VoyagesQuestionsDB.php';

require_once 'Controller/AppController.php';

class ValeursController extends AppController
{
    private $compteVoyageDB;
    private $voyageDB;
    private $compteDB;
    private $categorieDB;
    private $questionDB;
    private $valeursDB;
    private $voyageQuestionDB;

    public function __construct()
    {
        $this->compteVoyageDB = new ComptesVoyagesDB();
        $this->voyageDB = new VoyagesDB();
        $this->compteDB = new ComptesDB();
        $this->categorieDB = new CategoriesDB();
        $this->questionDB = new QuestionsDB();
        $this->valeursDB = new ValeursDB();
        $this->voyageQuestionDB = new VoyagesQuestionsDB();
    }

    public function index($id_voyage = null)
    {
        //Vérification des permissions
        $this->isAuthorized(['admin','prof']);

        if (isset($_SESSION["connectedUser"])) {
            $connectedUser = $_SESSION["connectedUser"];
            $compteType = $connectedUser->getType();
        }


        $allowedUser = $this->compteVoyageDB->getCompteVoyageFromIdCompteAndVoyage($id_voyage, $connectedUser->getIdCompte());

        if($compteType == 'etudiant' || ($compteType == 'prof' && !isset($allowedUser)))
        {
            $this->redirect("noauth", "accessDenied");
        }

        //Requêtes au serveur SQL
        $voyage = $this->voyageDB->getVoyageFromId($id_voyage);

        $compteIds = $this->compteVoyageDB->getEtuIdCompteFromIdVoyage($id_voyage);

        $comptes = array();
        foreach($compteIds as $compteId)
        {
            $compte = $this->compteDB->getCompteFromId($compteId);
            array_push($comptes, $compte);
        }

        //Passe les variables à la vue
        $this->set('nom_projet', $voyage->getNomProjet());
        $this->set('comptes',$comptes);
    }

    public function edit($id_voyage = null, $id_compte = null)
    {
        //Vérification des permissions
        $this->isAuthorized(['admin','prof','etudiant']);

        if (isset($_SESSION["connectedUser"])) {
            $connectedUser = $_SESSION["connectedUser"];
            $compteType = $connectedUser->getType();
        }

        $allowedUser = $this->compteVoyageDB->getCompteVoyageFromIdCompteAndVoyage($id_voyage, $connectedUser->getIdCompte());

        if(($compteType == 'etudiant' && $id_compte != $connectedUser->getIdCompte())|| ($compteType != 'admin' && !isset($allowedUser)))
        {
            $this->redirect("noauth", "accessDenied");
        }

        //Requêtes au serveur SQL

        $voyage = $this->voyageDB->getVoyageFromId($id_voyage);

        $compte = $this->compteDB->getCompteFromId($id_compte);

        if($compte->getType() == 'prof')
        {
            $regroupement = 1;
        }
        else
        {
            $regroupement = 0;
        }
        $regroupementBoth = 2;

        $voyagesQuestions = $this->voyageQuestionDB->getVoyageQuestionFromIdVoyageAndRegroupement($id_voyage, $regroupement, $regroupementBoth);

        $questions = array();
        foreach ($voyagesQuestions as $voyageQuestion)
        {
            $question = $this->questionDB->getQuestionFromId($voyageQuestion->getIdQuestion());
            array_push($questions, $question);
        }

        $valeurs = $this->valeursDB->getValeursFromCompteAndVoyage($id_compte, $id_voyage);

        $categories = array();
        foreach ($questions as $question)
        {
            $categorie = $question->getCategorie();
            if(!in_array($categorie, $categories))
            {
                array_push($categories, $categorie);
            }
        }

        //Passe les variables à la vue
        $this->set('nom_projet', $voyage->getNomProjet());
        $this->set('compte',$compte);
        $this->set('categories',$categories);
        $this->set('questions', $questions);
        $this->set('valeurs', $valeurs);

        //Gère la réponse de la vue
        if (!empty($_POST)||!empty($_FILES)) {
            $sucess = true;
            //Remplis et enregistre des entités
            foreach ($voyagesQuestions as $voyagesQuestion) {

                    $question = $this->questionDB->getQuestionFromId($voyagesQuestion->getIdQuestion());
                    $reponse = null;
                    $valeur = new Valeur(
                        $id_compte,
                        $id_voyage,
                        $voyagesQuestion->getIdQuestion(),
                        $reponse
                    );

                    if (!empty($_FILES[$question->getIdQuestion()]) && $question->getAffichage() === 'Fichier') {

                        //Liste des types autorisé
                        $allowed = array(
                            "jpg" => "image/jpg", "jpeg" => "image/jpeg",
                            "png" => "image/png", "pdf" => "application/pdf",
                            "txt" => "text/plain", "docx" => "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
                            "zip" => "application/x-7z-compressed", "rar" => "application/x-rar-compressed",
                            "xlsx" => "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "pptx" => "application/vnd.openxmlformats-officedocument.presentationml.presentation"
                        );

                        //Récupère les informations du fichier
                        $fileName = $_FILES[$question->getIdQuestion()]['name'];
                        $fileType = $_FILES[$question->getIdQuestion()]["type"];
                        $fileSize = $_FILES[$question->getIdQuestion()]["size"];
                        $uploadPath = './Ressource/uploads/';
                        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                        $maxsize = 5 * 1024 * 1024;

                        //Vérification du ficher téléversé
                        if (!array_key_exists($ext, $allowed) || !in_array($fileType, $allowed)) {
                            $this->flashBad('Le type de fichier de ' . $fileName . ' n\'est pas autorisé');
                            return $this->redirectParam2($id_voyage, $id_compte);
                        }
                        if ($fileSize > $maxsize) {
                            $this->flashBad('La taille de ' . $fileName . ' dépasse la limite de 5 mb');
                            return $this->redirectParam2($id_voyage, $id_compte);
                        }
                        $uploadFile = $uploadPath . $id_voyage . '-' . $question->getIdQuestion() . '-' . $id_compte . '-' . $fileName;

                        if ($fileName != '') {

                            //Supprime tous fichiers avec le même préfixe
                            $files = glob($uploadPath . $id_voyage . '-' . $question->getIdQuestion() . '-' . $id_compte . '-*');
                            foreach ($files as $file) {
                                unlink($file);
                            }

                            //Téléverse le ficher
                            if (!move_uploaded_file($_FILES[$question->getIdQuestion()]['tmp_name'], $uploadFile)) {
                                $sucess = false;
                            } else {
                                $valeur->setReponse($id_voyage . '-' . $question->getIdQuestion() . '-' . $id_compte . '-' . $fileName);

                                //Enregistre l’entité
                                if (!$this->valeursDB->saveValeur($valeur)) {
                                    $sucess = false;
                                }
                            }
                        }
                    } elseif (isset($_POST[$question->getIdQuestion()])) {
                        $valeur->setReponse($_POST[$question->getIdQuestion()]);

                        //Enregistre l’entité
                        if (!$this->valeursDB->saveValeur($valeur)) {
                            $sucess = false;
                        }
                    }

                    //Supprime les enregistrement de type case à cocher si on n'a pas recu de post car cela veux dire qu'elle n'étais pas selectioné
                    if (empty($_POST[$question->getIdQuestion()]) && $question->getAffichage()!= "Fichier") {
                        $this->valeursDB->deleteValeur($connectedUser->getIdCompte(), $id_voyage, $question->getIdQuestion());
                    }

                }


                if ($sucess) {
                    $this->flashGood('Le formulaire a été enregistré.');

                    //Redirige à la page approprié
                    return $this->redirectParam1('voyages', 'index', $id_voyage);
                }
                $this->flashBad('Le formulaire n\'a pas pu être enregistré. Veuillez réessayer');
                return $this->redirectParam2($id_voyage, $id_compte);

            }

    }
}
