<?php

namespace App\Controller;

use App\Model\Entity\Programme;
use ProgrammesDB;
require_once 'DBObjects/ProgrammesDB.php';
require_once 'Entity/Programme.php';
require_once 'Controller/AppController.php';

class ProgrammesController extends AppController
{
    private $programmeDB;

    public function __construct()
    {
        $this->programmeDB = new ProgrammesDB();
    }

    public function add()
    {
        //Vérification des permissions
        $this->isAuthorized(['admin']);

        //Gère la réponse de la vue
        if (!empty($_POST)) {

            $nomProgrammeExiste =  $this->programmeDB->programmeExist($_POST['nom_programme']);

            if ($nomProgrammeExiste) {
                $this->flashBad('Ce programme existe déjà.');
                return $this->redirect("Programmes", "Add");
            }

            $programme = new Programme(
                        null,
                            $_POST['nom_programme'],
                            1
            );

            //Enregistre l’entité
            if ($this->programmeDB->addProgramme($programme)) {
                $this->flashGood('Le programme a été enregistré.');

                //Redirige à la page appropriée
                return $this->redirect('Configuration', 'index');
            }
            $this->flashBad('Le programme n\'a pas pu être enregistré. Veuillez réessayer.');
            return $this->redirect("Programmes", "Add");
        }
    }

    public function edit($id = null)
    {

        //Vérification des permissions
        $this->isAuthorized(['admin']);

        //Requêtes au serveur SQL
        $programme = $this->programmeDB->getProgrammeFromId($id);

        //Passe les variables à la vue
        $this->set('programme',$programme);

        //Gère la réponse de la vue
        if (!empty($_POST)) {

            if (isset($_POST['actif'])) {
                $actif = 1;
            } else {
                $actif = 0;
            }

            //Remplis l’entité par assignation de masse
            $programme = new Programme(
                $id,
                $_POST['nom_programme'],
                $actif
            );

            //Enregistre l’entité
            if ($this->programmeDB->updateProgramme($programme)) {
                $this->flashGood('Le programme a été modifié.');

                //Redirige à la page appropriée
                return $this->redirect('Configuration', 'index');
            }
            $this->flashBad('Le programme n\'a pas pu être modifié. Veuillez réessayer.');
            return $this->redirect('Configuration', 'index');
        }
    }
}
