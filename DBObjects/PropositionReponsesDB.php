<?php
use App\Model\Entity\PropositionReponse;

include_once 'DBObjects/ConfigDB.php';
require_once 'DBObjects/QuestionsDB.php';
require_once 'Entity/PropositionReponse.php';
require_once 'Entity/Question.php';

class PropositionReponsesDB extends ConfigDB
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    public function getPropositionReponseFromPropositionIdAndQuestionId($id_proposition,$id_question)
    {
        if(isset($id_proposition)&&isset($id_question))
        {
            $sql = "SELECT * FROM propositions_reponses WHERE id_proposition = :id_proposition AND id_question = :id_question";

            if ($stmt = $this->conn->prepare($sql)) {

                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":id_proposition", $id_proposition , PDO::PARAM_INT);
                $stmt->bindParam(":id_question", $id_question, PDO::PARAM_INT);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    // Check if username exists, if yes then verify password
                    if ($stmt->rowCount() == 1) {

                        if ($row = $stmt->fetch()) {
                            $questionDB = new QuestionsDB();
                            $question = $questionDB->getQuestionFromId($row['id_question']);

                            $proposition_reponse = new PropositionReponse(
                                $row['id_proposition'],
                                $question,
                                $row['reponse']
                            );

                            return $proposition_reponse;

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

    public function getAllPropositionQuestionsFromIdProposition($id_proposition)
    {
        if(isset($id_proposition))
        {
            $sql = "SELECT * FROM propositions_reponses WHERE id_proposition = :id_proposition";

            if ($stmt = $this->conn->prepare($sql)) {

                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":id_proposition", $id_proposition , PDO::PARAM_INT);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                        if ($propositionQuestionDB = $stmt->fetchAll()) {
                            $proposition_questions = array();
                            $questionDB = new QuestionsDB();
                            foreach ($propositionQuestionDB as $row)
                            {
                                $question = $questionDB->getQuestionFromId($row['id_question']);

                                $proposition_reponse = new PropositionReponse(
                                    $row['id_proposition'],
                                    $question,
                                    $row['reponse']
                                );

                                array_push($proposition_questions, $proposition_reponse);
                            }

                            return $proposition_questions;
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


    function addPropositionReponse(PropositionReponse $propositionReponse)
    {
        if(isset($propositionReponse))
        {
            $sql = "INSERT INTO propositions_reponses(id_proposition, id_question, reponse)VALUES (:id_proposition, :id_question, :reponse)";
            $stmt = $this->conn->prepare($sql);
            $idProposition = $propositionReponse->getIdProposition();
            $idQuestion = $propositionReponse->getQuestion()->getIdQuestion();
            $reponse = $propositionReponse->getReponse();
            $stmt->bindParam(":id_proposition", $idProposition);
            $stmt->bindParam(":id_question", $idQuestion);
            $stmt->bindParam(":reponse", $reponse);
            if(!$stmt->execute())
            {
                return false;
            }
            return true;

        }
        return false;
    }
    function updatePropositionReponse(PropositionReponse $propositionReponse)
    {
        if(isset($propositionReponse))
        {
            $sql = "UPDATE propositions_reponses SET reponse = :reponse WHERE id_proposition = :id_proposition AND id_question = :id_question";
            $stmt = $this->conn->prepare($sql);
            $idProposition = $propositionReponse->getIdProposition();
            $idQuestion = $propositionReponse->getQuestion()->getIdQuestion();
            $reponse = $propositionReponse->getReponse();
            $stmt->bindParam(":id_proposition", $idProposition);
            $stmt->bindParam(":id_question", $idQuestion);
            $stmt->bindParam(":reponse", $reponse);
            if(!$stmt->execute())
            {
                return false;
            }
            return true;

        }
        return false;
    }


    public function deleteProposisitionReponse($id_proposition, $id_question)
    {
        if(isset($id_proposition)&&isset($id_question))
        {
            $sql = "DELETE FROM propositions_reponses WHERE id_proposition = :id_proposition AND id_question = :id_question";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":id_proposition", $id_proposition);
            $stmt->bindParam(":id_question", $id_question);
            if(!$stmt->execute())
            {
                return false;
            }
            return true;

        }
        return false;
    }
}