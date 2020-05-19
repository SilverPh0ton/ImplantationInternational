<?php
/**
 * @var App\Controller\VoyagesController $voyagesController
 * @var \App\Model\Entity\Voyage $voyage
 */

$id_voyage = $_GET['param1'];
$voyagesController->view($id_voyage);

$voyage = get('voyage');
$userCount = get('userCount');
?>

<div class="columns large-8 medium-10 small-12 large-centered medium-centered small-centered large-text-left medium-text-left small-text-left content" >
    <h3>Projet: <?= $voyage->getNomProjet() ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row">Pays</th>
            <td><?= $voyage->getDestination()->getNomPays() ?></td>
        </tr>
        <tr>
            <th scope="row">Ville</th>
            <td><?= $voyage->getVille() ?></td>
        </tr>
        <tr>
            <th scope="row">Note</th>
            <td><?= $voyage->getNote() ?></td>
        </tr>
        <tr>
            <th scope="row">Date de départ</th>
            <td><?= dateToFrench($voyage->getDateDepart()) ?></td>
        </tr>
        <tr>
            <th scope="row">Date de retour</th>
            <td><?= dateToFrench($voyage->getDateRetour()) ?></td>
        </tr>
        <tr>
            <th scope="row">Actif</th>
            <td><?= $voyage->getActif() ? 'Oui' : 'Non'; ?></td>
        </tr>
        <tr>
            <th scope="row">Participants</th>
            <td><?= $userCount ?> participant(s)</td>
        </tr>
        <tr>
            <th scope="row">Propositions d'origine</th>
            <td>
                <?= nav2(
                    '<img alt="afficher icon" src="Ressource/img/eye.png" class="images" data-toggle="tooltip" data-placement = "top" title = "Afficher">',
                    'Propositions',
                    'View',
                    $voyage->getIdProposition(),
                    $id_voyage);
                ?>
            </td>
        </tr>
    </table>

    <?= nav('<button>Revenir à la liste des voyages</button>', 'Voyages', 'index') ?>
</div>
