<?php


use App\Model\Entity\Activation;

include_once 'DBObjects/ConfigDB.php';
require_once 'DBObjects/VoyagesDB.php';
require_once 'Entity/Activation.php';

class ActivationsDB extends ConfigDB
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    public function getActivationFromId($id_activation)
    {
        if(isset($id_activation) && is_int($id_activation))
        {
            $sql = "SELECT * FROM activations WHERE id_activation = :id_activation";

            if ($stmt = $this->conn->prepare($sql)) {

                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":id_activation", $id_activation , PDO::PARAM_INT);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    // Check if username exists, if yes then verify password
                    if ($stmt->rowCount() == 1) {

                        if ($row = $stmt->fetch()) {

                            $voyageDB = new VoyagesDB();
                            $voyage = $voyageDB->getVoyageFromId($row['id_voyage']);

                            $activation = new Activation(
                                $row['id_activation'],
                                $row['code_activation'],
                                $voyage,
                                $row['actif']
                            );
                            // Close statement
                            unset($stmt);

                            return $activation;

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

    public function getActivationFromCode($code_activation)
    {
        if(isset($code_activation))
        {
            $sql = "SELECT * FROM activations WHERE code_activation = :code_activation";

            if ($stmt = $this->conn->prepare($sql)) {

                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":code_activation", $code_activation , PDO::PARAM_STR);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    // Check if username exists, if yes then verify password
                    if ($stmt->rowCount() == 1) {

                        if ($row = $stmt->fetch()) {

                            $voyageDB = new VoyagesDB();
                            $voyage = $voyageDB->getVoyageFromId($row['id_voyage']);

                            $activation = new Activation(
                                $row['id_activation'],
                                $row['code_activation'],
                                $voyage,
                                $row['actif']
                            );
                            // Close statement
                            unset($stmt);

                            return $activation;

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

    public function isValidCode($code_activation)
    {
        if(isset($code_activation) && strlen($code_activation) < 31 )
        {
            $sql = "SELECT count(*) FROM activations WHERE code_activation = :code_activation AND actif = 1";
            if ($stmt = $this->conn->prepare($sql)) {

                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":code_activation", $code_activation , PDO::PARAM_STR);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                        $row = $stmt->fetch();
                        if($row > 0 )
                        {
                            return true;
                        }
                        else
                        {
                            return false;
                        }
                }
                else
                {
                    return false;
                }
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    public function getAllActivations()
    {
        $activations = array();
        $sql = "SELECT * from activations ORDER BY actif DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $activationsInfo = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        foreach($activationsInfo as $row)
        {
            $voyageDB = new VoyagesDB();
            $voyage = $voyageDB->getVoyageFromId($row['id_voyage']);

            $activation = new Activation(
                $row['id_activation'],
                $row['code_activation'],
                $voyage,
                $row['actif']
            );


            array_push($activations, $activation);
        }

        return $activations;
    }

    public function getActivationFromIdVoyage($idVoyage)
    {
        $activations = array();
        if(isset($idVoyage))
        {
            $sql = "SELECT * FROM activations WHERE id_voyage = :idVoyage order by actif DESC";


            if ($stmt = $this->conn->prepare($sql)) {

                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":idVoyage", $idVoyage , PDO::PARAM_INT);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    // Check if username exists, if yes then verify password
                    if ($stmt->rowCount() != 0) {

                        if ($activationsBD = $stmt->fetchAll()) {

                            foreach($activationsBD as $row)
                            {
                                $voyageDB = new VoyagesDB();
                                $voyage = $voyageDB->getVoyageFromId($row['id_voyage']);

                                $activation = new Activation(
                                    $row['id_activation'],
                                    $row['code_activation'],
                                    $voyage,
                                    $row['actif']
                                );
                                array_push($activations, $activation);
                            }
                            // Close statement
                            unset($stmt);

                            return $activations;

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

    function addActivation(Activation $activation)
    {
        if (isset($activation))
        {
            $stmtExist = $this->conn->prepare("SELECT count(*) from activations where code_activation = :code_activation");
            $stmtExist->execute(array(':code_activation' => $activation->getCodeActivation()));
            $compteCtr = $stmtExist->fetchColumn();

            if ($compteCtr == 0) {
                $sql = "INSERT INTO activations (code_activation,id_voyage,actif) VALUES(:code_activation, :id_voyage, :actif)";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute(array(':code_activation' => $activation->getCodeActivation(),
                    ':id_voyage' => $activation->getVoyage()->getIdVoyage(),
                    ':actif' => $activation->getActif(),
                ));

                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function setActivationActif0or1(Activation $activation, $isActif)
    {
        if (isset($activation)&&isset($isActif))
        {
            $stmtExist = $this->conn->prepare("SELECT count(*) from activations where code_activation = :code_activation");
            $stmtExist->execute(array(':code_activation' => $activation->getCodeActivation()));
            $activationCtr = $stmtExist->fetchColumn();

            if ($activationCtr == 1) {
                $sql = "UPDATE activations SET actif = :actif WHERE code_activation = :code_activation";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute(array(
                    ':actif' => $isActif,
                    ':code_activation' => $activation->getCodeActivation()));
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


}
