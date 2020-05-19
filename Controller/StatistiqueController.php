<?php

namespace App\Controller;

use ActivationsDB;
use App\Model\Entity\ComptesVoyage;
use App\Model\Entity\Destination;
use App\Model\Entity\Voyage;
use App\Model\Entity\Compte;
use ComptesVoyagesDB;
use DestinationsDB;
use VoyagesDB;
use ComptesDB;
require_once 'DBObjects/ComptesDB.php';
require_once 'DBObjects/VoyagesDB.php';
require_once 'DBObjects/ComptesVoyagesDB.php';
require_once 'DBObjects/ActivationsDB.php';
require_once 'DBObjects/DestinationsDB.php';
require_once 'Controller/AppController.php';
require_once 'Entity/Destination.php';
require_once 'Entity/Voyage.php';
require_once 'Entity/Compte.php';


class StatistiqueController extends AppController
{

    public function index()
    {
      $this->isAuthorized(['admin','prof','etudiant']);

      $voyagesDB = new VoyagesDB();
      $comptesVoyagesDB = new ComptesVoyagesDB();

      $connectedUser = $_SESSION["connectedUser"];
      $connectedUserType = $connectedUser->getType();

      $voyages = $voyagesDB->getAllVoyages();
      $this->set('voyages',$voyages);

      //Number of people trips
      $compteDB = new ComptesDB();
      $compteStats = $compteDB->getAllUsers();
      $this->set('compteStats',$compteStats);

      //Number of destination
      $voyagesStats = $comptesVoyagesDB->getAllTrips();
      $this->set('voyagesStats',$voyagesStats);

    }
}
