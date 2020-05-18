<?php
namespace App\Model\Entity;


class Destination

{
    private $id_destination;
    private $nom_pays;
    private $actif;

    /**
     * Destination constructor.
     * @param $id_destination
     * @param $nom_pays
     * @param $actif
     */
    public function __construct($id_destination, $nom_pays, $actif)
    {
        $this->id_destination = $id_destination;
        $this->nom_pays = $nom_pays;
        $this->actif = $actif;
    }

    /**
     * @return mixed
     */
    public function getIdDestination()
    {
        return $this->id_destination;
    }

    /**
     * @param mixed $id_destination
     */
    public function setIdDestination($id_destination)
    {
        $this->id_destination = $id_destination;
    }

    /**
     * @return mixed
     */
    public function getNomPays()
    {
        return $this->nom_pays;
    }

    /**
     * @param mixed $nom_pays
     */
    public function setNomPays($nom_pays)
    {
        $this->nom_pays = $nom_pays;
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

    public function validate()
    {
        if($this->id_destination == null || !is_int($this->id_destination))
        {
            return false;
        }

        if($this->nom_pays == null || strlen($this->nom_pays) > 50)
        {
            return false;
        }

        if($this->actif == null || !is_int($this->actif))
        {
            return false;
        }
        return true;
    }


}
