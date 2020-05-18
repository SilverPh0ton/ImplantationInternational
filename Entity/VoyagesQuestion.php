<?php
namespace App\Model\Entity;


class VoyagesQuestion
{
   private $id_voyage;
   private $id_question;
   private $regroupement;
   private $question_cat_order;
   private $question_order;

    /**
     * VoyagesQuestion constructor.
     * @param $id_voyage
     * @param $id_question
     * @param $regroupement
     * @param $question_cat_order
     * @param $question_order
     */
    public function __construct($id_voyage, $id_question, $regroupement, $question_cat_order, $question_order)
    {
        $this->id_voyage = $id_voyage;
        $this->id_question = $id_question;
        $this->regroupement = $regroupement;
        $this->question_cat_order = $question_cat_order;
        $this->question_order = $question_order;
    }

    /**
     * @return mixed
     */
    public function getIdVoyage()
    {
        return $this->id_voyage;
    }

    /**
     * @param mixed $id_voyage
     */
    public function setIdVoyage($id_voyage)
    {
        $this->id_voyage = $id_voyage;
    }

    /**
     * @return mixed
     */
    public function getIdQuestion()
    {
        return $this->id_question;
    }

    /**
     * @param mixed $id_question
     */
    public function setIdQuestion($id_question)
    {
        $this->id_question = $id_question;
    }

    /**
     * @return mixed
     */
    public function getRegroupement()
    {
        return $this->regroupement;
    }

    /**
     * @param mixed $regroupement
     */
    public function setRegroupement($regroupement)
    {
        $this->regroupement = $regroupement;
    }

    /**
     * @return mixed
     */
    public function getQuestionCatOrder()
    {
        return $this->question_cat_order;
    }

    /**
     * @param mixed $question_cat_order
     */
    public function setQuestionCatOrder($question_cat_order)
    {
        $this->question_cat_order = $question_cat_order;
    }

    /**
     * @return mixed
     */
    public function getQuestionOrder()
    {
        return $this->question_order;
    }

    /**
     * @param mixed $question_order
     */
    public function setQuestionOrder($question_order)
    {
        $this->question_order = $question_order;
    }




}
