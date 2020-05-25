<?php


use App\Model\Entity\Voyage;
use App\Model\Entity\Compte;

include_once 'DBObjects/ConfigDB.php';
require_once 'DBObjects/DestinationsDB.php';
require_once 'Entity/Voyage.php';
require_once 'Entity/Compte.php';

class VoyagesDB extends ConfigDB
{
    /**
     * VoyagesDB constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    public function getVoyageFromId($id_voyage)
    {
        $connectedUser = $_SESSION["connectedUser"];
        $connectedUserType = $connectedUser->getType();
        $compte_id = $connectedUser->getIdCompte();

        if(isset($id_voyage) && $connectedUserType !== 'admin')
        {
            $sql = "SELECT v.id_voyage,v.id_proposition,v.ville,v.date_depart,v.date_retour,v.actif,
            v.approuvee,v.id_destination,v.nom_projet,v.note 
            FROM voyages v, comptes_voyages cv , comptes c 
            WHERE v.id_voyage = cv.id_voyage and cv.id_compte = c.id_compte and 
            c.id_compte = :connectedUser and v.id_voyage = :id_voyage";


            if ($stmt = $this->conn->prepare($sql)) {

                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":id_voyage", $id_voyage , PDO::PARAM_INT);
                $stmt->bindParam(":connectedUser", $compte_id, PDO::PARAM_INT);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    // Check if username exists, if yes then verify password
                    if ($stmt->rowCount() == 1) {

                        if ($row = $stmt->fetch()) {

                            $destinationDB = new DestinationsDB();
                            $destination = $destinationDB->getDestinationFromId($row['id_destination']);

                            $voyage = new Voyage(
                                $row['id_voyage'],
                                $row['id_proposition'],
                                $row['ville'],
                                $row['date_depart'],
                                $row['date_retour'],
                                $row['actif'],
                                $row['approuvee'],
                                $destination,
                                $row['nom_projet'],
                                $row['note']
                            );

                            return $voyage;

                        }
                        else
                        {
                            return null;
                        }

                    }
                    else
                    {
                        return null;
                    }

                }
                else
                {
                    return null;
                }

                // Close statement
                unset($stmt);

            }
            else
            {
                return null;
            }
        } 
        else if(isset($id_voyage) && $connectedUserType === 'admin')
        {
            $sql = "SELECT * FROM voyages WHERE id_voyage = :id_voyage";
            
            if ($stmt = $this->conn->prepare($sql)) {

                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":id_voyage", $id_voyage , PDO::PARAM_INT);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    // Check if username exists, if yes then verify password
                    if ($stmt->rowCount() == 1) {

                        if ($row = $stmt->fetch()) {

                            $destinationDB = new DestinationsDB();
                            $destination = $destinationDB->getDestinationFromId($row['id_destination']);

                            $voyage = new Voyage(
                                $row['id_voyage'],
                                $row['id_proposition'],
                                $row['ville'],
                                $row['date_depart'],
                                $row['date_retour'],
                                $row['actif'],
                                $row['approuvee'],
                                $destination,
                                $row['nom_projet'],
                                $row['note']
                            );

                            return $voyage;

                        }
                        else
                        {
                            return null;
                        }

                    }
                    else
                    {
                        return null;
                    }

                }
                else
                {
                    return null;
                }

                // Close statement
                unset($stmt);

            }
            else
            {
                return null;
            }
        }
        else 
        {
            return null;
        }
    }

    public function getAllVoyages()
    {
        $voyages  = array();
        $sql = "SELECT * from voyages ORDER BY actif DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $voyagesInfo = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        foreach($voyagesInfo as $voyageInfo)
        {
            $destinationDB = new DestinationsDB();
            $destination = $destinationDB->getDestinationFromId($voyageInfo['id_destination']);

            $voyage = new Voyage(
                $voyageInfo['id_voyage'],
                $voyageInfo['id_proposition'],
                $voyageInfo['ville'],
                $voyageInfo['date_depart'],
                $voyageInfo['date_retour'],
                $voyageInfo['actif'],
                $voyageInfo['approuvee'],
                $destination,
                $voyageInfo['nom_projet'],
                $voyageInfo['note']
            );
            array_push($voyages, $voyage);
        }

        return $voyages;
    }

    function addVoyage(Voyage $voyage)
    {
        if (isset($voyage))
        {
            $sql = "INSERT INTO voyages (id_proposition,ville,date_depart,  date_retour, actif, approuvee, id_destination, nom_projet, note) 
VALUES(:id_proposition,:ville,  :date_depart,  :date_retour, :actif, :approuvee, :id_destination, :nom_projet, :note)";
            $stmt = $this->conn->prepare($sql);
           if($stmt->execute(array(
                ':id_proposition' => $voyage->getIdProposition(),
                ':ville' => $voyage->getVille(),
                ':date_depart' =>$voyage->getDateDepart(),
                ':date_retour'=>$voyage->getDateRetour(),
                ':actif'=>$voyage->getActif(),
                ':approuvee'=>$voyage->getApprouvee(),
                ':id_destination'=>$voyage->getDestination()->getIdDestination(),
                ':nom_projet'=>$voyage->getNomProjet(),
                ':note'=>$voyage->getNote()
            )))
           {
               return true;
           }

            return false;
        }
        return false;
    }

    function getLastInsertedId()
    {
        $stmt = $this->conn->query("SELECT LAST_INSERT_ID()");
        return $stmt->fetchColumn();
    }

    function updateVoyage(Voyage $voyage)
    {
        if (isset($voyage))
        {
            $sql = "UPDATE voyages SET ville = :ville,  date_depart = :date_depart,  date_retour = :date_retour, actif = :actif, approuvee = :approuvee, id_destination = :id_destination, nom_projet = :nom_projet, note = :note
                        WHERE id_voyage = :id_voyage";
            $stmt = $this->conn->prepare($sql);
            if($stmt->execute(array(
                ':ville' => $voyage->getVille(),
                ':date_depart' =>$voyage->getDateDepart(),
                ':date_retour'=>$voyage->getDateRetour(),
                ':actif'=>$voyage->getActif(),
                ':approuvee'=>$voyage->getApprouvee(),
                ':id_destination'=>$voyage->getDestination()->getIdDestination(),
                ':nom_projet'=>$voyage->getNomProjet(),
                ':note'=>$voyage->getNote(),
                ':id_voyage'=>$voyage->getIdVoyage()
            )))
            {
                return true;
            }

            return false;
        }
        return false;

    }

    public function getVoyageForId($id_compte)
    {
        $sql = "SELECT v.nom_projet FROM comptes_voyages cv
                INNER JOIN voyages v on v.id_voyage = cv.id_voyage
                WHERE cv.id_compte = :id_compte";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id_compte", $id_compte , PDO::PARAM_INT);
        $stmt->execute();
        $voyagesNames = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $nameList = "";
        foreach($voyagesNames as $voyageName)
        {
            $nameList .= $voyageName['nom_projet'] ;
            $nameList .= ", ";
        }

        $nameList = substr($nameList, 0, -2);

        return $nameList;
    }

}