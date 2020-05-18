<?php


namespace App\Model\Entity;


class Formulaire
{
    private $id_question;
    private $question_order;
    private $question_cat_order;

    /**
     * Formulaire constructor.
     * @param $id_question
     * @param $question_order
     * @param $question_cat_order
     */
    public function __construct($id_question, $question_order, $question_cat_order)
    {
        $this->id_question = $id_question;
        $this->question_order = $question_order;
        $this->question_cat_order = $question_cat_order;
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




}