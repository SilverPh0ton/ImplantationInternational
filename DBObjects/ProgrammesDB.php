<?php


use App\Model\Entity\Programme;
include_once 'DBObjects/ConfigDB.php';
require_once "Entity/Programme.php";

class ProgrammesDB extends ConfigDB
{
    /**
     * ProgrammesDB constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    public function getProgrammeFromId($id_programme)
    {
        if(isset($id_programme))
        {
            $sql = "SELECT * FROM programmes WHERE id_programme = :id_programme";

            if ($stmt = $this->conn->prepare($sql)) {

                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":id_programme", $id_programme , PDO::PARAM_INT);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    // Check if username exists, if yes then verify password
                    if ($stmt->rowCount() == 1) {

                        if ($row = $stmt->fetch()) {
                            $programme = new Programme(
                                $row['id_programme'],
                                $row['nom_programme'],
                                $row['actif']
                            );

                            return $programme;
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

    public function getProgrammeFromNom($nom_programme)
    {
        if(isset($nom_programme))
        {
            $sql = "SELECT * FROM programmes WHERE nom_programme = :nom_programme";

            if ($stmt = $this->conn->prepare($sql)) {

                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":nom_programme", $nom_programme , PDO::PARAM_STR);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    // Check if username exists, if yes then verify password
                    if ($stmt->rowCount() == 1) {

                        if ($row = $stmt->fetch()) {
                            $programme = new Programme(
                                $row['id_programme'],
                                $row['nom_programme'],
                                $row['actif']
                            );

                            return $programme;
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

    public function getAllProgrammes()
    {
        $programmes = array();
        $sql = "SELECT * from programmes WHERE actif = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $programmesInfo = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        foreach($programmesInfo as $row)
        {
            $programme = new Programme(
                $row['id_programme'],
                $row['nom_programme'],
                $row['actif']
            );
            $serializedProgramme = serialize($programme);

            array_push($programmes, $serializedProgramme);
        }
        return $programmes;
    }

    public function getAllProgrammesWithInactive()
    {
        $programmes = array();
        $sql = "SELECT * from programmes ORDER BY actif DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $programmesInfo = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        foreach($programmesInfo as $row)
        {
            $programme = new Programme(
                $row['id_programme'],
                $row['nom_programme'],
                $row['actif']
            );
            $serializedProgramme = serialize($programme);

            array_push($programmes, $serializedProgramme);
        }
        return $programmes;
    }

    public function addProgramme($programme)
    {
        if (isset($programme))
        {
            $stmtExist = $this->conn->prepare("SELECT count(*) from programmes where nom_programme = :nom_programme");
            $stmtExist->execute(array(':nom_programme' => $programme->getNomProgramme()));
            $programmeCtr = $stmtExist->fetchColumn();

            if ($programmeCtr == 0) {
                $sql = "INSERT INTO programmes (nom_programme,actif) VALUES(:nom_programme, :actif)";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute(array(':nom_programme' => $programme->getNomProgramme(),
                    ':actif' => $programme->getActif()
                ));

                return true;
            } else {
                $sql = "UPDATE programmes SET actif = 1 WHERE nom_programme = :nom_programme";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute(array(':nom_programme' => $programme->getNomProgramme()));
                return true;
            }
        } else {
            return false;
        }
    }

    function updateProgramme($programme)
    {
        if (isset($programme))
        {
            $sql = "UPDATE programmes SET nom_programme = :nom_programme, actif = :actif WHERE id_programme = :id_programme";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array(':nom_programme' => $programme->getNomProgramme(),
                ':actif' => $programme->getActif(),
                ':id_programme' => $programme->getIdProgramme()
            ));

            return true;
        } else {
            return false;
        }
    }

    public function setProgrammeActif(Programme $programme)
    {
        if (isset($programme)&&$programme->validate())
        {
            $stmtExist = $this->conn->prepare("SELECT count(*) from programmes where nom_programme = :nom_programme");
            $stmtExist->execute(array(':nom_programme' => $programme->getNomProgramme()));
            $destinationCtr = $stmtExist->fetchColumn();

            if ($destinationCtr == 1) {
                $sql = "UPDATE programmes SET actif = 1 WHERE nom_programme = :nom_programme";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute(array(':nom_programme' => $programme->getNomProgramme()));
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function setProgrammeInactif(Programme $programme)
    {
        if (isset($programme)&&$programme->validate())
        {
            $stmtExist = $this->conn->prepare("SELECT count(*) from programmes where nom_programme = :nom_programme");
            $stmtExist->execute(array(':nom_programme' => $programme->getNomProgramme()));
            $destinationCtr = $stmtExist->fetchColumn();

            if ($destinationCtr == 1) {
                $sql = "UPDATE programmes SET actif = 0 WHERE nom_programme = :nom_programme";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute(array(':nom_programme' => $programme->getNomProgramme()));
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function programmeExist($nom_programme)
    {
        if(isset($nom_programme) && strlen($nom_programme)<51)
        {
            $sql = "SELECT * FROM programmes WHERE nom_programme = :nom_programme";

            if ($stmt = $this->conn->prepare($sql)) {

                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":nom_programme", $nom_programme , PDO::PARAM_STR);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    // Check if username exists, if yes then verify password
                    if ($stmt->rowCount() == 1) {
                        return true;
                    }
                    return false;
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

}