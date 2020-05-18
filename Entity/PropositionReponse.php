<?php


namespace App\Model\Entity;


class PropositionReponse
{
    private $id_proposition;
    private $question;
    private $reponse;

    /**
     * PropositionReponse constructor.
     * @param $id_proposition
     * @param $question
     * @param $reponse
     */
    public function __construct($id_proposition, $question, $reponse)
    {
        $this->id_proposition = $id_proposition;
        $this->question = $question;
        $this->reponse = $reponse;
    }

    /**
     * @return mixed
     */
    public function getIdProposition()
    {
        return $this->id_proposition;
    }

    /**
     * @param mixed $id_proposition
     */
    public function setIdProposition($id_proposition)
    {
        $this->id_proposition = $id_proposition;
    }

    /**
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param mixed $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * @return mixed
     */
    public function getReponse()
    {
        return $this->reponse;
    }

    /**
     * @param mixed $reponse
     */
    public function setReponse($reponse)
    {
        $this->reponse = $reponse;
    }




}