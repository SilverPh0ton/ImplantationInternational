<?php


use App\Model\Entity\ComptesVoyage;
use App\Model\Entity\Voyage;

include_once 'DBObjects/ConfigDB.php';
require_once 'DBObjects/DestinationsDB.php';
require_once 'Entity/ComptesVoyage.php';

class ComptesVoyagesDB extends ConfigDB
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    public function getIdVoyagesFromCompteId($compteId)
    {
        $voyagesId = array();
        if(isset($compteId))
        {
            $sql = "SELECT id_voyage FROM comptes_voyages WHERE id_compte = :compteId";

            if ($stmt = $this->conn->prepare($sql)) {

                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":compteId", $compteId , PDO::PARAM_INT);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    $bdVoyageIds = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                    foreach($bdVoyageIds as $row)
                    {
                        array_push($voyagesId, $row['id_voyage']);
                    }

                    return $voyagesId;
                }
                else //EXECUtE FAILED
                {
                    return null;
                }
            }
            else//PREPARE FAILED
            {
                return null;
            }
        }
        else//NOT ISSET
        {
            return null;
        }
    }

    public function getCompteVoyageFromIdCompteAndVoyage($compteId, $voyageId)
    {
        $compteVoyages = array();
        if(isset($compteId))
        {
            $sql = "SELECT * FROM comptes_voyages WHERE id_compte = :compteId AND id_voyage = :voyageId";

            if ($stmt = $this->conn->prepare($sql)) {

                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":compteId", $compteId , PDO::PARAM_INT);
                $stmt->bindParam(":voyageId", $voyageId , PDO::PARAM_INT);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    $bdCompteVoyages = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                    foreach($bdCompteVoyages as $row)
                    {
                        $compteVoyage = new ComptesVoyage(
                            $row['id_compte'],
                            $row['id_voyage'],
                            $row['date_paiement']
                        );

                        array_push($compteVoyages, $compteVoyage);
                    }

                    return $compteVoyages;
                }
                else //EXECUtE FAILED
                {
                    return null;
                }
            }
            else//PREPARE FAILED
            {
                return null;
            }
        }
        else//NOT ISSET
        {
            return null;
        }
    }

    public function getVoyagesFromCompteId($compteId)
    {
        $voyages = array();
        if(isset($compteId))
        {
            $sql = "SELECT * FROM comptes_voyages WHERE id_compte = :compteId";

            if ($stmt = $this->conn->prepare($sql)) {

                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":compteId", $compteId , PDO::PARAM_INT);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    $bdVoyageIds = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                    foreach($bdVoyageIds as $row)
                    {
                        $voyageDB = new VoyagesDB();
                        $voyage = $voyageDB->getVoyageFromId($row['id_voyage']);
                        array_push($voyages, $voyage);
                    }

                    return $voyages;
                }
                else //EXECUtE FAILED
                {
                    return null;
                }
            }
            else//PREPARE FAILED
            {
                return null;
            }
        }
        else//NOT ISSET
        {
            return null;
        }
    }

    public function getIdComptesFromIdVoyage($voyageId)
    {
        $comptesId = array();
        if(isset($voyageId))
        {
            $sql = "SELECT id_compte FROM comptes_voyages WHERE id_voyage = :voyageId";

            if ($stmt = $this->conn->prepare($sql)) {

                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":voyageId", $voyageId , PDO::PARAM_INT);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    $bdCompteIds = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                    foreach($bdCompteIds as $row)
                    {
                        array_push($comptesId, $row['id_compte']);
                    }

                    return $comptesId;
                }
                else //EXECUtE FAILED
                {
                    return null;
                }
            }
            else//PREPARE FAILED
            {
                return null;
            }
        }
        else//NOT ISSET
        {
            return null;
        }
    }

    public function getEtuIdCompteFromIdVoyage($voyageId)
    {
        $comptesId = array();
        if(isset($voyageId))
        {
            $sql = "SELECT * FROM `comptes_voyages` cv INNER JOIN comptes c ON cv.id_compte = c.id_compte WHERE cv.id_voyage = :voyageId AND c.type = 'etudiant'";

            if ($stmt = $this->conn->prepare($sql)) {

                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":voyageId", $voyageId , PDO::PARAM_INT);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    $bdCompteIds = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                    foreach($bdCompteIds as $row)
                    {
                        array_push($comptesId, $row['id_compte']);
                    }

                    return $comptesId;
                }
                else //EXECUtE FAILED
                {
                    return null;
                }
            }
            else//PREPARE FAILED
            {
                return null;
            }
        }
        else//NOT ISSET
        {
            return null;
        }
    }

    public function getIdCompteTypeFormIdVoyage($voyageId, $type)
    {
        $comptesId = array();
        if(isset($voyageId))
        {
            $sql = "select cv.id_compte from comptes_voyages cv
                    inner join comptes c on c.id_compte = cv.id_compte
                    where id_voyage = :voyageId and c.type = :type";

            if ($stmt = $this->conn->prepare($sql)) {

                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":voyageId", $voyageId , PDO::PARAM_INT);
                $stmt->bindParam(":type", $type , PDO::PARAM_STR);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    $bdCompteIds = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                    foreach($bdCompteIds as $row)
                    {
                        array_push($comptesId, $row['id_compte']);
                    }

                    return $comptesId;
                }
                else //EXECUtE FAILED
                {
                    return null;
                }
            }
            else//PREPARE FAILED
            {
                return null;
            }
        }
        else//NOT ISSET
        {
            return null;
        }
    }

    public function getEtuIdsFromProfId($compteId)
    {
        $comptesId = array();
        if(isset($compteId))
        {
            $sql = "SELECT `id_compte` FROM `comptes_voyages`
                    WHERE `id_voyage` IN
                    (SELECT id_voyage FROM comptes_voyages cv
                    INNER JOIN comptes c on cv.id_compte = c.id_compte
                    WHERE c.id_compte = :profId)
                    AND `id_compte` IN
                    (SELECT id_compte FROM comptes WHERE type = :type)
                    GROUP BY id_compte";

            if ($stmt = $this->conn->prepare($sql)) {

                $type = 'etudiant';

                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":profId", $compteId , PDO::PARAM_INT);
                $stmt->bindParam(":type", $type , PDO::PARAM_STR);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    $bdCompteIds = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                    foreach($bdCompteIds as $row)
                    {
                        array_push($comptesId, $row['id_compte']);
                    }

                    return $comptesId;
                }
                else //EXECUtE FAILED
                {
                    return null;
                }
            }
            else//PREPARE FAILED
            {
                return null;
            }
        }
        else//NOT ISSET
        {
            return null;
        }
    }

    public function compteVoyageExist($compteId, $voyageId)
    {
        if(isset($voyageId) && isset($compteId))
        {
            $sql = "SELECT count(*) as exist FROM comptes_voyages WHERE id_voyage = :voyageId AND id_compte = :compteId";

            if ($stmt = $this->conn->prepare($sql)) {

                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":voyageId", $voyageId , PDO::PARAM_INT);
                $stmt->bindParam(":compteId", $compteId , PDO::PARAM_INT);
                $stmt->execute();
                $row = $stmt->fetch();
                if($row['exist'] == 0)
                {
                    return false;
                }

                return true;
            }
            else//PREPARE FAILED
            {
                return null;
            }
        }
        else//NOT ISSET
        {
            return null;
        }
    }

    public function getUserCountByVoyageId($voyageId)
    {
        if(isset($voyageId))
        {
            $sql = "SELECT count(*) FROM comptes_voyages WHERE id_voyage = :voyageId";

            if ($stmt = $this->conn->prepare($sql)) {

                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":voyageId", $voyageId , PDO::PARAM_INT);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    $row  = $stmt -> fetch();

                    return $row['count(*)'];
                }
                else //EXECUtE FAILED
                {
                    return null;
                }
            }
            else//PREPARE FAILED
            {
                return null;
            }
        }
        else//NOT ISSET
        {
            return null;
        }
    }

    function addCompteVoyage($comptesVoyage)
    {
        if (isset($comptesVoyage))
        {
                $sql = "INSERT INTO comptes_voyages (id_compte,id_voyage,date_paiement) VALUES(:id_compte, :id_voyage, :date_paiement)";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute(array(
                    ':id_compte' => $comptesVoyage->getIdCompte(),
                    ':id_voyage' => $comptesVoyage->getIdVoyage(),
                    ':date_paiement' =>$comptesVoyage->getDatePaiement()
                ));

                return true;
        }
            return false;

    }

    function updateDatePaiement(ComptesVoyage $comptesVoyage)
    {
        if (isset($comptesVoyage))
        {
            $sql = "UPDATE comptes_voyages SET date_paiement = :date_paiement WHERE id_compte = :id_compte AND id_voyage = :id_voyage";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array(
                ':id_compte' => $comptesVoyage->getIdCompte(),
                ':id_voyage' => $comptesVoyage->getIdVoyage(),
                ':date_paiement' =>$comptesVoyage->getDatePaiement()
            ));

            return true;
        }
        return false;

    }

    public function getAllTrips()
    {
        $sql = "SELECT count(*) FROM voyages";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $stats = $stmt->fetch();
        return $stats;
    }
}
