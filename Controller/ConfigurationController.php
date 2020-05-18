<?php

namespace App\Controller;

use App\Model\Entity\Categorie;
use App\Model\Entity\Destination;
use App\Model\Entity\Formulaire;
use App\Model\Entity\Programme;
use DestinationsDB;
use CategoriesDB;
use FormulairesDB;
use ProgrammesDB;
use QuestionsDB;

require_once 'DBObjects/DestinationsDB.php';
require_once 'DBObjects/CategoriesDB.php';
require_once 'DBObjects/ProgrammesDB.php';
require_once 'DBObjects/QuestionsDB.php';
require_once 'DBObjects/FormulairesDB.php';

require_once 'Entity/Programme.php';
require_once 'Entity/Categorie.php';
require_once 'Entity/Question.php';
require_once 'Entity/Destination.php';
require_once 'Controller/AppController.php';

class ConfigurationController extends AppController
{
    private $programmeDB;
    private $categoriesDB;
    private $destinationDB;
    private $questionDB;
    private $formulaireDB;

    public function __construct()
    {
       $this->programmeDB = new ProgrammesDB();
       $this->categoriesDB = new CategoriesDB();
       $this->destinationDB = new DestinationsDB();
       $this->questionDB = new QuestionsDB();
       $this->formulaireDB = new FormulairesDB();

    }

    public function index()
    {
        $this->isAuthorized(['admin']);

        $programmes = $this->programmeDB->getAllProgrammesWithInactive();
        $categories = $this->categoriesDB->getAllCategories();
        $destinations = $this->destinationDB->getAllDestinations();

        $questionsProposition = $this->questionDB->getAllQuestionForPropositionActif();

        $categoriesProposition = array();
        foreach ($questionsProposition as $questionProposition)
        {
            if(!in_array($questionProposition->getCategorie(), $categoriesProposition))
            {
                array_push($categoriesProposition, $questionProposition->getCategorie());
            }
        }

        $formulaireQuestions = $this->formulaireDB->getQuestionsFromLatestFormulaire();

        //Passe les variables à la vue
        $this->set('programmes',$programmes);
        $this->set('categories',$categories);
        $this->set('destinations',$destinations);

        $this->set('categoriesProposition', $categoriesProposition);
        $this->set('questionProposition', $questionsProposition);
        $this->set('questionFormulaire', $formulaireQuestions);

        if (!empty($_POST)) {
            $sucess = true;
            $formulaires = array();
            $formualaireDB = new FormulairesDB();
            foreach($questionsProposition as $questionProposition)
            {
                    $formulaire = new Formulaire(
                        $questionProposition->getIdQuestion(),
                        $_POST['order_'.$questionProposition->getIdQuestion()],
                        $_POST['cat_order_'.$questionProposition->getIdQuestion()]
                        );

                    if (isset($_POST['check_' . $questionProposition->getIdQuestion()])) {
                        array_push($formulaires, $formulaire);
                    }
            }
            if(!$formualaireDB->addFormulaires($formulaires))
            {
                $sucess = false;
            }

            if($sucess)
            {
                $this->flashGood('Le formulaire pour la proposition a été enregistré!');
                return $this->redirect("Configuration", "Index");
            }
            $this->flashBad('Il y a eu une erreur lors de l\'enregistrement du formulaire!');
            return $this->redirect("Configuration", "Index");

        }
    }
}
