<?php
/**
 * @var \App\Controller\StatistiqueController $statistiqueController
 * @var App\Controller\VoyagesController $voyagesController
 * @var \App\Model\Entity\Voyage[] $voyages
 * @var \App\Model\Entity\Compte[] $comptes
 * @var \App\Model\Entity\Compte $connectedUser
 * @var App\Controller\ComptesController $compteController ;
 */

$statistiqueController->index();
$voyages = get('voyages');

$compteStats = get('compteStats');
$voyagesStats = get('voyagesStats');

?>

<div class="columns large-8 medium-12 small-12 content large-centered medium-centered small-centered large-text-left medium-text-left small-text-left">

<h3>Statistiques</h3>

<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
<div id="card" class="row">
  <div class="col-sm">
      <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
      <div class="card-header"><i class="fas fa-users"></i><strong> Total des participants</strong></div>
        <div class="card-body">
          <h5 class="card-title" style="text-align:center"></h5>
          <p class="card-text" style="text-align: center; font-size: 20px">
            <?php echo $compteStats[0]; ?>
          </p>
        </div>
    </div>
  </div>
  <div class="col-sm">
      <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
      <div class="card-header"><i class="fas fa-plane"></i><strong> Total des projets</strong></div>
        <div class="card-body">
          <h5 class="card-title" style="text-align:center"></h5>
          <p class="card-text" style="text-align:center; font-size: 20px">
            <?php echo $voyagesStats[0]; ?>
          </p>
        </div>
    </div>
  </div>
</div>
<br>
<table class="table_to_paginate">
    <thead>
    <tr>
        <th scope="col">Nom du projet</th>
        <th scope="col">Pays</th>
        <th scope="col">Ville</th>
        <th scope="col">Année</th>
        <th scope="col">Total étudiant</th>
        <th scope="col">Total accompagnateur</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($voyages as $voyage):
        ?>
        <tr>
            <td> <?= $voyage->getNomProjet() ?></td>
            <td> <?= $voyage->getDestination()->getNomPays() ?></td>
            <td> <?= $voyage->getVille() ?></td>
            <td class='optionalField' data-sort="<?=$voyage->getDateDepart()?>">
                <?= dateToFrench($voyage->getDateDepart()) ?></td>
            <td>requete</td>
            <td>requete</td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?= load_script('codeMask') ?>
<script>
    var order = [[ 7, 'desc' ],[ 5, 'asc' ],[ 0, 'asc' ]];
</script>
<?= load_script('paginator') ?>
