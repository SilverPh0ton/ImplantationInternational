<?php

namespace App\Controller;

use ActivationsDB;
use App\Model\Entity\Activation;
use VoyagesDB;

require_once 'DBObjects/ActivationsDB.php';
require_once 'DBObjects/VoyagesDB.php';
require_once 'Controller/AppController.php';
require_once 'Entity/Activation.php';

class ActivationsController extends AppController
{
    public function index($id_voyage = null)
    {
        $this->isAuthorized(['admin','prof']);

        $voyageDB = new VoyagesDB();
        $voyage = $voyageDB->getVoyageFromId($id_voyage);

        $activationDB = new ActivationsDB();
        $activations = $activationDB->getActivationFromIdVoyage($id_voyage);

        $this->set('acti_array',$activations);
        $this->set('nom_projet',$voyage->getNomProjet());
    }

    public function add($id_voyage = null)
    {
        $this->isAuthorized(['admin','prof']);
        $this->set('id_voyage',$id_voyage);

        if(!empty($_POST))
        {
            if (isset($_POST['nbr_code'])) {
                $nbrCode = $_POST['nbr_code'];
            } else {
                $nbrCode = 0;
            }
            //Crée un array de données
            $activationDB = new ActivationsDB();

            $voyageDB = new VoyagesDB();
            $voyage = $voyageDB->getVoyageFromId($id_voyage);

            $success = true;
            for ($x = 0; $x < $nbrCode; $x++) {

                $activation = new Activation(
                    null,
                    sprintf('%04X-%04X-%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535)),
                        $voyage,
                    1
                );

                    if(!$activationDB->addActivation($activation))
                    {
                        $success = false;
                    }
            }

            if ($success) {
                $this->flashGood('Les codes ont été générés');
                return $this->redirectParam1('activations', 'index', $id_voyage);
            }
            $this->flashBad('Les codes n\'ont pas pu être générés. Veuillez réessayer');


        }
    }
}
