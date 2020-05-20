<?php

namespace App\Controller;

//use ___DB;
//require_once 'DBObjects/___DB.php';
use App\Model\Entity\Categorie;
use App\Model\Entity\Question;
use CategoriesDB;
use QuestionsDB;

require_once 'DBObjects/QuestionsDB.php';
require_once 'DBObjects/CategoriesDB.php';
require_once 'Controller/AppController.php';
require_once 'Entity/Categorie.php';
require_once 'Entity/Question.php';


class QuestionsController extends AppController
{
    private $questionDB;
    private $categoriesDB;

    public function __construct()
    {
        $this->questionDB = new QuestionsDB();
        $this->categoriesDB = new CategoriesDB();
    }

    public function index()
    {
        //Vérification des permissions
        $this->isAuthorized(['admin']);

        $questionsPourEleve = $this->questionDB->getAllQuestionByRegroupement(0);
        $questionsPourProf = $this->questionDB->getAllQuestionByRegroupement(1);
        $questionsPourProfEleve = $this->questionDB->getAllQuestionByRegroupement(2);
        $questionsPourProposition = $this->questionDB->getAllQuestionByRegroupement(9);


        //Passe les variables à la vue
        $this->set('questionsPourEleve', $questionsPourEleve);
        $this->set('questionsPourProf', $questionsPourProf);
        $this->set('questionsPourProfEleve', $questionsPourProfEleve);
        $this->set('questionsPourProposition', $questionsPourProposition);

    }

    public function view($id = null)
    {
        //Vérification des permissions
        $this->isAuthorized(['admin']);

        //Requêtes au serveur SQL
        $question = $this->questionDB->getQuestionFromId($id);

        //Passe les variables à la vue
        $this->set('question', $question);
    }

