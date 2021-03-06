<?php

namespace App\Controller;

use ActivationsDB;
use ActivitesDB;
use App\Model\Entity\Activation;
use App\Model\Entity\Activite;
use App\Model\Entity\Destination;
use App\Model\Entity\Proposition;
use App\Model\Entity\PropositionReponse;
use DestinationsDB;
use FormulairesDB;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PropositionReponsesDB;
use PropositionsDB;
use QuestionsDB;
use VoyagesDB;
use ComptesDB;

require_once 'DBObjects/DestinationsDB.php';
require_once 'DBObjects/PropositionsDB.php';
require_once 'DBObjects/ActivitesDB.php';
require_once 'DBObjects/FormulairesDB.php';
require_once 'DBObjects/PropositionReponsesDB.php';
require_once 'Entity/PropositionReponse.php';
require_once 'Entity/Proposition.php';
require_once 'Entity/Activite.php';
require_once 'DBObjects/QuestionsDB.php';
require_once 'DBObjects/VoyagesDB.php';
require_once 'DBObjects/ComptesDB.php';

//require_once 'DBObjects/ActivationsDB.php';
require_once 'Controller/AppController.php';
require 'vendor/autoload.php';

class PropositionsController extends AppController
{
    private $questionDB;
    private $propositionDB;
    private $compteBD;
    private $activiteDB;
    private $formulaireDB;
    private $destinationDB;
    private $propositionReponseDB;
    private $voyageDB;

    public function __construct()
    {
        $this->questionDB = new QuestionsDB();
        $this->propositionDB = new PropositionsDB();
        $this->compteBD = new ComptesDB();
        $this->activiteDB = new ActivitesDB();
        $this->formulaireDB = new FormulairesDB();
        $this->destinationDB = new DestinationsDB();
        $this->propositionReponseDB = new PropositionReponsesDB();
        $this->voyageDB = new VoyagesDB();
    }

    public function index()
    {
        $this->isAuthorized(['admin', 'prof']);

        $connectedUser = $_SESSION["connectedUser"];
        $compteType = $connectedUser->getType();
        if ($compteType == 'prof') {
            $propositions = $this->propositionDB->getAllPropositionsForAccompagnateur($connectedUser->getIdCompte());
        } elseif ($compteType == 'admin') {
            $propositions = $this->propositionDB->getAllPropositions();
        }

        $this->set('propositions', $propositions);
    }

