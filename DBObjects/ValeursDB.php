<?php


use App\Model\Entity\Valeur;

class ValeursDB extends ConfigDB
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    public function getAllValeurs()
    {
        $valeurs = array();
        $sql = "SELECT * from valeurs";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $valeursInfo = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        foreach($valeursInfo as $row)
        {
           $valeur = new Valeur(
               $row['id_compte'],
               $row['id_voyage'],
               $row['id_question'],
               $row['reponse']
           );

            array_push($valeurs, $valeur);
        }

        return $valeurs;
    }

    public function getValeursFromCompteAndVoyage($idCompte, $idVoyage)
    {
        $valeurs = array();
        $sql = "SELECT * from valeurs WHERE id_compte = :idCompte AND id_voyage = :idVoyage ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":idCompte", $idCompte , PDO::PARAM_INT);
        $stmt->bindParam(":idVoyage", $idVoyage , PDO::PARAM_INT);
        $stmt->execute();
        $valeursInfo = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        foreach($valeursInfo as $row)
        {
            $valeur = new Valeur(
                $row['id_compte'],
                $row['id_voyage'],
                $row['id_question'],
                $row['reponse']
            );

            array_push($valeurs, $valeur);
        }

        return $valeurs;
    }
    public function addValeur(Valeur $valeur)
    {
        if (isset($valeur))
        {
            $sql = "INSERT INTO valeurs (id_compte,id_voyage,id_question,reponse) VALUES(:id_compte, :id_voyage, :id_question, :reponse)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array(
                ':id_compte' => $valeur->getIdCompte(),
                ':id_voyage' => $valeur->getIdVoyage(),
                ':id_question'=> $valeur->getIdQuestion(),
                ':reponse'=> $valeur->getReponse()
            ));

            return true;
        }
        return false;
    }

    public function saveValeur(Valeur $valeur)
    {
        if (isset($valeur))
        {
            $checkSql = "SELECT COUNT(*) as nbValeur FROM valeurs WHERE id_compte = :id_compte AND id_voyage = :id_voyage AND id_question = :id_question";
            $stmt = $this->conn->prepare($checkSql);
            if(!$stmt->execute(array(
                ':id_compte' => $valeur->getIdCompte(),
                ':id_voyage' => $valeur->getIdVoyage(),
                ':id_question'=> $valeur->getIdQuestion())))
            {
                return false;
            }
            $checkSqlRow = $stmt->fetch();

            if($checkSqlRow['nbValeur'] == 1)
            {
                $sql = "UPDATE valeurs 
                        SET reponse = :reponse
                        WHERE id_compte = :id_compte AND  id_voyage = :id_voyage AND id_question = :id_question";
                $stmt = $this->conn->prepare($sql);
                if($stmt->execute(array(
                    ':id_compte' => $valeur->getIdCompte(),
                    ':id_voyage' => $valeur->getIdVoyage(),
                    ':id_question'=> $valeur->getIdQuestion(),
                    ':reponse'=> $valeur->getReponse()
                ))){
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else
            {
                $sql = "INSERT INTO valeurs (id_compte,id_voyage,id_question,reponse) VALUES(:id_compte, :id_voyage, :id_question, :reponse)";
                $stmt = $this->conn->prepare($sql);
                if($stmt->execute(array(
                    ':id_compte' => $valeur->getIdCompte(),
                    ':id_voyage' => $valeur->getIdVoyage(),
                    ':id_question'=> $valeur->getIdQuestion(),
                    ':reponse'=> $valeur->getReponse()
                )))
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }
        else
        {
            return false;
        }


    }

    public function deleteValeur($id_compte, $id_voyage, $id_question)
    {
        if (isset($id_compte) && isset($id_voyage) && isset($id_question))
        {
            $sql = "DELETE FROM valeurs WHERE id_compte = :id_compte AND id_voyage = :id_voyage AND id_question = :id_question";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array(
                ':id_compte' => $id_compte,
                ':id_voyage' => $id_voyage,
                ':id_question'=> $id_question
            ));

            return true;
        }
        return false;
    }


}