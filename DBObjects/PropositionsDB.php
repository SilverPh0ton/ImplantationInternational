<?php

use App\Model\Entity\Activite;
use App\Model\Entity\ComptesVoyage;
use App\Model\Entity\Destination;
use App\Model\Entity\Proposition;
use App\Model\Entity\Voyage;

include_once 'DBObjects/ConfigDB.php';

require_once 'DBObjects/DestinationsDB.php';
require_once 'DBObjects/ActivitesDB.php';
require_once 'DBObjects/VoyagesDB.php';
require_once 'DBObjects/ComptesVoyagesDB.php';

require_once 'Entity/Voyage.php';
require_once 'Entity/Proposition.php';
require_once 'Entity/Destination.php';
require_once 'Entity/Activite.php';
require_once 'Entity/ComptesVoyage.php';

class PropositionsDB extends ConfigDB
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    public function getPropositionFromId($id_proposition)
    {
        if (isset($id_proposition)) {
            $sql = "SELECT * FROM propositions WHERE id_proposition = :id_proposition";

            if ($stmt = $this->conn->prepare($sql)) {

                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":id_proposition", $id_proposition, PDO::PARAM_INT);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    // Check if username exists, if yes then verify password
                    if ($stmt->rowCount() == 1) {

                        if ($row = $stmt->fetch()) {
                            $destinationsDB = new DestinationsDB();
                            $destination = $destinationsDB->getDestinationFromId($row['id_destination']);

                            $activitesDB = new ActivitesDB();
                            $activites = $activitesDB->getAllActivitesFromIdProposition($row['id_proposition']);

                            $proposition = new Proposition(
                                $row['id_proposition'],
                                $row['id_compte'],
                                $row['nom_projet'],
                                $row['ville'],
                                $activites,
                                $row['date_depart'],
                                $row['date_retour'],
                                $row['actif'],
                                $row['approuve'],
                                $row['msg_refus'],
                                $destination,
                                $row['note']
                            );

                            return $proposition;

                        } else {
                            return null;
                        }

                    } else {
                        return null;
                    }

                } else {
                    return null;
                }

                // Close statement
                unset($stmt);

            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    public function getAllPropositions()
    {
        $propositions = array();
        $sql = "SELECT * from propositions ORDER BY approuve";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $propositionsDB = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $destinationsDB = new DestinationsDB();
        $activitesDB = new ActivitesDB();
        foreach ($propositionsDB as $row) {
            $destination = $destinationsDB->getDestinationFromId($row['id_destination']);
            $activites = $activitesDB->getAllActivitesFromIdProposition($row['id_proposition']);

            $proposition = new Proposition(
                $row['id_proposition'],
                $row['id_compte'],
                $row['nom_projet'],
                $row['ville'],
                $activites,
                $row['date_depart'],
                $row['date_retour'],
                $row['actif'],
                $row['approuve'],
                $row['msg_refus'],
                $destination,
                $row['note']
            );
            array_push($propositions, $proposition);
        }

        return $propositions;
    }

    public function getAllPropositionsForAccompagnateur($id_accompagnateur)
    {
        $propositions = array();
        $sql = "SELECT * from propositions WHERE id_compte = :id_compte ORDER BY approuve";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id_compte", $id_accompagnateur);
        $stmt->execute();
        $propositionsDB = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $destinationsDB = new DestinationsDB();
        $activitesDB = new ActivitesDB();
        foreach ($propositionsDB as $row) {
            $destination = $destinationsDB->getDestinationFromId($row['id_destination']);
            $activites = $activitesDB->getAllActivitesFromIdProposition($row['id_proposition']);

            $proposition = new Proposition(
                $row['id_proposition'],
                $row['id_compte'],
                $row['nom_projet'],
                $row['ville'],
                $activites,
                $row['date_depart'],
                $row['date_retour'],
                $row['actif'],
                $row['approuve'],
                $row['msg_refus'],
                $destination,
                $row['note']
            );
            array_push($propositions, $proposition);
        }

        return $propositions;
    }

    function acceptProposition(Proposition $proposition)
    {
        if (isset($proposition)) {
            $id_propositon = $proposition->getIdProposition();
            $sql = "UPDATE propositions SET approuve = 2 WHERE id_proposition = :id_proposition";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":id_proposition", $id_propositon);
            if ($stmt->execute()) {
                $voyage = $this->propositionToVoyage($proposition);
                $voyageDB = new VoyagesDB();
                if (!$voyageDB->addVoyage($voyage)) {
                    return false;
                }
                $voyageId = $voyageDB->getLastInsertedId();
                $compteVoyageDB = new ComptesVoyagesDB();
                $compteVoyage = new ComptesVoyage(
                    $proposition->getIdCompte(),
                    $voyageId,
                    null);

                if (!$compteVoyageDB->addCompteVoyage($compteVoyage)) {
                    return false;
                }
                return true;
            }
            return false;
        } else {
            return false;
        }
    }

    function propositionToVoyage(Proposition $proposition)
    {

        $voyage = new Voyage(
            null,
            $proposition->getIdProposition(),
            $proposition->getVille(),
            $proposition->getDateDepart(),
            $proposition->getDateRetour(),
            $proposition->getActif(),
            $proposition->getApprouvee(),
            $proposition->getDestination(),
            $proposition->getNomProjet(),
            $proposition->getNote()
        );
        return $voyage;
    }

    function refuseProposition($id_proposition, $msg_refus)
    {
        if (isset($id_proposition)) {
            $sql = "UPDATE propositions SET approuve = 1, msg_refus = :msg_refus WHERE id_proposition = :id_proposition";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam("msg_refus", $msg_refus);
            $stmt->bindParam("id_proposition", $id_proposition);
            if ($stmt->execute()) {
                return true;
            }
            return false;
        } else {
            return false;
        }
    }

    function addProposition(Proposition $proposition)
    {
        if (isset($proposition)) {
            $sql = "INSERT INTO propositions (id_proposition, id_compte, nom_projet,ville,  date_depart,  date_retour, actif, approuve, id_destination, note) 
                    VALUES(
                      :id_proposition,
                      :id_compte,
                      :nom_projet,
                      :ville,
                      :date_depart,
                      :date_retour,
                      :actif,
                      :approuve,
                      :id_destination,
                      :note)";
            $idProposition = $proposition->getIdProposition();
            $idCompte = $proposition->getIdCompte();
            $nomProjet = $proposition->getNomProjet();
            $ville = $proposition->getVille();
            $date_depart = $proposition->getDateDepart();
            $date_retour = $proposition->getDateRetour();
            $actif = $proposition->getActif();
            $approuvee = $proposition->getApprouvee();
            $id_destination = $proposition->getDestination()->getIdDestination();
            $note = $proposition->getNote();
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_proposition', $idProposition);
            $stmt->bindParam(':id_compte', $idCompte);
            $stmt->bindParam(':nom_projet', $nomProjet);
            $stmt->bindParam(':ville', $ville);
            $stmt->bindParam(':date_depart', $date_depart);
            $stmt->bindParam(':date_retour', $date_retour);
            $stmt->bindParam(':actif', $actif);
            $stmt->bindParam(':approuve', $approuvee);
            $stmt->bindParam(':id_destination', $id_destination);
            $stmt->bindParam(':note', $note);

            if ($stmt->execute()) {
                return $this->conn->lastInsertId();
            }
            return null;
        }
        return null;
    }

    public function deleteProposition($id_proposition)
    {
        if (isset($id_proposition)) {
            $sql = "DELETE FROM propositions WHERE id_proposition = :id_proposition";
            $stmt = $this->conn->prepare($sql);
            if ($stmt->execute(array(
                ':id_proposition' => $id_proposition
            ))) {
                return true;
            }
            return false;
        }
        return false;
    }

    public function updateProposition(Proposition $proposition)
    {
        if (isset($proposition)) {
            $sql = "UPDATE propositions SET 
                    nom_projet = :nom_projet, 
                    ville = :ville,
                    date_depart = :date_depart, 
                    date_retour = :date_retour,
                    actif = :actif,
                    approuve = 0,
                    id_destination = :id_destination,
                    note = :note WHERE id_proposition = :id_proposition";
            $idProposition = $proposition->getIdProposition();
            $nomProjet = $proposition->getNomProjet();
            $ville = $proposition->getVille();
            $date_depart = $proposition->getDateDepart();
            $date_retour = $proposition->getDateRetour();
            $actif = $proposition->getActif();
            $id_destination = $proposition->getDestination()->getIdDestination();
            $note = $proposition->getNote();
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_proposition', $idProposition);
            $stmt->bindParam(':nom_projet', $nomProjet);
            $stmt->bindParam(':ville', $ville);
            $stmt->bindParam(':date_depart', $date_depart);
            $stmt->bindParam(':date_retour', $date_retour);
            $stmt->bindParam(':actif', $actif);
            $stmt->bindParam(':id_destination', $id_destination);
            $stmt->bindParam(':note', $note);

            if ($stmt->execute()) {
                return true;
            }
            return false;
        }
        return false;
    }


}