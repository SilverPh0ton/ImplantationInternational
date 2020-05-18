<?php
namespace App\Model\Entity;


class Question
{
    private $id_question;
    private $categorie;
    private $question;
    private $input_option;
    private $affichage;
    private $actif;
    private $info_sup;
    private $regroupement;

    /**
     * Question constructor.
     * @param $id_question
     * @param $id_categorie
     * @param $question
     * @param $input_option
     * @param $affichage
     * @param $actif
     * @param $info_sup
     * @param $regroupement
     */
    public function __construct($id_question, Categorie $categorie, $question, $input_option, $affichage, $actif, $info_sup, $regroupement)
    {
        $this->id_question = $id_question;
        $this->categorie = $categorie;
        $this->question = $question;
        $this->input_option = $input_option;
        $this->affichage = $affichage;
        $this->actif = $actif;
        $this->info_sup = $info_sup;
        $this->regroupement = $regroupement;
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
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param mixed $id_categorie
     */
    public function setCategorie(Categorie $categorie)
    {
        $this->categorie = $categorie;
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
    public function getInputOption()
    {
        return $this->input_option;
    }

    /**
     * @param mixed $input_option
     */
    public function setInputOption($input_option)
    {
        $this->input_option = $input_option;
    }

    /**
     * @return mixed
     */
    public function getAffichage()
    {
        return $this->affichage;
    }

    /**
     * @param mixed $affichage
     */
    public function setAffichage($affichage)
    {
        $this->affichage = $affichage;
    }

    /**
     * @return mixed
     */
    public function getActif()
    {
        return $this->actif;
    }

    /**
     * @param mixed $actif
     */
    public function setActif($actif)
    {
        $this->actif = $actif;
    }

    /**
     * @return mixed
     */
    public function getInfoSup()
    {
        return $this->info_sup;
    }

    /**
     * @param mixed $info_sup
     */
    public function setInfoSup($info_sup)
    {
        $this->info_sup = $info_sup;
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

    public function validate()
    {
        if($this->id_question == null || !is_int($this->id_question))
        {
            return false;
        }

        if($this->id_categorie == null || !$this->categorie->validate())
        {
            return false;
        }

        if($this->question == null)
        {
            return false;
        }

        if($this->input_option == null ||strlen($this->input_option) > 100 )
        {
            return false;
        }

        if($this->affichage == null || strlen($this->affichage) > 30)
        {
            return false;
        }

        if($this->actif == null || !is_int($this->actif))
        {
            return false;
        }

        if($this->info_sup == null)
        {
            return false;
        }

        if($this->pour_prof == null || !is_int($this->pour_prof))
        {
            return false;
        }

        return true;
    }

}
