<?php
namespace App\Model\Entity;


class Activite
{
    private $id_activite;
    private $id_proposition;
    private $endroit;
    private $description;
    private $date_depart;
    private $date_retour;

    /**
     * Activite constructor.
     * @param $id_activite
     * @param $endroit
     * @param $description
     * @param $date_depart
     * @param $date_retour
     */
    public function __construct($id_activite, $id_proposition, $endroit, $description, $date_depart, $date_retour)
    {
        $this->id_activite = $id_activite;
        $this->id_proposition = $id_proposition;
        $this->endroit = $endroit;
        $this->description = $description;
        $this->date_depart = $date_depart;
        $this->date_retour = $date_retour;
    }


    /**
     * @return mixed
     */
    public function getIdActivite()
    {
        return $this->id_activite;
    }

    /**
     * @param mixed $id_activite
     */
    public function setIdActivite($id_activite)
    {
        $this->id_activite = $id_activite;
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
    public function getEndroit()
    {
        return $this->endroit;
    }

    /**
     * @param mixed $endroit
     */
    public function setEndroit($endroit)
    {
        $this->endroit = $endroit;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
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


}