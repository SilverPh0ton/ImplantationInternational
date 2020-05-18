<?php
namespace App\Model\Entity;

class Proposition
{
    private $id_proposition;
    private $id_compte;
    private $nom_projet;
    private $ville;
    private $activites; //ARRAY OF ACTIVITIES
    private $cout;
    private $date_depart;
    private $date_limite;
    private $date_retour;
    private $actif;
    private $approuvee;
    private $msg_refus;
    private $destination;
    private $note;

    /**
     * Proposition constructor.
     * @param $id_proposition
     * @param $id_compte
     * @param $id_formulaire
     * @param $nom_projet
     * @param $ville
     * @param $activites
     * @param $cout
     * @param $date_depart
     * @param $date_limite
     * @param $date_retour
     * @param $actif
     * @param $approuvee
     * @param $destination
     * @param $note
     */
    public function __construct($id_proposition, $id_compte, $nom_projet, $ville, $activites, /*$cout,*/ $date_depart, /*$date_limite,*/ $date_retour, $actif, $approuvee,$msg_refus, $destination, $note)
    {
        $this->id_proposition = $id_proposition;
        $this->id_compte = $id_compte;
        $this->nom_projet = $nom_projet;
        $this->ville = $ville;
        $this->activites = $activites;/*
        $this->cout = $cout;*/
        $this->date_depart = $date_depart;/*
        $this->date_limite = $date_limite;*/
        $this->date_retour = $date_retour;
        $this->actif = $actif;
        $this->approuvee = $approuvee;
        $this->msg_refus = $msg_refus;
        $this->destination = $destination;
        $this->note = $note;
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
    public function getNomProjet()
    {
        return $this->nom_projet;
    }

    /**
     * @param mixed $nom_projet
     */
    public function setNomProjet($nom_projet)
    {
        $this->nom_projet = $nom_projet;
    }

    /**
     * @return mixed
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param mixed $ville
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    /**
     * @return mixed
     */
    public function getActivites()
    {
        return $this->activites;
    }

    /**
     * @param mixed $activites
     */
    public function setActivites($activites)
    {
        $this->activites = $activites;
    }

    /**
     * @return mixed
     */
    public function getCout()
    {
        return $this->cout;
    }

    /**
     * @param mixed $cout
     */
    public function setCout($cout)
    {
        $this->cout = $cout;
    }

    /**
     * @return mixed
     */
    public function getDateDepart()
    {
        return $this->date_depart;
    }

    /**
     * @param mixed $date_depart
     */
    public function setDateDepart($date_depart)
    {
        $this->date_depart = $date_depart;
    }

    /**
     * @return mixed
     */
    public function getDateLimite()
    {
        return $this->date_limite;
    }

    /**
     * @param mixed $date_limite
     */
    public function setDateLimite($date_limite)
    {
        $this->date_limite = $date_limite;
    }

    /**
     * @return mixed
     */
    public function getDateRetour()
    {
        return $this->date_retour;
    }

    /**
     * @param mixed $date_retour
     */
    public function setDateRetour($date_retour)
    {
        $this->date_retour = $date_retour;
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
    public function getApprouvee()
    {
        return $this->approuvee;
    }

    /**
     * @param mixed $approuvee
     */
    public function setApprouvee($approuvee)
    {
        $this->approuvee = $approuvee;
    }

    /**
     * @return mixed
     */
    public function getMsgRefus()
    {
        return $this->msg_refus;
    }

    /**
     * @param mixed $msg_refus
     */
    public function setMsgRefus($msg_refus)
    {
        $this->msg_refus = $msg_refus;
    }



    /**
     * @return mixed
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param mixed $destination
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param mixed $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }



}