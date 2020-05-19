<?php

use App\Model\Entity\Destination;

require_once 'Entity\Destination.php';
require_once 'Entity\Voyage.php';
require_once 'Entity\Activation.php';

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Activation[]|\Cake\Collection\CollectionInterface $activations
 * @var string $voyage
 * @var App\Controller\ActivationsController $activationController;
 */


$id_voyage = $_GET["param1"];
$activationController->index($id_voyage);

$nom_projet = get('nom_projet');
$activations = get('acti_array');

?>

<div class="activations index large-12 medium-12 small-12 content large-text-left medium-text-left small-text-left">

    <h3>Codes d'activation pour: <?= $nom_projet ?></h3>

    <?=  nav1('<button class="add-btn">Générer des codes </button>','Activations','add',$id_voyage); ?>

    <?php if (is_array($activations) && sizeof($activations) != 0) : ?>

        <table class="table_to_paginate">
            <thead>
            <tr>
                <th scope="col">Code(s) d'activation</th>
                <th scope="col">Actif</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($activations as $activation):
                $color = $activation->getActif() ? '' : 'style="color: #aaaaaa"'
                ?>
                <tr>
                    <td <?php echo $color ?> ><?= $activation->getCodeActivation() ?></td>
                    <td <?php echo $color ?> ><?= $activation->getActif() ? 'Oui' : 'Non'; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    <?php else: ?>

        <H1>Il n'y a aucun code d'activation pour ce séjour</H1>

    <?php endif ?>

    <!--Button de navigation -->
    <?=  nav('<button>Revenir à la liste des voyages</button>','Voyages','index'); ?>

</div>

<?= load_script('paginator') ?>
