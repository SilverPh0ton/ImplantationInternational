<?php
use App\Model\Entity\Activite;

include_once 'DBObjects/ConfigDB.php';
require_once 'Entity/Activite.php';

class ActivitesDB extends ConfigDB
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    public function getActiviteFromId($id_activite)
    {
        if(isset($id_activite))
        {
            $sql = "SELECT * FROM activites WHERE id_activite = :id_activite";

            if ($stmt = $this->conn->prepare($sql)) {

                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":id_activite", $id_activite , PDO::PARAM_INT);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    // Check if username exists, if yes then verify password
                    if ($stmt->rowCount() == 1) {

                        if ($row = $stmt->fetch()) {

                            $activite = new Activite(
                                $row['id_activite'],
                                $row['endroit'],
                                $row['description'],
                                $row['date_depart'],
                                $row['date_retour']
                            );

                            return $activite;

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
    public function getAllActivitesFromIdProposition($id_proposition)
    {
        $activites  = array();
        $sql = "SELECT * from activites WHERE id_proposition = :id_proposition order by date_depart desc,date_retour desc";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id_proposition", $id_proposition , PDO::PARAM_INT);
        $stmt->execute();
        $activiteInfos = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        foreach($activiteInfos as $row)
        {
            $activite = new Activite(
                $row['id_activite'],
                $id_proposition,
                $row['endroit'],
                $row['description'],
                $row['date_depart'],
                $row['date_retour']
            );
            array_push($activites, $activite);
        }

        return $activites;
    }
    function addActivite(Activite $activite)
    {
        if (isset($activite))
        {
            $sql = "INSERT INTO activites (id_proposition, endroit, description, date_depart, date_retour)
VALUES(:id_proposition, :endroit, :description, :date_depart, :date_retour)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array(
                ':id_proposition' => $activite->getIdProposition(),
                ':endroit' => $activite->getEndroit(),
                ':description' => $activite->getDescription(),
                ':date_depart' =>$activite->getDateDepart(),
                ':date_retour'=>$activite->getDateRetour()
            ));

            return true;
        }
        return false;
    }

    public function deleteActivite($id_activite)
    {
        if (isset($id_activite) )
        {
            $sql = "DELETE FROM activites WHERE id_activite = :id_activite";
            $stmt = $this->conn->prepare($sql);
            if($stmt->execute(array(
                ':id_activite' => $id_activite
            )))
            {
                return true;
            }

            return false;
        }
        return false;
    }

    public function deleteActiviteWhereIdProposition($id_proposition)
    {
        if (isset($id_proposition) )
        {
            $sql = "DELETE FROM activites WHERE id_proposition = :id_proposition";
            $stmt = $this->conn->prepare($sql);
            if($stmt->execute(array(
                ':id_proposition' => $id_proposition
            )))
            {
                return true;
            }

            return false;
        }
        return false;
    }


}
