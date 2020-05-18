<?php
namespace App\Model\Entity;


class Activation
{
    private $id_activation;
    private $code_activation;
    private $voyage;
    private $actif;

    /**
     * Activation constructor.
     * @param $id_activation
     * @param $code_activation
     * @param $voyage
     * @param $actif
     */
    public function __construct($id_activation, $code_activation,Voyage $voyage, $actif)
    {
        $this->id_activation = $id_activation;
        $this->code_activation = $code_activation;
        $this->voyage = $voyage;
        $this->actif = $actif;
    }

    /**
     * @return mixed
     */
    public function getIdActivation()
    {
        return $this->id_activation;
    }

    /**
     * @param mixed $id_activation
     */
    public function setIdActivation($id_activation)
    {
        $this->id_activation = $id_activation;
    }

    /**
     * @return mixed
     */
    public function getCodeActivation()
    {
        return $this->code_activation;
    }

    /**
     * @param mixed $code_activation
     */
    public function setCodeActivation($code_activation)
    {
        $this->code_activation = $code_activation;
    }

    /**
     * @return mixed
     */
    public function getVoyage()
    {
        return $this->voyage;
    }

    /**
     * @param mixed $voyage
     */
    public function setVoyage(Voyage $voyage)
    {
        $this->voyage = $voyage;
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
        if($this->id_activation == null || !is_int($this->id_activation))
        {
            return false;
        }

        if($this->code_activation == null || strlen($this->code_activation) > 30)
        {
            return false;
        }

        if($this->actif == null || !is_int($this->actif))
        {
            return false;
        }

        if($this->voyage == null || !$this->voyage->validate())
        {
            return false;
        }

        return true;
    }


}