    public function add($source = null) // $source = id_voyage si le controller est appellé depuis un formulaire
    {
        //Vérification des permissions
        $this->isAuthorized(['admin']);

        //Requêtes au serveur SQL
        $categories = $this->categoriesDB->getAllActifCategories();

        //Passe les variables à la vue
        $this->set('categories', $categories);

        //Gère la réponse de la vue
        if (!empty($_POST)) {

            //Remplis l’entité par assignation de masse
            if (isset($_POST['regroupement'])) {
                switch ($_POST['regroupement']) {
                    case 'etudiant':
                        $regroupement = 0;
                        break;
                    case 'prof':
                        $regroupement = 1;
                        break;
                    case 'prof_etu':
                        $regroupement = 2;
                        break;
                    case 'proposition':
                        $regroupement = 9;
                        break;
                }

            } else {
                $this->flashBad('Une erreur est survenu avec l\'ajout');
                return $this->redirect('Questions', 'Add');
            }

            $question = new Question(
                null,
                $this->categoriesDB->getCategorieFromId($_POST['id_categorie']),
                $_POST['question'],
                $_POST['list_option'],
                $_POST['affichage'],
                1,
                $_POST['info_sup'],
                $regroupement
            );


            //Enregistre l’entité
            if ($this->questionDB->addQuestion($question)) {
                if ($question->getAffichage() != 'Telechargement') {
                    $this->flashGood('La question a été enregistrée.');
                    if ($source != null) {
                        return $this->redirectParam1('VoyagesQuestions', 'index', $source);
                    } else {
                        return $this->redirect('Questions', 'index');
                    }
                } else {
                    if ($question->getAffichage() == 'Telechargement' && !empty($_FILES['file'])) {
                        $question->setIdQuestion($this->questionDB->getLastInsertedId());
                        //Liste des types autorisé
                        $allowed = array(
                            "jpg" => "image/jpg", "jpeg" => "image/jpeg",
                            "png" => "image/png", "pdf" => "application/pdf",
                            "txt" => "text/plain", "docx" => "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
                            "zip" => "application/x-7z-compressed", "rar" => "application/x-rar-compressed",
                            "xlsx" => "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "pptx" => "application/vnd.openxmlformats-officedocument.presentationml.presentation"
                        );

                        //Récupère les informations du fichier
                        $fileName = $_FILES['file']['name'];
                        $fileType = $_FILES['file']["type"];
                        $fileSize = $_FILES['file']["size"];
                        $uploadPath = 'Ressource/uploads/';
                        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                        $maxsize = 5 * 1024 * 1024;

                        //Vérification du ficher téléversé
                        if (!array_key_exists($ext, $allowed) || !in_array($fileType, $allowed)) {
                            $this->questionDB->deleteQuestion($question);
                            $this->flashBad('Le type de fichier de ' . $fileName . ' n\'est pas autorisé');
                            return $this->redirect('Questions', 'Add');
                        }
                        if ($fileSize > $maxsize) {
                            $this->questionDB->deleteQuestion($question);
                            $this->flashBad('La taille de ' . $fileName . ' dépasse la limite de 5 mb');
                            return $this->redirect('Questions', 'Add');
                        }

                        if ($fileName != '') {

                            //Téléverse le ficher
                            $uploadFile = $uploadPath . $question->getIdQuestion() . '-' . $fileName;
                            $question->setInputOption($question->getIdQuestion() . '-' . $fileName);
                            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
                                $this->questionDB->updateQuestion($question);
                                $this->flashGood('La question a été enregistrée.');
                                if ($source != null) {//Redirige à la page appropriée
                                    return $this->redirectParam1('VoyagesQuestions', 'index', $source);
                                }
                                return $this->redirect('Questions', 'index');
                            }
                            $this->questionDB->deleteQuestion($question);
                            $this->flashBad($question->getInputOption() . ' n\'a pas pu être déposé. Veuillez réessayer');
                            return $this->redirect('Questions', 'Add');
                        }
                        $this->questionDB->deleteQuestion($question);
                        $this->flashBad($fileName . ' n\'a pas pu être déposé. Veuillez réessayer');
                        return $this->redirect('Questions', 'Add');

                    }
                    $this->questionDB->deleteQuestion($question);
                    $this->flashBad('Problème lors de le téléversement du fichier');
                    return $this->redirect('Questions', 'Add');

                }

            }
            $this->flashBad('La question n\'a pas pu être enregistrée. Veuillez réessayer');
            return $this->redirect('Questions', 'index');
        }
    }

    public function edit($id = null, $source = null)
    {
        //Vérification des permissions
        $this->isAuthorized(['admin']);

        //Requêtes au serveur SQL
        $categories = $this->categoriesDB->getAllActifCategories();
        $question = $this->questionDB->getQuestionFromId($id);

        //Passe les variables à la vue
        $this->set('categories', $categories);
        $this->set('question', $question);

        //Gère la réponse de la vue
        if (!empty($_POST)) {

            //Remplis l’entité par assignation de masse
            if (isset($_POST['actif'])) {
                $actif = 1;
            } else {
                $actif = 0;
            }
            if (isset($_POST['regroupement'])) {
                switch ($_POST['regroupement']) {
                    case 'etudiant':
                        $regroupement = 0;
                        break;
                    case 'prof':
                        $regroupement = 1;
                        break;
                    case 'prof_etu':
                        $regroupement = 2;
                        break;
                    case 'proposition':
                        $regroupement = 9;
                        break;
                }
            }

            $question = new Question(
                $id,
                $this->categoriesDB->getCategorieFromId($_POST['id_categorie']),
                $_POST['question'],
                $_POST['input_option'],
                $_POST['affichage'],
                $actif,
                $_POST['info_sup'],
                $regroupement
            );

            if ($question->getAffichage() === 'Telechargement' && !empty($_FILES['file'])) {

                //Liste des types autorisé
                $allowed = array(
                    "jpg" => "image/jpg", "jpeg" => "image/jpeg",
                    "png" => "image/png", "pdf" => "application/pdf",
                    "txt" => "text/plain", "docx" => "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
                    "zip" => "application/x-7z-compressed", "rar" => "application/x-rar-compressed",
                    "xlsx" => "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "pptx" => "application/vnd.openxmlformats-officedocument.presentationml.presentation"
                );

                //Récupère les informations du fichier
                $fileName = $_FILES['file']['name'];
                $fileType = $_FILES['file']["type"];
                $fileSize = $_FILES['file']["size"];
                $uploadPath = 'Ressource/uploads/';
                $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                $maxsize = 5 * 1024 * 1024;

                //Vérification du ficher téléversé
                if (!array_key_exists($ext, $allowed) || !in_array($fileType, $allowed)) {
                    $this->flashBad('Le type de fichier de ' . $fileName . ' n\'est pas autorisé');
                    return $this->redirect('Questions', 'Edit', $question->getIdQuestion());
                }
                if ($fileSize > $maxsize) {
                    $this->flashBad('La taille de ' . $fileName . ' dépasse la limite de 5 mb');
                    return $this->redirect('Questions', 'Edit', $question->getIdQuestion());
                }
                $uploadFile = $uploadPath . $question->getIdQuestion() . '-' . $fileName;

                if ($fileName != '') {

                    //Supprime tous fichiers avec le même préfixe
                    $files = glob($uploadPath . $question->getIdQuestion() . '-*.*');
                    foreach ($files as $file) {
                        unlink($file);
                    }
                    $question->setInputOption($question->getIdQuestion() . '-' . $fileName);
                    //Téléverse le ficher
                    if (!move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
                        $this->flashBad($fileName . ' n\'a pas pu être déposé. Veuillez réessayer');
                        return $this->redirect('Questions', 'Edit', $question->getIdQuestion());
                    }
                }
            }

            //Enregistre l’entité
            if ($this->questionDB->updateQuestion($question)) {
                $this->flashGood('La question a été enregistrée.');

                //Redirige à la page appropriée
                if ($source != null) {
                    return $this->redirectParam1('VoyagesQuestions', 'index', $source);
                } else {
                    return $this->redirect('Questions', 'index');
                }
            }
            $this->flashBad('La question n\'a pas pu être enregistrée. Veuillez réessayer');
            return $this->redirect('Questions', 'Edit', $question->getIdQuestion());
        }
    }
}
