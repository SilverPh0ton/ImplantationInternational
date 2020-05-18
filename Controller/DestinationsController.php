<?php

namespace App\Controller;

use App\Model\Entity\Destination;
use DestinationsDB;
require_once 'DBObjects/DestinationsDB.php';
require_once 'Entity/Destination.php';
require_once 'Controller/AppController.php';

class DestinationsController extends AppController
{
    private $destinationDB;

    public function __construct()
    {
        $this->destinationDB = new DestinationsDB();
    }

    public function add()
    {
        $this->isAuthorized(['admin']);

        //Gère la réponse de la vue
        if (!empty($_POST)) {

            $nomPaysExiste = $this->destinationDB->destinationExist($_POST['nom_pays']);

            if($nomPaysExiste)
            {
                $this->flashBad('Cette destination existe déjà');
                return $this->redirect("Destinations", 'Add');
            }

            $destination = new Destination(
                null,
                $_POST['nom_pays'],
                1
            );


            //Enregistre l’entité
            if ($this->destinationDB->addDestination($destination)) {
                $this->flashGood('La destination a été enregistrée.');

                //Redirige à la page appropriée
                return $this->redirect('Configuration', 'index');
            }
            $this->flashBad('La destination n\'a pas pu être enregistrée. Veuillez réessayer.');
            return $this->redirect("Destinations", 'Add');
        }
    }

    public function edit($id = null)
    {
        $this->isAuthorized(['admin']);

        //Requêtes au serveur SQL
        $destination = $this->destinationDB->getDestinationFromId($id);

        //Passe les variables à la vue
        $this->set('destination',$destination);

        //Gère la réponse de la vue
        if (!empty($_POST)) {

            if (isset($_POST['actif'])) {
                $actif = 1;
            } else {
                $actif = 0;
            }

            $destination = new Destination(
                $id,
                $_POST['nom_pays'],
                $actif
            );

            //Enregistre l’entité
            if ($this->destinationDB->updateDestination($destination)) {
                $this->flashGood('La destination a été enregistrée.');

                //Redirige à la page appropriée
                return $this->redirect('Configuration',  'index');
            }
            $this->flashBad('La destination n\'a pas pu être enregistrée. Veuillez réessayer.');
            return $this->redirect('Configuration',  'index');
        }
    }
}
