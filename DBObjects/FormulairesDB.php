<?php

use App\Model\Entity\Formulaire;

include_once 'DBObjects/ConfigDB.php';
require_once 'DBObjects/QuestionsDB.php';
require_once 'Entity/Question.php';
require_once 'Entity/Formulaire.php';

class FormulairesDB extends ConfigDB
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    public function getQuestionsFromIdFormulaire($id_formulaire)
    {
        if(isset($id_formulaire))
        {
            $sql = "SELECT * FROM formulaires WHERE id_formulaire = :id_formulaire";

            if ($stmt = $this->conn->prepare($sql)) {

                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":id_formulaire", $id_formulaire , PDO::PARAM_INT);


                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    if ($formulairesDB = $stmt->fetchAll()) {
                        $questionsFormulaire = array();
                        $questionDB = new QuestionsDB();
                        foreach ($formulairesDB as $row)
                        {
                            $questionFormulaire = $questionDB->getQuestionFromId($row['id_question']);
                            array_push($questionsFormulaire, $questionFormulaire);
                        }

                        return $questionsFormulaire;
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

    public function getQuestionsFromLatestFormulaire()
    {

            $sql = "SELECT * FROM formulaires 
                    WHERE id_formulaire = (SELECT MAX(id_formulaire) FROM formulaires)
                    ORDER BY question_cat_order,question_order;";

            if ($stmt = $this->conn->prepare($sql)) {
                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    if ($formulairesDB = $stmt->fetchAll()) {
                        $questionsFormulaire = array();
                        $questionDB = new QuestionsDB();
                        foreach ($formulairesDB as $row)
                        {
                            $questionFormulaire = $questionDB->getQuestionFromId($row['id_question']);
                            array_push($questionsFormulaire, $questionFormulaire);
                        }

                        return $questionsFormulaire;
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

    function addFormulaires($formulaires)
    {
        if (isset($formulaires))
        {
            $ctr = 0;
            $id_formulaire = null;
            //remove old formulaire
            $sqlDelete = "DELETE FROM formulaires";
            $stmt = $this->conn->prepare($sqlDelete);
            if(!$stmt->execute())
            {
                return false;
            }

            foreach ($formulaires as $formulaire)
            {
                $idQuestion = $formulaire->getIdQuestion();
                $order = $formulaire->getQuestionOrder();
                $cat_order = $formulaire->getQuestionCatOrder();

                if($ctr==0)
                {
                    $sql = "INSERT INTO `formulaires`(`id_question`, `question_order`, `question_cat_order`) VALUES (:id_question, :question_order, :question_cat_order)";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bindParam(':id_question', $idQuestion, PDO::PARAM_INT);
                    $stmt->bindParam(':question_order', $order, PDO::PARAM_INT);
                    $stmt->bindParam(':question_cat_order', $cat_order, PDO::PARAM_INT);
                    if(!$stmt->execute())
                    {
                        return false;
                    }
                    $id_formulaire = $this->conn->lastInsertId();
                    $ctr++;
                }
                else
                {
                    $sql = "INSERT INTO `formulaires`(`id_formulaire`, `id_question`, `question_order`, `question_cat_order`) VALUES (:id_formulaire, :id_question, :question_order, :question_cat_order)";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bindParam(':id_formulaire', $id_formulaire, PDO::PARAM_INT);
                    $stmt->bindParam(':id_question', $idQuestion, PDO::PARAM_INT);
                    $stmt->bindParam(':question_order', $order, PDO::PARAM_INT);
                    $stmt->bindParam(':question_cat_order', $cat_order, PDO::PARAM_INT);
                    if(!$stmt->execute())
                    {
                        return false;
                    }
                }
            }
            return true;
        }
        return false;
    }


}