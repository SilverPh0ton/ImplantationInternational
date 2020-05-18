<?php

use App\Model\Entity\VoyagesQuestion;

include_once 'DBObjects/ConfigDB.php';
require_once 'Entity/VoyagesQuestion.php';

class VoyagesQuestionsDB extends ConfigDB
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    public function getVoyagesQuestionsFromIdVoyageAndRegroupement($idVoyage, $regroupement)
    {
        $voyagesQuestions = array();
        if(isset($idVoyage))
        {
            $sql = "SELECT * FROM voyages_questions WHERE id_voyage = :idVoyage AND regroupement = :regroupement";

            if ($stmt = $this->conn->prepare($sql)) {

                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":idVoyage", $idVoyage , PDO::PARAM_INT);
                $stmt->bindParam(":regroupement", $regroupement, PDO::PARAM_INT);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    // Check if username exists, if yes then verify password


                        if ($voyagesQuestionsBD = $stmt->fetchAll()) {

                            foreach($voyagesQuestionsBD as $row)
                            {
                                $voyageQuestion = new VoyagesQuestion(
                                    $row['id_voyage'],
                                    $row['id_question'],
                                    $row['regroupement'],
                                    $row['question_cat_order'],
                                    $row['question_order']
                                );
                                array_push($voyagesQuestions, $voyageQuestion);
                            }

                            return $voyagesQuestions;

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

    public function getVoyageQuestionFromIdVoyageAndRegroupement($idVoyage, $regroupement1,$regroupement2)
    {
        $voyagequestions = array();
        $sql = "SELECT * FROM voyages_questions vq inner join questions q on q.id_question = vq.id_question 
                where vq.id_voyage = :id_voyage AND (q.regroupement = :regroupement1 OR q.regroupement = :regroupement2)
                ORDER BY question_cat_order, question_order";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id_voyage", $idVoyage , PDO::PARAM_INT);
        $stmt->bindParam(":regroupement1", $regroupement1 , PDO::PARAM_INT);
        $stmt->bindParam(":regroupement2", $regroupement2 , PDO::PARAM_INT);
        $stmt->execute();
        $voyagequestionsInfo = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        foreach($voyagequestionsInfo as $row)
        {
            $voyageQuestion = new VoyagesQuestion(
                $row['id_voyage'],
                $row['id_question'],
                $row['regroupement'],
                $row['question_cat_order'],
                $row['question_order']
            );

            array_push($voyagequestions, $voyageQuestion);
        }

        return $voyagequestions;
    }

    public function addVoyagesQuestions(VoyagesQuestion $voyagesQuestion)
    {
        if (isset($voyagesQuestion))
        {
            $checkSql = "SELECT count(*) as nbVoyageQuestion FROM voyages_questions WHERE id_voyage = :id_voyage AND id_question = :id_question";
            $stmt = $this->conn->prepare($checkSql);
            if(!$stmt->execute(array(
                ':id_voyage' => $voyagesQuestion->getIdVoyage(),
                ':id_question' => $voyagesQuestion->getIdQuestion()
            ))){
                return false;
            }
            $countSql = $stmt->fetch();

            if($countSql['nbVoyageQuestion'] == 0) {
                $sql = "INSERT INTO voyages_questions (id_voyage, id_question, regroupement, question_order, question_cat_order) 
                        VALUES(:id_voyage, :id_question, :regroupement, :question_order, :question_cat_order)";
                $stmt = $this->conn->prepare($sql);
                if ($stmt->execute(array(
                    ':id_voyage' => $voyagesQuestion->getIdVoyage(),
                    ':id_question' => $voyagesQuestion->getIdQuestion(),
                    ':regroupement' => $voyagesQuestion->getRegroupement(),
                    ':question_order' => $voyagesQuestion->getQuestionOrder(),
                    ':question_cat_order'=> $voyagesQuestion->getQuestionCatOrder()
                ))) {
                    return true;
                }
                return false;
            }
            else
            {
                $sql = "UPDATE voyages_questions SET 
                        regroupement = :regroupement,
                        question_order = :question_order,
                        question_cat_order = :question_cat_order
                        WHERE id_voyage = :id_voyage AND id_question = :id_question";
                $stmt = $this->conn->prepare($sql);
                if ($stmt->execute(array(
                    ':id_voyage' => $voyagesQuestion->getIdVoyage(),
                    ':id_question' => $voyagesQuestion->getIdQuestion(),
                    ':regroupement' => $voyagesQuestion->getRegroupement(),
                    ':question_order' => $voyagesQuestion->getQuestionOrder(),
                    ':question_cat_order'=> $voyagesQuestion->getQuestionCatOrder()
                ))) {
                    return true;
                }
                return false;
            }
        }
        return false;
    }

    public function deleteVoyagesQuestions(VoyagesQuestion $voyagesQuestion)
    {
        if (isset($voyagesQuestion))
        {
            $sql = "DELETE FROM voyages_questions WHERE id_voyage = :id_voyage AND id_question = :id_question  AND regroupement = :regroupement";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array(
                ':id_voyage' => $voyagesQuestion->getIdVoyage(),
                ':id_question' => $voyagesQuestion->getIdQuestion(),
                ':regroupement' => $voyagesQuestion->getRegroupement()
            ));

            return true;
        }
        return false;
    }

}