<?php

namespace App\Controller;

use ActivationsDB;
use App\Model\Entity\Compte;
use App\Model\Entity\ComptesVoyage;
use App\Model\Entity\Programme;
use ComptesDB;
use ComptesVoyagesDB;
use ProgrammesDB;

require_once 'DBObjects/ProgrammesDB.php';
require_once 'DBObjects/ComptesDB.php';
require_once 'DBObjects/ActivationsDB.php';
require_once 'DBObjects/ComptesVoyagesDB.php';
require_once 'Controller/AppController.php';
require_once 'Entity/Programme.php';
require_once 'Entity/Compte.php';
require_once 'Entity/ComptesVoyage.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

class NoauthController extends AppController
{
    private $programmesDB;
    private $compteDB;
    private $activationsDB;
    private $compteVoyageDB;

    public function __construct()
    {
        $this->programmesDB = new ProgrammesDB();
        $this->compteDB = new ComptesDB();
        $this->activationsDB = new ActivationsDB();
        $this->compteVoyageDB = new ComptesVoyagesDB();
    }

    public function createAccount()
    {

        $programmes = $this->programmesDB->getAllProgrammes();

        //Passe les variables à la vue
        $this->set('programmes', $programmes);

        //Gère la réponse de la vue
        if (!empty($_POST)) {


            //Vérification des données reçue de la vue
            if (!isset($_POST['mot_de_passe']) || !isset($_POST['mot_de_passe_confirme']) || !($_POST['mot_de_passe'] === $_POST['mot_de_passe_confirme'])) {
                $this->flashBad('Les mots de passe ne correspondent pas');
                return $this->redirect('Noauth', 'CreateAccount');
            }

            if ($this->compteDB->pseudoExistOnlyPseudo($_POST['pseudo'])) {
                $this->flashBad('Ce nom d\'utilisateur existe déjà');
                return $this->redirect('Noauth', 'CreateAccount');
            }

            if (!$this->activationsDB->isValidCode($_POST['code_activation'])) {
                $this->flashBad('Le code d\'activation est invalide');
                return $this->redirect('Noauth', 'CreateAccount');
            }

            $activation = $this->activationsDB->getActivationFromCode($_POST['code_activation']);

            $date_naissance_str = $_POST['date_naissance']['year'] . "-" . $_POST['date_naissance']['month'] . "-" . $_POST['date_naissance']['day'];


            $pas31 = array(4, 6, 9, 11);

            $days = array(30, 31);

            if (in_array($_POST['date_naissance']['month'], $pas31) && ($_POST['date_naissance']['day'] == 31)) {
                $this->flashBad('Le compte n\'a pas pu être créé. Mauvaise saisie de date.');
                return $this->redirect('Noauth', 'CreateAccount');
            }

            if (!$this->isLeap($_POST['date_naissance']['year'])) {
                array_push($days, 29);
            }

            if (($_POST['date_naissance']['month'] == 2) && (in_array($_POST['date_naissance']['day'], $days))) {
                $this->flashBad('Le compte n\'a pas pu être créé. Mauvaise saisie de date.');
                return $this->redirect('Noauth', 'CreateAccount');
            }


            $date_naissance = date("Y-m-d", strtotime($date_naissance_str));

            $programme = $this->programmesDB->getProgrammeFromId($_POST['id_programme']);

            $compte = new Compte(
                null,
                $_POST['pseudo'],
                password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT),
                'etudiant',
                1,
                $_POST['courriel'],
                $_POST['nom'],
                $_POST['prenom'],
                $date_naissance,
                $_POST['telephone'],
                $programme,
                true
            );

            //Enregistre l’entité
            if ($idCompte = $this->compteDB->addCompteReturnId($compte)) {

                $compteVoyage = new ComptesVoyage(
                    $idCompte,
                    $activation->getVoyage()->getIdVoyage(),
                    null
                );

                //Enregistre l’entité
                if ($this->compteVoyageDB->addCompteVoyage($compteVoyage)) {

                    $this->activationsDB->setActivationActif0or1($activation, 0);

                    $this->flashGood('Votre compte a été créé.');
                    return $this->redirect('comptes', 'login');
                }
            }
            $this->flashBad('Votre compte n\'a pas pu être créé. Réessayez plus tard.');
            return $this->redirect('comptes', 'login');
        }
    }

    public function passwordRecover()
    {


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $courriel = $_POST['courriel'];
            $pseudo = $_POST['pseudo'];
            if (empty($_POST['pseudo'])) {
                $pseudo_err = "Veuillez renseigner ce champ";
            }

            if (empty($_POST['courriel'])) {
                $courriel_err = "Veuillez renseigner ce champ";
            }

            if (empty($pseudo_err) && empty($courriel_err)) {
                $result = $this->compteDB->checkifAcountEqualEmail($pseudo, $courriel);
                if (!empty($result)) {
                    if (!empty($pass = $this->compteDB->changePassFromID($result))) {
                        $this->send_email($courriel, $pseudo, $pass);
                        $this->redirect('Comptes', 'Login');
                    }
                } else {
                    $this->flashBad('Aucun compte n\'existe avec cette combinaison');
                    return $this->redirect('Noauth', 'PasswordRecover');
                }

            }
        }


    }

    function send_email($courriel, $pseudo, $newpass)
    {
        $mail = new PHPMailer(true);

         try {
             //Server settings
             $mail->isSMTP();                                            // Send using SMTP
             $mail->Host = 'smtp.mailtrap.io';                    // Set the SMTP server to send through
             $mail->SMTPAuth = true;                                   // Enable SMTP authentication
             $mail->Username = '0c6889d4c7b7a1';                     // SMTP username
             $mail->Password = '57468b537bbb17';                               // SMTP password
             $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
             $mail->Port = 2525;                                    // TCP port to connect to
             $mail->CharSet = 'UTF-8';
             //Recipients
             $mail->setFrom('mobilite.etudiante@cegeptr.qc.ca', 'Ressources Humaines');
             $mail->addAddress($courriel, $pseudo);     // Add a recipient

             // Content
             $mail->isHTML(true);                                  // Set email format to HTML
             $mail->Subject = 'Une demande de modification de mot de passe à été effectuée ';
             $mail->Body = 'Voici votre nouveau mot de passe :  <b>' . $newpass . '</b>';

             $mail->send();

         } catch (Exception $e) {
             die("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
         }

        mail($courriel,"Une demande de modification de mot de passe a été effectuée", "Voici votre nouveau mot de passe :" . $newpass , "From: agectr@edu.cegeptr.qc.ca");
    }


}
