<?php

use App\Model\Entity\Compte;

include_once 'DBObjects/ConfigDB.php';
require_once 'DBObjects/ProgrammesDB.php';
require_once 'Entity/Compte.php';

class ComptesDB extends ConfigDB
{
    private $programmeDB;

    /**
     * ComptesDB constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->programmeDB = new ProgrammesDB();
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    public function getCompteFromId($id_compte)
    {
        if (isset($id_compte)) {
            $sql = "SELECT * FROM comptes WHERE id_compte = :id_compte";

            if ($stmt = $this->conn->prepare($sql)) {

                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":id_compte", $id_compte, PDO::PARAM_INT);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    // Check if username exists, if yes then verify password
                    if ($stmt->rowCount() == 1) {

                        if ($row = $stmt->fetch()) {

                            $programme = $this->programmeDB->getProgrammeFromId($row['id_programme']);

                            $compte = new Compte(
                                $row["id_compte"],
                                $row["pseudo"],
                                $row["mot_de_passe"],
                                $row["type"],
                                $row["actif"],
                                $row["courriel"],
                                $row["nom"],
                                $row['prenom'],
                                $row['date_naissance'],
                                $row['telephone'],
                                $programme
                            );

                            return $compte;

                        } else {
                            return null;
                        }

                    } else {
                        return null;
                    }

                } else {
                    return null;
                }

                // Close statement
                unset($stmt);

            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    function getCompteFromCourrielAndMDP($courriel, $mot_de_passe)
    {
        if (isset($courriel) && strlen($courriel) < 51 && isset($mot_de_passe)) {
            $sql = "SELECT * FROM comptes WHERE courriel = :courriel AND mot_de_passe = :mot_de_passe";

            if ($stmt = $this->conn->prepare($sql)) {

                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":courriel", $courriel, PDO::PARAM_STR);
                $stmt->bindParam(":mot_de_passe", $mot_de_passe, PDO::PARAM_STR);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    // Check if username exists, if yes then verify password
                    if ($stmt->rowCount() == 1) {

                        if ($row = $stmt->fetch()) {
                            $programme = $this->programmeDB->getProgrammeFromId($row['id_programme']);

                            $compte = new Compte(
                                $row["id_compte"],
                                $row["pseudo"],
                                $row["mot_de_passe"],
                                $row["type"],
                                $row["actif"],
                                $row["courriel"],
                                $row["nom"],
                                $row['prenom'],
                                $row['date_naissance'],
                                $row['telephone'],
                                $programme
                            );

                            return $compte;

                        } else {
                            return null;
                        }

                    } else {
                        return null;
                    }

                } else {
                    return null;
                }

                // Close statement
                unset($stmt);

            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    function getCompteFromPseudoAndMDP($pseudo, $mot_de_passe)
    {
        if (isset($pseudo) && strlen($pseudo) < 31 && isset($mot_de_passe)) {
            $sql = "SELECT * FROM comptes WHERE pseudo = :pseudo";

            if ($stmt = $this->conn->prepare($sql)) {

                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    // Check if username exists, if yes then verify password
                    if ($stmt->rowCount() == 1) {

                        if ($row = $stmt->fetch()) {
                            $programme = $this->programmeDB->getProgrammeFromId($row['id_programme']);

                            $compte = new Compte(
                                $row["id_compte"],
                                $row["pseudo"],
                                $row["mot_de_passe"],
                                $row["type"],
                                $row["actif"],
                                $row["courriel"],
                                $row["nom"],
                                $row['prenom'],
                                $row['date_naissance'],
                                $row['telephone'],
                                $programme
                            );

                            // Close statement
                            unset($stmt);

                            if(password_verify($mot_de_passe,$row["mot_de_passe"])){
                                return $compte;
                            }else{
                                return null;
                            }


                        } else {
                            return null;
                        }
                    } else {
                        return null;
                    }
                } else {
                    return null;
                }
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    function getAllComptes()
    {
        $comptes = array();
        $sql = "SELECT * from comptes ORDER BY actif DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $comptesInfo = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($comptesInfo as $compteInfo) {
            $programme = $this->programmeDB->getProgrammeFromId($compteInfo['id_programme']);

            $compte = new Compte(
                $compteInfo['id_compte'],
                $compteInfo['pseudo'],
                $compteInfo['mot_de_passe'],
                $compteInfo['type'],
                $compteInfo['actif'],
                $compteInfo['courriel'],
                $compteInfo['nom'],
                $compteInfo['prenom'],
                $compteInfo['date_naissance'],
                $compteInfo['telephone'],
                $programme
            );

            array_push($comptes, $compte);
        }

        return $comptes;
    }

    function addCompte($compte)
    {
        if (isset($compte)) {
            $stmtExist = $this->conn->prepare("SELECT count(*) from comptes where courriel = :courriel");
            $stmtExist->execute(array(':courriel' => $compte->getCourriel()));
            $compteCtr = $stmtExist->fetchColumn();

            if ($compteCtr == 0) {
                $sql = "INSERT INTO comptes (pseudo, mot_de_passe,type,actif,courriel,nom,prenom,date_naissance,telephone, id_programme) VALUES(:pseudo, :mot_de_passe, :type, :actif, :courriel, :nom, :prenom, :date_naissance, :telephone, :id_programme)";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute(array(
                    ':pseudo' => $compte->getPseudo(),
                    ':mot_de_passe' =>password_hash($compte->getMotDePasse(), PASSWORD_DEFAULT),
                    ':type' => $compte->getType(),
                    ':actif' => $compte->getActif(),
                    ':courriel' => $compte->getCourriel(),
                    ':nom' => $compte->getNom(),
                    ':prenom' => $compte->getPrenom(),
                    ':date_naissance' => $compte->getDateNaissance(),
                    ':telephone' => $compte->getTelephone(),
                    ':id_programme' => $compte->getProgramme()->getIdProgramme()
                ));

                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function addCompteReturnId($compte)
    {
        if (isset($compte)) {
            $stmtExist = $this->conn->prepare("SELECT count(*) from comptes where courriel = :courriel");
            $stmtExist->execute(array(':courriel' => $compte->getCourriel()));
            $compteCtr = $stmtExist->fetchColumn();

            if ($compteCtr == 0) {
                $sql = "INSERT INTO comptes (pseudo, mot_de_passe,type,actif,courriel,nom,prenom,date_naissance,telephone, id_programme) VALUES(:pseudo, :mot_de_passe, :type, :actif, :courriel, :nom, :prenom, :date_naissance, :telephone, :id_programme)";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute(array(
                    ':pseudo' => $compte->getPseudo(),
                    ':mot_de_passe' => $compte->getMotDePasse(),
                    ':type' => $compte->getType(),
                    ':actif' => $compte->getActif(),
                    ':courriel' => $compte->getCourriel(),
                    ':nom' => $compte->getNom(),
                    ':prenom' => $compte->getPrenom(),
                    ':date_naissance' => $compte->getDateNaissance(),
                    ':telephone' => $compte->getTelephone(),
                    ':id_programme' => $compte->getProgramme()->getIdProgramme()
                ));

                return $this->conn->lastInsertId();
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    function updateCompte(Compte $newCompte)
    {
        if (isset($newCompte)) {
                $sql = "UPDATE comptes SET
                pseudo = :pseudo,
                type = :type,
                actif = :actif,
                courriel = :courriel,
                nom = :nom,
                prenom = :prenom,
                date_naissance = :date_naissance,
                telephone = :telephone,
                id_programme = :id_programme
                WHERE id_compte = :idCompte ";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute(array(':pseudo' => $newCompte->getPseudo(),
                    ':type' => $newCompte->getType(),
                    ':actif' => $newCompte->getActif(),
                    ':courriel' => $newCompte->getCourriel(),
                    ':nom' => $newCompte->getNom(),
                    ':prenom' => $newCompte->getPrenom(),
                    ':date_naissance' => $newCompte->getDateNaissance(),
                    ':telephone' => $newCompte->getTelephone(),
                    ':id_programme' => $newCompte->getProgramme()->getIdProgramme(),
                    ':idCompte' => $newCompte->getIdCompte()
                ));

                return true;
        } else {
            return false;
        }
    }

    function updateMDP($id_compte, $mot_de_passe)
    {
        if (isset($id_compte) && isset($mot_de_passe)) {
            $stmtExist = $this->conn->prepare("SELECT count(*) from comptes where id_compte = :idCompte");
            $stmtExist->execute(array(':idCompte' => $id_compte));
            $compteCtr = $stmtExist->fetchColumn();

            if ($compteCtr == 1) {
                $sql = "UPDATE comptes SET
                mot_de_passe = :mot_de_passe
                WHERE id_compte = :idCompte ";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute(array(':mot_de_passe' => password_hash($mot_de_passe, PASSWORD_DEFAULT), ':idCompte' => $id_compte));

                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function pseudoExist($pseudo, $compteId)
    {
        if (isset($pseudo) && strlen($pseudo) < 31 && isset($compteId)) {
            $sql = "SELECT * FROM comptes WHERE pseudo = :pseudo AND id_compte != :compteId";

            if ($stmt = $this->conn->prepare($sql)) {

                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
                $stmt->bindParam(":compteId", $compteId, PDO::PARAM_INT);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    // Check if username exists, if yes then verify password
                    if ($stmt->rowCount() == 1) {
                        return true;
                    }
                    return false;
                } else {
                    return null;
                }
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    function pseudoExistOnlyPseudo($pseudo)
    {
        if (isset($pseudo) && strlen($pseudo) < 31) {
            $sql = "SELECT * FROM comptes WHERE pseudo = :pseudo";

            if ($stmt = $this->conn->prepare($sql)) {

                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    // Check if username exists, if yes then verify password
                    if ($stmt->rowCount() == 1) {
                        return true;
                    }
                    return false;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    function checkifAcountEqualEmail($username,$email){

        $sql = "SELECT * FROM comptes WHERE pseudo = :pseudo AND courriel = :email";

        if ($stmt = $this->conn->prepare($sql)) {

            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":pseudo", $username, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Check if acount exist with this username AND email
                if ($stmt->rowCount() == 1) {
                    return $stmt->fetch()['id_compte'];
                }
                return false;
            } else {
                return null;
            }
        } else {
            return null;
        }

    }

    function randomPassword() {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    function changePassFromID($id){



        // Prepare an update statement
        $sql = "UPDATE comptes SET mot_de_passe=:password WHERE id_compte=:id";

        $newPass = $this->randomPassword();

        if ($stmt = $this->conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":password", $param_password);
            $stmt->bindParam(":id", $param_id);

            // Set parameters
            $param_password = password_hash($newPass, PASSWORD_DEFAULT);
            $param_id = $id;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                return $newPass;
            } else {
                return false;
            }
        }else{
            return false;
        }
    }

    public function promoteUserToProf($id)
    {
        if (isset($id)) {
            $stmtExist = $this->conn->prepare("UPDATE comptes SET `type` = 'prof' WHERE id_compte = :id");
            if($stmtExist->execute(array(':id' => $id)))
            {
                return true;
            }
            return false;
        } else {
            return false;
        }
    }

    public function getAllUsers()
    {
        $sql=  " SELECT EXTRACT(year FROM v.date_retour) AS ANNEE, COUNT(v.date_retour) as NB
                 FROM voyages v
                 WHERE v.date_retour <= sysdate()
                 GROUP BY ANNEE
                 ORDER BY ANNEE DESC
                 LIMIT 5";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $stats = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $stats;
    }

    public function getProgrammes()
    {
        $sql = "SELECT COUNT(DISTINCT(p.id_programme)) AS NB, EXTRACT(year FROM v.date_retour) AS ANNEE
                FROM comptes c
                INNER JOIN comptes_voyages cv ON cv.id_compte = c.id_compte
                INNER JOIN voyages v ON v.id_voyage = cv.id_voyage
                INNER JOIN programmes p ON p.id_programme = c.id_programme
                WHERE v.date_retour <= sysdate()
                GROUP BY ANNEE
                ORDER BY ANNEE DESC
                LIMIT 5";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $stats = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $stats;
    }

    public function getAccompagnateurDestination()
    {
        $sql = "SELECT DISTINCT(v.nom_projet), d.nom_pays, v.ville, EXTRACT(YEAR FROM v.date_retour) AS Annee, COUNT(*) AS NB
        FROM voyages v
        INNER JOIN comptes_voyages cv ON cv.id_voyage = v.id_voyage
        INNER JOIN comptes c ON c.id_compte = cv.id_compte
        INNER JOIN destinations d ON d.id_destination = v.id_destination
        WHERE c.type = 'prof' AND v.date_retour <= sysdate()
        GROUP BY ANNEE
        ORDER BY ANNEE DESC
        LIMIT 5";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $stats = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $stats;
    }

    public function getEtudiantDestination()
    {
        $sql= "SELECT DISTINCT(v.nom_projet), d.nom_pays, v.ville, EXTRACT(YEAR FROM v.date_retour) AS Annee, COUNT(*) AS NB
               FROM voyages v
               INNER JOIN comptes_voyages cv ON cv.id_voyage = v.id_voyage
               INNER JOIN comptes c ON c.id_compte = cv.id_compte
               INNER JOIN destinations d ON d.id_destination = v.id_destination
               WHERE c.type = 'etudiant' AND v.date_retour <= sysdate()
               GROUP BY ANNEE
        		   ORDER BY ANNEE DESC
		           LIMIT 5";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $stats = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $stats;
    }
}
