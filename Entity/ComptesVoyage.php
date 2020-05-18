<?php
namespace App\Model\Entity;


class ComptesVoyage
{

    private $id_compte;
    private $id_voyage;
    private $date_paiement;

    /**
     * ComptesVoyage constructor.
     * @param $id_compte
     * @param $id_voyage
     * @param $date_paiement
     */
    public function __construct($id_compte, $id_voyage, $date_paiement)
    {
        $this->id_compte = $id_compte;
        $this->id_voyage = $id_voyage;
        $this->date_paiement = $date_paiement;
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
    public function getDatePaiement()
    {
        return $this->date_paiement;
    }

    /**
     * @param mixed $date_paiement
     */
    public function setDatePaiement($date_paiement)
    {
        $this->date_paiement = $date_paiement;
    }

    public function validate()
    {
        if($this->id_compte == null)
        {
            return false;
        }

        if($this->id_voyage == null)
        {
            return false;
        }

        if($this->date_paiement == null)
        {
            return false;
        }
        return true;
    }




}
