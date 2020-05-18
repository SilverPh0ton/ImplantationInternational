<?php


use App\Model\Entity\Destination;

include_once 'DBObjects/ConfigDB.php';
require_once 'Entity/Destination.php';

class DestinationsDB extends ConfigDB
{

    /**
     * DestinationsDB constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    public function getDestinationFromId($id_destination)
    {
        if(isset($id_destination))
        {
            $sql = "SELECT * FROM destinations WHERE id_destination = :id_destination";

            if ($stmt = $this->conn->prepare($sql)) {

                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":id_destination", $id_destination , PDO::PARAM_INT);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    // Check if username exists, if yes then verify password
                    if ($stmt->rowCount() == 1) {

                        if ($row = $stmt->fetch()) {
                            $destination = new Destination(
                                $row['id_destination'],
                                $row['nom_pays'],
                                $row['actif']
                            );

                            // Close statement
                            unset($stmt);

                            return $destination;

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

    public function getAllDestinations()
    {
        $destinations = array();
        $sql = "SELECT * from destinations ORDER BY actif DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $destinationsInfo = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        foreach($destinationsInfo as $destinationInfo)
        {
                $destination = new Destination(
                    $destinationInfo['id_destination'],
                    $destinationInfo['nom_pays'],
                    $destinationInfo['actif']
                );


            array_push($destinations, $destination);
        }

        return $destinations;
    }

    public function getAllActifDestinations()
    {
        $destinations = array();
        $sql = "SELECT * from destinations WHERE actif = 1 ORDER BY nom_pays";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $destinationsInfo = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        foreach($destinationsInfo as $destinationInfo)
        {
            $destination = new Destination(
                $destinationInfo['id_destination'],
                $destinationInfo['nom_pays'],
                $destinationInfo['actif']
            );


            array_push($destinations, $destination);
        }

        return $destinations;
    }

    public function addDestination($destination)
    {
        if (isset($destination))
        {
            $stmtExist = $this->conn->prepare("SELECT count(*) from destinations where nom_pays = :nom_pays");
            $stmtExist->execute(array(':nom_pays' => $destination->getNomPays()));
            $destinationCtr = $stmtExist->fetchColumn();

            if ($destinationCtr == 0) {
                $sql = "INSERT INTO destinations (nom_pays,actif) VALUES(:nom_pays, :actif)";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute(array(':nom_pays' => $destination->getNomPays(),
                    ':actif' => $destination->getActif()
                ));

                return true;
            } else {
                $sql = "UPDATE destinations SET actif = 1 WHERE nom_pays = :nom_pays";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute(array(':nom_pays' => $destination->getNomPays()));
                return true;
            }
        } else {
            return false;
        }

    }

    function updateDestination($newDestination)
    {
        if (isset($newDestination))
        {
                $sql = "UPDATE destinations SET nom_pays = :nom_pays, actif = :actif WHERE id_destination = :id_destination";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute(array(':nom_pays' => $newDestination->getNomPays(),
                    ':actif' => $newDestination->getActif(),
                    ':id_destination' => $newDestination->getIdDestination()
                ));

                return true;
        } else {
                return false;
        }
    }

    public function setDestinationActif(Destination $destination)
    {
        if (isset($destination)&&$destination->validate())
        {
            $stmtExist = $this->conn->prepare("SELECT count(*) from destinations where nom_pays = :nom_pays");
            $stmtExist->execute(array(':nom_pays' => $destination->getNomPays()));
            $destinationCtr = $stmtExist->fetchColumn();

            if ($destinationCtr == 1) {
                $sql = "UPDATE destinations SET actif = 1 WHERE nom_pays = :nom_pays";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute(array(':nom_pays' => $destination->getNomPays()));
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function destinationExist($nom_pays)
    {
        if (isset($nom_pays))
        {
            $stmtExist = $this->conn->prepare("SELECT count(*) from destinations where nom_pays = :nom_pays");
            $stmtExist->execute(array(':nom_pays' => $nom_pays));
            $destinationCtr = $stmtExist->fetchColumn();

            if ($destinationCtr == 1) {
                return true;
            }
                return false;

        } else {
            return null;
        }
    }

}