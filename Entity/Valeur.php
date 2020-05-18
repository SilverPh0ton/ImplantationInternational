<?php
namespace App\Model\Entity;


class Valeur
{
    private $id_compte;
    private $id_voyage;
    private $id_question;
    private $reponse;

    /**
     * Valeur constructor.
     * @param $id_compte
     * @param $id_voyage
     * @param $id_question
     * @param $reponse
     */
    public function __construct($id_compte, $id_voyage, $id_question, $reponse)
    {
        $this->id_compte = $id_compte;
        $this->id_voyage = $id_voyage;
        $this->id_question = $id_question;
        $this->reponse = $reponse;
    }


    /**
     * @return mixed
     */
    public function getIdCompte()
    {
        return $this->id_compte;
    }

    /**
     * @param mixed $id_compte
     */
    public function setIdCompte($id_compte)
    {
        $this->id_compte = $id_compte;
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
