<?php


use App\Model\Entity\Question;

include_once 'DBObjects/CategoriesDB.php';
include_once 'DBObjects/ConfigDB.php';
require_once 'Entity/Question.php';
require_once 'Entity/Categorie.php';

class QuestionsDB extends ConfigDB
{
    private $categorieDB;

    public function __construct()
    {
        parent::__construct();
        $this->categorieDB = new CategoriesDB();
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    public function getQuestionFromId($id_question)
    {
        if (isset($id_question)) {
            $sql = "SELECT * FROM questions WHERE id_question = :id_question";

            if ($stmt = $this->conn->prepare($sql)) {

                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":id_question", $id_question, PDO::PARAM_INT);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    // Check if username exists, if yes then verify password
                    if ($stmt->rowCount() == 1) {

                        if ($row = $stmt->fetch()) {
                            $categorie = $this->categorieDB->getCategorieFromId($row['id_categorie']);

                            $question = new Question(
                                $row['id_question'],
                                $categorie,
                                $row['question'],
                                $row['input_option'],
                                $row['affichage'],
                                $row['actif'],
                                $row['info_sup'],
                                $row['regroupement']
                            );

                            return $question;

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

    function getLastInsertedId()
    {
        $stmt = $this->conn->query("SELECT LAST_INSERT_ID()");
        return $stmt->fetchColumn();
    }



    public function getAllQuestions()
    {
        $questions = array();
        $sql = "SELECT * from questions ORDER BY actif DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $questionsInfo = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($questionsInfo as $row) {
            $categorie = $this->categorieDB->getCategorieFromId($row['id_categorie']);

            $question = new Question(
                $row['id_question'],
                $categorie,
                $row['question'],
                $row['input_option'],
                $row['affichage'],
                $row['actif'],
                $row['info_sup'],
                $row['regroupement']
            );

            array_push($questions, $question);
        }

        return $questions;
    }

    public function getAllQuestionByRegroupement($regroupement)
    {
        $questions = array();
        $sql = "SELECT q.id_question, q.id_categorie, q.question, q.input_option, q.affichage, q.actif, q.info_sup, q.regroupement from questions q 
                WHERE q.regroupement = :regroupement";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":regroupement", $regroupement, PDO::PARAM_INT);
        $stmt->execute();
        $questionsInfo = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($questionsInfo as $row) {
            $categorie = $this->categorieDB->getCategorieFromId($row['id_categorie']);

            $question = new Question(
                $row['id_question'],
                $categorie,
                $row['question'],
                $row['input_option'],
                $row['affichage'],
                $row['actif'],
                $row['info_sup'],
                $row['regroupement']
            );

            array_push($questions, $question);
        }

        return $questions;
    }

    public function getAllQuestionForPropositionActif()
    {
        $questions = array();
        $sql = "SELECT q.id_question, q.id_categorie, q.question, q.input_option, q.affichage, q.actif, q.info_sup, q.regroupement from questions q 
                LEFT JOIN formulaires f ON q.id_question = f.id_question
                WHERE actif = 1 AND q.regroupement = 9
                ORDER BY CASE WHEN f.question_cat_order IS NULL THEN 99 ELSE 0 END ASC, f.question_cat_order ASC, f.question_order ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":regroupement", $regroupement, PDO::PARAM_INT);
        $stmt->execute();
        $questionsInfo = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($questionsInfo as $row) {
            $categorie = $this->categorieDB->getCategorieFromId($row['id_categorie']);

            $question = new Question(
                $row['id_question'],
                $categorie,
                $row['question'],
                $row['input_option'],
                $row['affichage'],
                $row['actif'],
                $row['info_sup'],
                $row['regroupement']
            );

            array_push($questions, $question);
        }

        return $questions;
    }

    public function getAllQuestionByTwoRegroupementAndActif($regroupement1, $regroupement2, $id_voyage)
    {
        $checkedQuestions = array();
        $allUncheckedQuestions = array();
        $questions = array();
        $sql = "SELECT q.id_question, q.id_categorie, q.question, q.input_option, q.affichage, q.actif, q.info_sup, q.regroupement from questions q 
                LEFT JOIN voyages_questions vq ON q.id_question = vq.id_question
                INNER JOIN categories c on c.id_categorie = q.id_categorie
                WHERE vq.id_voyage = :id_voyage 
                AND c.actif = 1
                AND q.actif = 1 
                AND (q.regroupement = :regroupement1 OR q.regroupement = :regroupement2)
                ORDER BY CASE WHEN vq.question_cat_order IS NULL THEN 99 ELSE 0 END ASC, vq.question_cat_order ASC, vq.question_order ASC;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id_voyage", $id_voyage, PDO::PARAM_INT);
        $stmt->bindParam(":regroupement1", $regroupement1, PDO::PARAM_INT);
        $stmt->bindParam(":regroupement2", $regroupement2, PDO::PARAM_INT);
        $stmt->execute();
        $questionsCheckedInfo = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($questionsCheckedInfo as $row) {
            $categorie = $this->categorieDB->getCategorieFromId($row['id_categorie']);

            $question = new Question(
                $row['id_question'],
                $categorie,
                $row['question'],
                $row['input_option'],
                $row['affichage'],
                $row['actif'],
                $row['info_sup'],
                $row['regroupement']
            );

            array_push($checkedQuestions, $question);
        }
        $sql = "SELECT q.id_question, q.id_categorie, q.question, q.input_option, q.affichage, q.actif, q.info_sup, q.regroupement FROM questions q 
                INNER JOIN categories c on c.id_categorie = q.id_categorie
                WHERE q.id_question NOT IN (
                    SELECT q.id_question from questions q 
                    LEFT JOIN voyages_questions vq ON q.id_question = vq.id_question
                    WHERE vq.id_voyage = :id_voyage AND actif = 1 AND (q.regroupement = :regroupement1  OR q.regroupement = :regroupement2)
                    )
                AND (q.regroupement = :regroupement1  OR q.regroupement = :regroupement2)
                AND c.actif = 1
                AND q.actif = 1;";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id_voyage", $id_voyage, PDO::PARAM_INT);
        $stmt->bindParam(":regroupement1", $regroupement1, PDO::PARAM_INT);
        $stmt->bindParam(":regroupement2", $regroupement2, PDO::PARAM_INT);
        $stmt->execute();
        $questionsUncheckedInfo = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($questionsUncheckedInfo as $row) {
            $categorie = $this->categorieDB->getCategorieFromId($row['id_categorie']);

            $question = new Question(
                $row['id_question'],
                $categorie,
                $row['question'],
                $row['input_option'],
                $row['affichage'],
                $row['actif'],
                $row['info_sup'],
                $row['regroupement']
            );

            array_push($allUncheckedQuestions, $question);
        }

        //***IMPORTANT*** L'ordre de la liste checkedQuestions ne doit pas changer
        $questions = array_merge($checkedQuestions, $allUncheckedQuestions);
        return $questions;
    }


    public function addQuestion($question)
    {
        if (isset($question)) {
            $sql = "INSERT INTO questions (id_categorie,question,input_option,affichage,actif,info_sup,regroupement) VALUES(:id_categorie, :question, :input_option, :affichage, :actif, :info_sup, :regroupement)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array(
                ':id_categorie' => $question->getCategorie()->getIdCategorie(),
                ':question' => $question->getQuestion(),
                ':input_option' => $question->getInputOption(),
                ':affichage' => $question->getAffichage(),
                ':actif' => $question->getActif(),
                ':info_sup' => $question->getInfoSup(),
                ':regroupement' => $question->getRegroupement()
            ));

            return true;
        }
        return false;
    }

    public function updateQuestion($question)
    {
   
        if (isset($question)) {
            $sql = "UPDATE questions SET id_categorie = :id_categorie,
                question = :question,
                input_option = :input_option,
                affichage = :affichage,
                actif = :actif,
                info_sup = :info_sup,
                regroupement = :regroupement
                WHERE id_question = :id_question";
            $stmt = $this->conn->prepare($sql);

            $stmt->execute(array(
                ':id_categorie' => $question->getCategorie()->getIdCategorie(),
                ':question' => $question->getQuestion(),
                ':input_option' => $question->getInputOption(),
                ':affichage' => $question->getAffichage(),
                ':actif' => $question->getActif(),
                ':info_sup' => $question->getInfoSup(),
                ':regroupement' => $question->getRegroupement(),
                ':id_question' => $question->getIdQuestion()
            ));
            return true;
        }
        return false;

    }

    public function deleteQuestion($question)
    {
        if (isset($question)) {
            $sql = "DELETE FROM questions
                     WHERE id_question = :id_question";
            $stmt = $this->conn->prepare($sql);

            $stmt->execute(array(
                ':id_question' => $question->getIdQuestion()
            ));
            return true;
        }
        return false;

    }


}