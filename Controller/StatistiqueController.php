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
      $this->isAuthorized(['admin']);

      $voyagesDB = new VoyagesDB();
      $comptesVoyagesDB = new ComptesVoyagesDB();
      $compteDB = new ComptesDB();

      $connectedUser = $_SESSION["connectedUser"];
      $connectedUserType = $connectedUser->getType();

      $voyages = $voyagesDB->getAllVoyages();
      $this->set('voyages',$voyages);

      //Number of people trips
      $compteStats = $compteDB->getAllUsers();
      $this->set('compteStats',$compteStats);

      //Number of destination
      $voyagesStats = $voyagesDB->getAllTrips();
      $this->set('voyagesStats',$voyagesStats);

      //Number of destination in years
      $destinationStats = $voyagesDB->getDestinationStats();
      $this->set('destinationStats',$destinationStats);

      //Number of accompagnateur
      $accStats = $compteDB->getAccompagnateurDestination();
      $this->set('accStats',$accStats);

      //Number of etudiant
      $etuStats = $compteDB->getEtudiantDestination();
      $this->set('etuStats',$etuStats);

      //Number of country
      $countryStats = $voyagesDB->getAllCountry();
      $this->set('countryStats',$countryStats);

      //Number of programmes
      $programmeStats = $compteDB->getProgrammes();
      $this->set('programmeStats',$programmeStats);

      //Futur projects
      $futurProjetStats = $voyagesDB->getFuturProjetsStats();
      $this->set('futurProjetStats',$futurProjetStats);


    }
}
