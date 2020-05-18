<?php
namespace App\Model\Entity;

class Voyage
{
   private $id_voyage;
   private $id_proposition;
   private $ville;
   private $cout;
   private $date_depart;
   private $date_limite;
   private $date_retour;
   private $actif;
   private $approuvee;
   private $destination;
   private $nom_projet;
   private $note;

    /**
     * Voyage constructor.
     * @param $id_voyage
     * @param $id_proposition
     * @param $ville
     * @param $cout
     * @param $date_depart
     * @param $date_limite
     * @param $date_retour
     * @param $actif
     * @param $approuvee
     * @param $id_destination
     * @param $nom_projet
     * @param $note
     */
    public function __construct($id_voyage,$id_proposition, $ville, $cout, $date_depart, $date_limite, $date_retour, $actif, $approuvee, $destination, $nom_projet, $note)
    {
        $this->id_voyage = $id_voyage;
        $this->id_proposition = $id_proposition;
        $this->ville = $ville;
        $this->cout = $cout;
        $this->date_depart = $date_depart;
        $this->date_limite = $date_limite;
        $this->date_retour = $date_retour;
        $this->actif = $actif;
        $this->approuvee = $approuvee;
        $this->destination = $destination;
        $this->nom_projet = $nom_projet;
        $this->note = $note;
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
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param mixed $id_destination
     */
    public function setDestination(Destination $destination)
    {
        $this->destination = $destination;
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

    public function validate()
    {
        if($this->id_voyage == null || !is_int($this->id_voyage))
        {
            return false;
        }

        if($this->ville == null || strlen($this->ville) > 50)
        {
            return false;
        }

        if($this->cout == null || !is_double($this->cout))
        {
            return false;
        }

        if($this->date_depart == null)
        {
            return false;
        }

        if($this->date_limite == null)
        {
            return false;
        }

        if($this->date_retour == null)
        {
            return false;
        }

        if($this->actif == null || !is_int($this->actif))
        {
            return false;
        }

        if($this->approuvee == null || !is_int($this->approuvee))
        {
            return false;
        }

        if($this->destination == null || !$this->destination->validate())
        {
            return false;
        }

        if($this->nom_projet == null || strlen($this->nom_projet) > 30)
        {
            return false;
        }

        if($this->note == null || strlen($this->note) > 200)
        {
            return false;
        }

        return true;
    }


}
