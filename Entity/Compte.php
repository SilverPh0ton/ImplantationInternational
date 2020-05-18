<?php
namespace App\Model\Entity;

class Compte
{

    private $id_compte;
    private $pseudo;
    private $mot_de_passe;
    private $type;
    private $actif;
    private $courriel;
    private $nom;
    private $prenom;
    private $date_naissance;
    private $telephone;
    private $programme;

    /**
     * Compte constructor.
     * @param $id_compte
     * @param $pseudo
     * @param $mot_de_passe
     * @param $type
     * @param $actif
     * @param $courriel
     * @param $nom
     * @param $prenom
     * @param $date_naissance
     * @param $telephone
     * @param $programme
     */
    public function __construct($id_compte, $pseudo, $mot_de_passe, $type, $actif, $courriel, $nom, $prenom, $date_naissance, $telephone, Programme $programme)
    {
        $this->id_compte = $id_compte;
        $this->pseudo = $pseudo;
        $this->mot_de_passe = $mot_de_passe;
        $this->type = $type;
        $this->actif = $actif;
        $this->courriel = $courriel;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->date_naissance = $date_naissance;
        $this->telephone = $telephone;
        $this->programme = $programme;
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
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param mixed $pseudo
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    /**
     * @return mixed
     */
    public function getMotDePasse()
    {
        return $this->mot_de_passe;
    }

    /**
     * @param mixed $mot_de_passe
     */
    public function setMotDePasse($mot_de_passe)
    {
        $this->mot_de_passe =hash('SHA256', $mot_de_passe);
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
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
    public function getCourriel()
    {
        return $this->courriel;
    }

    /**
     * @param mixed $courriel
     */
    public function setCourriel($courriel)
    {
            $this->courriel = $courriel;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getDateNaissance()
    {
        return $this->date_naissance;
    }

    /**
     * @param mixed $date_naissance
     */
    public function setDateNaissance($date_naissance)
    {
        $this->date_naissance = $date_naissance;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return mixed
     */
    public function getProgramme()
    {
        return $this->programme;
    }


    public function setProgramme(Programme $programme)
    {
        $this->programme = $programme;
    }

    public function validate()
    {
        if($this->id_compte == null || !is_int($this->id_compte))
        {
            return false;
        }

        if($this->pseudo == null || strlen($this->pseudo) > 30)
        {
            return false;
        }

        if($this->mot_de_passe == null || strlen($this->mot_de_passe) > 255)
        {
            return false;
        }

        if($this->type == null || strlen($this->type) > 10)
        {
            return false;
        }

        if($this->actif == null || !is_int($this->actif))
        {
            return false;
        }

        if($this->courriel == null || strlen($this->courriel) > 50)
        {
            return false;
        }

        if($this->nom == null || strlen($this->nom) > 30)
        {
            return false;
        }

        if($this->prenom == null || strlen($this->prenom) > 30)
        {
            return false;
        }

        if($this->telephone == null || strlen($this->telephone) > 20)
        {
            return false;
        }

        if($this->date_naissance == null)
        {
            return false;
        }

        if($this->programme == null || !$this->programme->validate())
        {
            return false;
        }

        return true;
    }

}
