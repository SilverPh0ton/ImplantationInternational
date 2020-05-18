<?php
namespace App\Model\Entity;


class Programme
{
    private $id_programme;
    private $nom_programme;
    private $actif;

    /**
     * Programme constructor.
     * @param $id_programme
     * @param $nom_programme
     * @param $actif
     */
    public function __construct($id_programme, $nom_programme, $actif)
    {
        $this->id_programme = $id_programme;
        $this->nom_programme = $nom_programme;
        $this->actif = $actif;
    }

    /**
     * @return mixed
     */
    public function getIdProgramme()
    {
        return $this->id_programme;
    }

    /**
     * @param mixed $id_programme
     */
    public function setIdProgramme($id_programme)
    {
        $this->id_programme = $id_programme;
    }

    /**
     * @return mixed
     */
    public function getNomProgramme()
    {
        return $this->nom_programme;
    }

    /**
     * @param mixed $nom_programme
     */
    public function setNomProgramme($nom_programme)
    {
        $this->nom_programme = $nom_programme;
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

}
