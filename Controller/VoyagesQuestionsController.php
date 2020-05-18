<?php

namespace App\Controller;

//use ___DB;
use App\Model\Entity\Categorie;
use App\Model\Entity\Destination;
use App\Model\Entity\Question;
use App\Model\Entity\Voyage;
use App\Model\Entity\VoyagesQuestion;
use CategoriesDB;
use QuestionsDB;
use VoyagesDB;
use VoyagesQuestionsDB;

require_once  'DBObjects/VoyagesDB.php';
require_once  'DBObjects/CategoriesDB.php';
require_once  'DBObjects/QuestionsDB.php';
require_once  'DBObjects/VoyagesQuestionsDB.php';

require_once 'Entity/Categorie.php';
require_once 'Entity/Question.php';
require_once 'Entity/Voyage.php';
require_once 'Entity/Destination.php';
require_once 'Entity/VoyagesQuestion.php';

require_once 'Controller/AppController.php';

class VoyagesQuestionsController extends AppController
{
    public function index($id_voyage = null)
    {
        //Vérification des permissions
        $this->isAuthorized(['admin','prof','etudiant']);

        $voyageDB = new VoyagesDB();
        $questionDB = new QuestionsDB();
        $voyagesQuestionsDB = new VoyagesQuestionsDB();

        //Requêtes au serveur SQL
        $questionsProf = $questionDB->getAllQuestionByTwoRegroupementAndActif(1,2, $id_voyage);
        $questionsEtu = $questionDB->getAllQuestionByTwoRegroupementAndActif(0,2, $id_voyage);

        $categoriesProf = array();
        foreach ($questionsProf as $questionProf)
        {
            if(!in_array($questionProf->getCategorie(), $categoriesProf))
            {
                array_push($categoriesProf, $questionProf->getCategorie());
            }
        }

        $categoriesEtu = array();
        foreach ($questionsEtu as $questionEtu)
        {
            if(!in_array($questionEtu->getCategorie(), $categoriesEtu))
            {
                array_push($categoriesEtu, $questionEtu->getCategorie());
            }
        }

        $voyage = $voyageDB->getVoyageFromId($id_voyage);

        $voyagesQuestionsProf = $voyagesQuestionsDB->getVoyagesQuestionsFromIdVoyageAndRegroupement($id_voyage, 1);
        $voyagesQuestionsEtu = $voyagesQuestionsDB->getVoyagesQuestionsFromIdVoyageAndRegroupement($id_voyage, 0);

        //Passe les variables à la vue
        $this->set('nom_projet', $voyage->getNomProjet());
        $this->set('categoriesProf', $categoriesProf);
        $this->set('categoriesEtu', $categoriesEtu);
        $this->set('listQuestionProf', $questionsProf);
        $this->set('listQuestionEtu', $questionsEtu);
        $this->set('voyagesQuestionsProf', $voyagesQuestionsProf);
        $this->set('voyagesQuestionsEtu', $voyagesQuestionsEtu);


        //Gère la réponse de la vue
        if (!empty($_POST)) {
            $sucess = true;

            //Remplis et enregistre des entités
            foreach ($questionsProf as $question) {

                if (isset($_POST['check_' . $question->getIdQuestion().'_1'])) {
                    $voyageQuestion = new VoyagesQuestion(
                        $id_voyage,
                        $question->getIdQuestion(),
                        $_POST['pour_prof_'.$question->getIdQuestion().'_1'],
                        $_POST['cat_order_'.$question->getIdQuestion().'_1'],
                        $_POST['order_'.$question->getIdQuestion().'_1']);
                    if (!$voyagesQuestionsDB->addVoyagesQuestions($voyageQuestion)) {
                        $sucess = false;
                    }
                } else {
                    $voyageQuestion = new VoyagesQuestion(
                        $id_voyage,
                        $question->getIdQuestion(),
                        1,
                        null,
                        null);
                    $voyagesQuestionsDB->deleteVoyagesQuestions($voyageQuestion);
                }
            }
            foreach ($questionsEtu as $question) {

                if (isset($_POST['check_' . $question->getIdQuestion().'_0'])) {
                    $voyageQuestion = new VoyagesQuestion(
                        $id_voyage,
                        $question->getIdQuestion(),
                        $_POST['pour_prof_'.$question->getIdQuestion().'_0'],
                        $_POST['cat_order_'.$question->getIdQuestion().'_0'],
                        $_POST['order_'.$question->getIdQuestion().'_0']);

                    if (!$voyagesQuestionsDB->addVoyagesQuestions($voyageQuestion)) {
                        $sucess = false;
                    }
                } else {
                    $voyageQuestion = new VoyagesQuestion(
                        $id_voyage,
                        $question->getIdQuestion(),
                        0,
                        null,
                        null);
                    $voyagesQuestionsDB->deleteVoyagesQuestions($voyageQuestion);
                }
            }

            if ($sucess) {
                $this->flashGood('Le formulaire a été enregistré.');

                //Redirige à la page appropriée
                return $this->redirectParam1('Voyages', 'Index', $id_voyage);
            }
            $this->flashBad('Le formulaire n\'a pas pu être enregistré. Veuillez réessayer');
            return $this->redirectParam1('VoyagesQuestions', 'Index', $id_voyage);
        }
    }
}
