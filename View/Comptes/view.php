<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Compte $compte
 * @var  \App\Controller\ComptesController $comptesController
 */
/*$session = $this->request->getSession();
$user_data = $session->read('Auth.User');*/

$id_compte = $_GET['param1'];
$comptesController->view($id_compte);

$compte = get('compte');
$listVoyage = get('listVoyage');


?>

<div class="comptes view columns large-8 medium-10 small-12 large-centered medium-centered small-centered large-text-left medium-text-left small-text-left content">


    <h3>Compte de: <?= $compte->getPseudo() ?></h3>

    <table class="vertical-table">
        <tr>
            <th scope="row">Nom d'utilisateur</th>
            <td><?= $compte->getPseudo() ?></td>
        </tr>
        <tr>
            <th scope="row">Type</th>
            <td>
                <?php
                if ($compte->getType() === 'etudiant') {
                    echo 'Étudiants';
                } elseif ($compte->getType() === 'prof') {
                    echo 'Accompagnateur';
                } elseif ($compte->getType()  === 'admin') {
                    echo 'Administrateur';
                }
                ?>
            </td>
        </tr>
        <tr>
            <th scope="row">Courriel</th>
            <td><?= $compte->getCourriel() ?></td>
        </tr>
        <tr>
            <th scope="row">Prénom</th>
            <td><?= $compte->getPrenom() ?></td>
        </tr>
        <tr>
            <th scope="row">Nom</th>
            <td><?= $compte->getNom() ?></td>
        </tr>
        <tr>
            <th scope="row">Téléphone</th>
            <td><?= $compte->getTelephone() ?></td>
        </tr>
        <tr>
            <th scope="row">Programme</th>
            <td><?= $compte->getProgramme()->getNomProgramme() ?></td>
        </tr>
        <tr>
            <th scope="row">Date de naissance</th>
            <td><?=dateToFrench($compte->getDateNaissance()) ?></td>
        </tr>

        <?php if($compte->getType() != 'admin'):?>
            <tr>
                <th scope="row">Voyage(s) associé(s)</th>
                <td><?=$listVoyage?></td>
            </tr>
        <?php endif; ?>

    </table>

    <!--Button de navigation -->
    <?php
    if(isOfType([ADMIN,PROF])){
        echo nav('<button> Retour à la liste des comptes </button>', 'Comptes', 'index');
    }
    else{
        echo nav('<button type="button">Revenir à la liste des voyages</button>', 'Voyages', 'index');
    }
    ?>

    <?= nav1('<button type="button"> Modifier ce compte </button>','Comptes','edit',$compte->getIdCompte());?>


</div>