    public function add()
    {
        $this->isAuthorized(['admin', 'prof']);
        $destinations = $this->destinationDB->getAllActifDestinations();

        $questionsProposition = $this->formulaireDB->getQuestionsFromLatestFormulaire();
        if (empty($questionsProposition)) {
            $questionsProposition = array();
        }

        $categoriesProposition = array();
        foreach ($questionsProposition as $questionProposition) {
            if (!in_array($questionProposition->getCategorie(), $categoriesProposition)) {
                array_push($categoriesProposition, $questionProposition->getCategorie());
            }
        }
        $this->set('categoriesProposition', $categoriesProposition);
        $this->set('questionProposition', $questionsProposition);

        $this->set('destinations', $destinations);


        if (!empty($_POST) || !empty($_FILES)) {


            $connectedUser = $_SESSION["connectedUser"];
            $connectedUserId = $connectedUser->getIdCompte();

            $date_depart_str = $_POST['date_depart']['year'] . "-" . $_POST['date_depart']['month'] . "-" . $_POST['date_depart']['day'];
            $date_retour_str = $_POST['date_retour']['year'] . "-" . $_POST['date_retour']['month'] . "-" . $_POST['date_retour']['day'];

            $options = array('date_depart', 'date_retour');


            $pas31 = array(4, 6, 9, 11);

            foreach ($options as $option) {
                $days = array(30, 31);

                if (in_array($_POST[$option]['month'], $pas31) && ($_POST[$option]['day'] == 31)) {
                    $this->flashBad('La proposition n\'a pas pu être ajoutée. Mauvaise saisie de date.');
                    $this->flashBad('Attention, vous devez retéléverser les fichiers.');
                    return $this->redirect('Propositions', 'Add');
                }

                if (!$this->isLeap($_POST[$option]['year'])) {
                    array_push($days, 29);
                }

                if (($_POST[$option]['month'] == 2) && (in_array($_POST[$option]['day'], $days))) {
                    $this->flashBad('La proposition n\'a pas pu être ajoutée. Mauvaise saisie de date.');
                    $this->flashBad('Attention, vous devez retéléverser les fichiers.');
                    return $this->redirect('Propositions', 'Add');
                }

            }


            $date_depart = date("Y-m-d", strtotime($date_depart_str));
            $date_retour = date("Y-m-d", strtotime($date_retour_str));

            $date_now = date("Y-m-d");

            if ($date_retour < $date_now || $date_depart < $date_now) {
                $this->flashBad('Les dates doivent être dans le futur.');
                $this->flashBad('Attention, vous devez retéléverser les fichiers.');
                return $this->redirect("Propositions", "Add");
            }

            if ($date_retour < $date_depart) {
                $this->flashBad('La date de retour doit être après la date de départ.');
                $this->flashBad('Attention, vous devez retéléverser les fichiers.');
                return $this->redirect("Propositions", "Add");
            }


            $projet_depart = $date_depart;
            $projet_retour = $date_retour;

            $destination = $this->destinationDB->getDestinationFromId($_POST['id_destination']);


            $code = 4;
            if (isset($_POST['brouillon'])) {
                $code = 3;
            } else {
                $id = $this->propositionDB->getHighestid();
                $this->send_email('Propositions', 'View', $id);
            }

            $proposition = new Proposition(
                null,
                $connectedUserId,
                $_POST['nom_projet'],
                $_POST['ville'],
                null, //NUll à cause que les activités sont sauvegardées dans une autre table
                $date_depart,
                $date_retour,
                1,
                $code,
                null,
                $destination,
                $_POST['note']
            );

            $id_proposition = $this->propositionDB->addProposition($proposition);

            if ($id_proposition == null) {
                $this->flashBad("Une erreur est survenue lors de l'ajout de la proposition.");
                $this->flashBad('Attention, vous devez retéléverser les fichiers.');
                return $this->redirect("Propositions", "Add");
            }

            $ctr = 0;
            $whileSuccess = true;
            while (isset($_POST['endroit' . $ctr])) {
                $success = true;
                $date_depart = date("Y-m-d", strtotime($_POST['dateDepart' . $ctr]));
                $date_retour = date("Y-m-d", strtotime($_POST['dateRetour' . $ctr]));

                $activite = new Activite(
                    null,
                    $id_proposition,
                    $_POST['endroit' . $ctr],
                    $_POST['description' . $ctr],
                    $date_depart,
                    $date_retour
                );

                // retirer la verification pour permettre des acrtivités au dela des dâtes de du projet
                if ($date_retour < $date_now || $date_depart < $date_now) {
                    $whileSuccess = false;
                    $success = false;
                    $this->flashBad('Les dates des activités doivent être dans le futur.');
                } else if ($date_retour < $date_depart) {
                    $whileSuccess = false;
                    $success = false;
                    $this->flashBad('La date de retour d\'une activité doit être après la date de départ.');
                } else if ($date_depart < $projet_depart || $date_depart > $projet_retour) {
                    $whileSuccess = false;
                    $success = false;
                   $this->flashBad('La date d\'une activité doit être entre la date de départ et de fin d\'une activité.');
                } else if ($date_retour < $projet_depart || $date_retour > $projet_retour) {
                    $whileSuccess = false;
                    $success = false;
                    $this->flashBad('La date d\'une activité doit être entre la date de départ et de fin d\'une activité.');
                }

                if ($success) {
                    if (!$this->activiteDB->addActivite($activite)) {
                        $this->flashBad("Une erreur est survenue lors de l'ajout d'une activité.");
                        $this->flashBad('Attention, vous devez retéléverser les fichiers.');
                        return $this->redirect("Propositions", "Add");
                    }
                }
                $ctr++;
            }
            if (!$whileSuccess) {
                return $this->redirect("Propositions", "Add");
            }


            foreach ($questionsProposition as $question) {
                $proposition_reponse = new PropositionReponse(
                    $id_proposition,
                    $question,
                    null
                );

                if (!empty($_FILES[$question->getIdQuestion()]) && $question->getAffichage() === 'Fichier') {
                    //Liste des types autorisé
                    $allowed = array(
                        "jpg" => "image/jpg",
                        "jpeg" => "image/jpeg",
                        "png" => "image/png",
                        "pdf" => "application/pdf",
                        "txt" => "text/plain",
                        "docx" => "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
                        "zip" => "application/x-7z-compressed",
                        "rar" => "application/x-rar-compressed",
                        "xlsx" => "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                        "pptx" => "application/vnd.openxmlformats-officedocument.presentationml.presentation"
                    );

                    //Récupère les informations du fichier
                    $fileName = $_FILES[$question->getIdQuestion()]['name'];
                    $fileType = $_FILES[$question->getIdQuestion()]["type"];
                    $fileSize = $_FILES[$question->getIdQuestion()]["size"];
                    $uploadPath = 'Ressource/uploads/';
                    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                    $maxsize = 5 * 1024 * 1024;


                    if ($fileName != '') {
                        //Vérification du ficher téléversé
                        if (!array_key_exists($ext, $allowed) || !in_array($fileType, $allowed)) {
                            $this->flashBad('Le type de fichier de ' . $fileName . ' n\'est pas autorisé');
                            $this->flashBad('Attention, vous devez retéléverser les fichiers.');
                            return $this->redirect("Propositions", "Add");
                        }
                        if ($fileSize > $maxsize) {
                            $this->flashBad('La taille de ' . $fileName . ' dépasse la limite de 5 MB');
                            $this->flashBad('Attention, vous devez retéléverser les fichiers.');
                            return $this->redirect("Propositions", "Add");
                        }
                        $uploadFile = $uploadPath . $id_proposition . '-' . $question->getIdQuestion() . '-' . $fileName;
                        if ((file_exists($uploadFile))) {
                            $this->flashBad($fileName . ' existe déjà');
                            $this->flashBad('Attention, vous devez retéléverser les fichiers.');
                            return $this->redirect("Propositions", "Add");
                        }

                        //Supprime tous fichiers avec le même préfixe
                        $files = glob($uploadPath . $id_proposition . '-' . $question->getIdQuestion() . '-*/*');
                        foreach ($files as $file) {
                            unlink($file);
                        }

                        //Téléverse le ficher
                        if (!move_uploaded_file($_FILES[$question->getIdQuestion()]['tmp_name'], $uploadFile)) {
                            $this->flashBad($fileName . ' n\'a pas pu être déposé. Veuillez réessayer.');
                            $this->flashBad('Attention, vous devez retéléverser les fichiers.');
                            return $this->redirect("Propositions", "Add");
                        } else {
                            $proposition_reponse->setReponse($id_proposition . '-' . $question->getIdQuestion() . '-' . $fileName);

                            //Enregistre l’entité
                            if (!$this->propositionReponseDB->addPropositionReponse($proposition_reponse)) {
                                $this->flashBad("Une erreur est survenue lors de l'ajout des réponses aux renseignements supplémentaires.");
                                $this->flashBad('Attention, vous devez retéléverser les fichiers.');
                                return $this->redirect("Propositions", "Add");
                            }
                        }
                    }
                } elseif (isset($_POST[$question->getIdQuestion()])) {
                    $proposition_reponse->setReponse($_POST[$question->getIdQuestion()]);

                    //Enregistre l’entité
                    if (!$this->propositionReponseDB->addPropositionReponse($proposition_reponse)) {
                        $this->flashBad("Une erreur est survenue lors de l'ajout des réponses aux renseignements supplémentaires.");
                        $this->flashBad('Attention, vous devez retéléverser les fichiers.');
                        return $this->redirect("Propositions", "Add");
                    }
                } else {
                    $proposition_reponse->setReponse("");

                    //Enregistre l’entité
                    if (!$this->propositionReponseDB->addPropositionReponse($proposition_reponse)) {
                        $this->flashBad("Une erreur est survenue lors de l'ajout des réponses aux renseignements supplémentaires.");
                        $this->flashBad('Attention, vous devez retéléverser les fichiers.');
                        return $this->redirect("Propositions", "Add");
                    }
                }

            }

            if (!$whileSuccess) {
                return $this->redirect("Propositions", "Add");
            } else {
                $this->flashGood("La proposition à été enregistrée avec succès!");
                return $this->redirect("Propositions", 'Index');
            }

        }
    }

