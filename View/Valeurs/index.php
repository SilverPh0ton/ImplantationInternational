<?php
/**
 * @var \App\Controller\VoyagesQuestionsController $valeursController
 * @var \App\Model\Entity\Compte[] $comptes
 */
$id_voyage = $_GET['param1'];
$valeursController->index($id_voyage);

$nom_projet = get('nom_projet');
$comptes = get('comptes');

?>

<?= load_css('form') ?>
<?= load_css('ControlOption') ?>

<div class="valeurs index columns large-12 medium-12 small-12 content large-centered medium-centered small-centered large-text-left medium-text-left small-text-left">
            <h3><?= 'Liste de formulaire(s) pour le projet: ' . $nom_projet ?></h3>

            <table class="table_to_paginate">
                <thead>
                <tr>
                    <th scope="col">Nom d'utilisateur</th>
                    <th scope="col">Type</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Nom</th>
                    <th scope="col" class="actions"></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($comptes as $compte): ?>
                    <tr>
                        <td><?php echo($compte->getPseudo()) ?></td>
                        <td class='optionalField'>
                            <?php
                            if ($compte->getType() === 'etudiant') {
                                echo 'Étudiants';
                            } elseif ($compte->getType() === 'prof') {
                                echo 'Enseignant';
                            } elseif ($compte->getType() === 'admin') {
                                echo 'Administrateur';
                            }
                            ?>
                        </td>
                        <td><?php echo($compte->getPrenom()); ?></td>
                        <td><?php echo($compte->getNom()); ?></td>
                        <td class="actions">
                            <?= nav2(
                                '<img alt="afficher icon" src="Ressource/img/eye.png" class="images" data-toggle="tooltip" data-placement = "top" title = "Afficher">',
                                'Valeurs',
                                'Edit',
                                $id_voyage,
                                $compte->getIdCompte());
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <?=
            nav('<button type="button"> Retour aux séjours</button>', 'voyages', 'index');

            ?>
            <?php
            if (isset($_SESSION["connectedUser"])) {
                $connectedUser = $_SESSION["connectedUser"];
                $compteType = $connectedUser->getType();
            }
            if ($compteType == 'prof') {
                echo nav2('<button type="button"> Remplir mon formulaire </button>', 'valeurs', 'edit', $id_voyage, $connectedUser->getIdCompte());
            } ?>
</div>

<?= load_script('paginator') ?>