    public function edit($id_proposition = null)
    {

        $destinationDB = new DestinationsDB();
        $destinations = $destinationDB->getAllActifDestinations();

        $this->set('destinations', $destinations);

        $proposition = $this->propositionDB->getPropositionFromId($id_proposition);
        $activites = $this->activiteDB->getAllActivitesFromIdProposition($id_proposition);

        $proposition_reponses = $this->propositionReponseDB->getAllPropositionQuestionsFromIdProposition($id_proposition);

        if ($this->checkifValidOrNot($proposition)) {
            $this->propositionDB->setPropostionAPto0($id_proposition);
        }


        //Invert la liste pour l'avoir dans le bon sens
        if (empty($proposition_reponses)) {
            $proposition_reponses = array();
        }
        $proposition_reponses = array_reverse($proposition_reponses);

        $categories = array();
        foreach ($proposition_reponses as $proposition_reponse) {
            if (!in_array($proposition_reponse->getQuestion()->getCategorie(), $categories)) {
                array_push($categories, $proposition_reponse->getQuestion()->getCategorie());
            }
        }


        $this->set('activites', $activites);
        $this->set('proposition', $proposition);
        $this->set('proposition_reponses', $proposition_reponses);
        $this->set('categories', $categories);

        if (!empty($_POST) || !(empty($_FILES))) {

            $connectedUser = $_SESSION["connectedUser"];
            $connectedUserId = $connectedUser->getIdCompte();

            $date_depart_str = $_POST['date_depart']['year'] . "-" . $_POST['date_depart']['month'] . "-" . $_POST['date_depart']['day'];
            $date_retour_str = $_POST['date_retour']['year'] . "-" . $_POST['date_retour']['month'] . "-" . $_POST['date_retour']['day'];


            $options = array('date_depart', 'date_retour');


            $pas31 = array(4, 6, 9, 11);

            foreach ($options as $option) {
                $days = array(30, 31);

                if (in_array($_POST[$option]['month'], $pas31) && ($_POST[$option]['day'] == 31)) {
                    $this->flashBad('La proposition n\'a pas pu être modifiée. Mauvaise saisie de date.');
                    return $this->redirectParam1('Propositions', 'Edit', $id_proposition);
                }

                if (!$this->isLeap($_POST[$option]['year'])) {
                    array_push($days, 29);
                }

                if (($_POST[$option]['month'] == 2) && (in_array($_POST[$option]['day'], $days))) {
                    $this->flashBad('La proposition n\'a pas pu être modifiée. Mauvaise saisie de date.');
                    return $this->redirectParam1('Propositions', 'Edit', $id_proposition);
                }

            }

            $date_depart = date("Y-m-d", strtotime($date_depart_str));
            $date_retour = date("Y-m-d", strtotime($date_retour_str));

            $projet_depart = $date_depart;
            $projet_retour = $date_retour;

            $date_now = date("Y-m-d");

            if ($date_retour < $date_now || $date_depart < $date_now) {
                $this->flashBad('Les s doivent être dans le futur.');
                return $this->redirectParam1('Propositions', 'Edit', $id_proposition);
            }

            if ($date_retour < $date_depart) {
                $this->flashBad('La date de retour doit être après la date de départ.');
                return $this->redirectParam1('Propositions', 'Edit', $id_proposition);
            }
            if (($proposition->getApprouvee() != 1) && ($proposition->getApprouvee() != 2)) {
                $code = 4;
                if (isset($_POST['brouillon'])) {
                    $code = 3;
                } else {
                    if ($proposition->getApprouvee() == 3) {
                        $this->send_email('Propositions', 'View', $id_proposition);
                    }
                }
            } else {
                $code = $proposition->getApprouvee();
            }

            $destination = $this->destinationDB->getDestinationFromId($_POST['id_destination']);

            $proposition = new Proposition(
                $id_proposition,
                $connectedUserId,
                $_POST['nom_projet'],
                $_POST['ville'],
                null, //NUll à cause que les activités sont sauvegardées dans une autre table
                $date_depart,
                $date_retour,
                1,
                $code,
                null,
                $destination,
                $_POST['note']
            );


            if (!$this->propositionDB->updateProposition($proposition)) {
                $this->flashBad("Une erreur est survenue lors de la modification de la proposition.");
                return $this->redirectParam1("Propositions", "Edit", $id_proposition);
            }
            $ctr = 0;

            if (!$this->activiteDB->deleteActiviteWhereIdProposition($id_proposition)) {
                $this->flashBad("Une erreur est survenue lors de la modification de la proposition.");
                return $this->redirectParam1("Propositions", "Edit", $id_proposition);
            }

            while (isset($_POST['endroit' . $ctr])) {


                $date_depart = date("Y-m-d", strtotime($_POST['dateDepart' . $ctr]));
                $date_retour = date("Y-m-d", strtotime($_POST['dateRetour' . $ctr]));

                $activite = new Activite(
                    null,
                    $id_proposition,
                    $_POST['endroit' . $ctr],
                    $_POST['description' . $ctr],
                    $date_depart,
                    $date_retour
                );

                $error = false;
                if ($date_retour < $date_now || $date_depart < $date_now) {
                    $this->flashBad('Les dates des activités doivent être dans le futur.');
                    $error = true;
                }
                if ($date_retour < $date_depart) {
                    $this->flashBad('Les dates des activités doivent être dans le futur.');
                    $error = true;
                }

                if ($date_depart < $projet_depart || $date_depart > $projet_retour) {
                    $this->flashBad('La date d\'une activité doit être entre la date de départ et de fin d\'une activité.');
                    $error = true;
                }
                if ($date_retour < $projet_depart || $date_retour > $projet_retour) {
                    $this->flashBad('La date d\'une activité doit être entre la date de départ et de fin d\'une activité.');
                    $error = true;
                }
                if($error){
                    return $this->redirectParam1("Propositions", "Edit", $id_proposition);
                }



                if (!$this->activiteDB->addActivite($activite)) {
                    $this->flashBad("Une erreur est survenue lors de la modification  d'une activité");
                    return $this->redirectParam1("Propositions", "Edit", $id_proposition);
                }
                $ctr++;
            }

            foreach ($proposition_reponses as $proposition_reponse) {
                $question = $proposition_reponse->getQuestion();

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
                    $uploadPath = 'Ressource/uploads/';
                    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                    $maxsize = 5 * 1024 * 1024;

                    if ($fileName != '') {
                        //Vérification du ficher téléversé
                        if (!array_key_exists($ext, $allowed) || !in_array($fileType, $allowed)) {
                            $this->flashBad('Le type de fichier de ' . $fileName . ' n\'est pas autorisé.');
                            return $this->redirectParam1("Propositions", "Edit", $id_proposition);
                        }
                        if ($fileSize > $maxsize) {
                            $this->flashBad('La taille de ' . $fileName . ' dépasse la limite de 5 MB.');
                            return $this->redirectParam1("Propositions", "Edit", $id_proposition);
                        }
                        $uploadFile = $uploadPath . $id_proposition . '-' . $question->getIdQuestion() . '-' . $fileName;

                        $files = glob($uploadPath . $id_proposition . '-' . $question->getIdQuestion() . '-*/*');
                        foreach ($files as $file) {
                            unlink($file);
                        }


                        //Téléverse le ficher
                        if (!move_uploaded_file($_FILES[$question->getIdQuestion()]['tmp_name'], $uploadFile)) {
                            $this->flashBad($fileName . ' n\'a pas pu être déposé. Veuillez réessayer.');
                            return $this->redirectParam1("Propositions", "Edit", $id_proposition);
                        } else {
                            $proposition_reponse->setReponse($id_proposition . '-' . $question->getIdQuestion() . '-' . $fileName);

                            //Enregistre l’entité
                            if (!$this->propositionReponseDB->updatePropositionReponse($proposition_reponse)) {
                                $this->flashBad("Une erreur est survenue lors de la modification  des réponses aux renseignement supplémentaires.");
                                return $this->redirectParam1("Propositions", "Edit", $id_proposition);
                            }
                        }
                    }
                } elseif (isset($_POST[$question->getIdQuestion()])) {
                    $proposition_reponse->setReponse($_POST[$question->getIdQuestion()]);

                    //Enregistre l’entité
                    if (!$this->propositionReponseDB->updatePropositionReponse($proposition_reponse)) {
                        $this->flashBad("Une erreur est survenue lors de la modification  des réponses aux renseignement supplémentaires.");
                        return $this->redirectParam1("Propositions", "Edit", $id_proposition);
                    }
                } else {
                    $proposition_reponse->setReponse("");

                    //Enregistre l’entité
                    if (!$this->propositionReponseDB->updatePropositionReponse($proposition_reponse)) {
                        $this->flashBad("Une erreur est survenue lors de la modification  des réponses aux renseignement supplémentaires");
                        return $this->redirectParam1("Propositions", "Edit", $id_proposition);
                    }
                }
            }

            $this->flashGood("La proposition à été modifiée avec succès!");
            return $this->redirect("Propositions", 'Index');

        }
    }

    public function view($id_proposition = null)
    {


        $proposition = $this->propositionDB->getPropositionFromId($id_proposition);
        $proposition_reponses = $this->propositionReponseDB->getAllPropositionQuestionsFromIdProposition($id_proposition);


        if ($this->checkifValidOrNot($proposition)) {
            $this->propositionDB->setPropostionAPto0($id_proposition);
        }


        if (empty($proposition_reponses)) {
            $proposition_reponses = array();
        }
        //Invert la liste pour l'avoir dans le bon sens
        $proposition_reponses = array_reverse($proposition_reponses);

        $categories = array();
        foreach ($proposition_reponses as $proposition_reponse) {
            if (!in_array($proposition_reponse->getQuestion()->getCategorie(), $categories)) {
                array_push($categories, $proposition_reponse->getQuestion()->getCategorie());
            }
        }

        $activites = $this->activiteDB->getAllActivitesFromIdProposition($id_proposition);

        $compteDB = new \ComptesDB();
        $compteDemande = $compteDB->getCompteFromId($proposition->getIdCompte());

        $this->set('compteDemande', $compteDemande);
        $this->set('proposition', $proposition);
        $this->set('proposition_reponses', $proposition_reponses);
        $this->set('categories', $categories);
        $this->set('activites', $activites);
    }

    public function voyageFromProposition()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!empty($_POST["idProp_transform"])) {

                $proposition = $this->propositionDB->getPropositionFromId($_POST["idProp_transform"]);
                $compteDemande = $this->compteBD->getCompteFromId($proposition->getIdCompte());

                if ($this->propositionDB->acceptProposition($proposition)) {
                    $this->flashGood('La proposition à bien été acceptée.');
                    $this->send_emailResponse("Propositions","View",$proposition->getIdProposition(),$compteDemande->getCourriel());
                    return $this->redirect("Propositions", 'Index');

                } else {
                    $this->flashBad('Une erreur est survenue lors du traitement.');
                    return $this->redirect("Propositions", 'Index');
                }

            }

            if ((isset($_POST["idProp"]) && !empty($_POST["idProp"])) && (isset($_POST["idProp"]) && !empty($_POST["declineReason"]))) {
                $proposition = $this->propositionDB->getPropositionFromId($_POST["idProp"]);
                $compteDemande = $this->compteBD->getCompteFromId($proposition->getIdCompte());

                if ($this->propositionDB->refuseProposition($_POST["idProp"], $_POST["declineReason"])) {
                    $this->flashGood('La proposition à été refusée.');
                    $this->send_emailResponse("Propositions","View",$proposition->getIdProposition(),$compteDemande->getCourriel());
                    return $this->redirect("Propositions", 'Index');
                } else {
                    $this->flashBad('Une erreur est survenue lors du traitement.');
                    return $this->redirect("Propositions", 'Index');
                }

            }
            $this->flashBad('Une valeur était manquante.');
            return $this->redirect("Propositions", 'Index');

        }
    }


    public function send_email($controller, $action, $param1)
    {

        $url = 'https://international.silverph0ton.com/index.php?controller='. $controller . '&action=' . $action . '&param1=' . $param1;

        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host = 'topro1.fcomet.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';// Enable SMTP authentication
            $mail->Username = 'mobilite@silverph0ton.com';                     // SMTP username
            $mail->Password = '11qpVR^Ew.2]';                               // SMTP password
            // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port = 465;                                    // TCP port to connect to
            $mail->CharSet = 'UTF-8';
            //Recipients
            $mail->setFrom('mobilite@silverph0ton.com', 'Ressources Humaines');
            $mail->addAddress('mobilite@silverph0ton.com', 'Ressources Humaines');     // Add a recipient

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Une nouvelle proposition est disponible ';
            $mail->Body = 'Veuillez la consulter :  <b>' . $url . '</b>';

            if($mail->send()){
                return true;
            }else{
                return false;
            }

        } catch (Exception $e) {
            die("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }

         /*  mail('mobilite@silverph0ton.com',"Une nouvelle proposition est disponible", "Veuillez la consulter :" . $url , "From: mobilite@silverph0ton.com");*/

    }

    public function send_emailResponse($controller, $action,$id,$to)
    {

        $url = 'https://international.silverph0ton.com/index.php?controller=' . $controller . '&action=' . $action. '&param1='. $id;

        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host = 'topro1.fcomet.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';// Enable SMTP authentication
            $mail->Username = 'mobilite@silverph0ton.com';                     // SMTP username
            $mail->Password = '11qpVR^Ew.2]';                               // SMTP password
            // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port = 465;                                    // TCP port to connect to
            $mail->CharSet = 'UTF-8';
            //Recipients
            $mail->setFrom('mobilite@silverph0ton.com', 'Ressources Humaines');
            $mail->addAddress($to, '');     // Add a recipient

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Réponse à la proposition de séjour ';
            $mail->Body = 'Veuillez la consulter :  <b>' . $url . '</b>';

            if($mail->send()){
                return true;
            }else{
                return false;
            }

        } catch (Exception $e) {
            die("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }


    }

    public function checkifValidOrNot(Proposition $proposition)
    {
        if (($proposition->getApprouvee() != 1) && ($proposition->getApprouvee() != 2) && isOfType([ADMIN])) {
            return true;
        }
        return false;
    }


}
