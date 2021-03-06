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
$countryStats = get('countryStats');
$programmeStats = get('programmeStats');
$destinationStats = get('destinationStats');
$futurProjetStats = get('futurProjetStats');
$accStats = get('accStats');
$etuStats = get('etuStats');

?>
<?= load_css('ControlOption') ?>
<?= load_css('tab')?>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js" crossorigin="anonymous"></script>

<div class="statistiques index columns large-12 medium-12 small-12 large-text-left medium-text-left small-text-left content">

<h3>Statistiques</h3>
<div class="tab">
    <button id="general" class="tablinks active" onclick="openTab(event, 'generalTab')">Général</button>
    <button id="etudiants_sejour" class="tablinks" onclick="openTab(event, 'etudiantsTab')">Nombre d'étudiants par séjour</button>
    <button id="accompagnateurs_sejour" class="tablinks" onclick="openTab(event, 'accompagnateursTab')">Nombre d'accompagnateurs par séjour</button>
    <button id="destinations_sejour" class="tablinks" onclick="openTab(event, 'destinationsTab')">Nombre de séjours par destination</button>
    <button id="futurProjet_sejour" class="tablinks" onclick="openTab(event, 'futurProjetTab')">Projets à venir</button>
</div>

<!-- FIRST TAB CONTROL -->
<div class="tab tabContainer">
  <!-- TAB GENERAL -->
  <div id="generalTab" class="tabcontent" style="display: block">
    <br>
    <!-- CARD PARTICIPANTS FIRST ROW -->
    <div id="card" class="row">
      <div class="col-sm">
          <div class="card text-white bg-primary mb-3" id="cardID" style="max-width: 24rem;">
            <div class="card-header"><i class="fas fa-users"></i><strong> Total des participants</strong></div>
              <div class="card-body">
                <h5 class="card-title" style="text-align:center"></h5>
                <p class="card-text" style="text-align: center; font-size: 20px">
                  <div class="card bg-primary" id="cardID" style="width: 18rem;">
                    <table class="card-table table" id="cardColor">
                      <thead>
                        <tr id="cardColor">
                          <th scope="col" id="cardColor">Année</th>
                          <th scope="col" id="cardColor">Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($compteStats as $compteStat):
                            ?>
                            <tr>
                                <td id="cardColor"><?= $compteStat['ANNEE']?></td>
                                <td id="cardColor"><?= $compteStat['NB']?></td>
                            </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </p>
              </div>
            </div>
          </div>
<!-- CARD PROJECTS -->
      <div class="col-sm">
          <div class="card text-white bg-info mb-3" id="cardID" style="max-width: 24rem;">
          <div class="card-header"><i class="fas fa-map"></i><strong> Total des projets</strong></div>
            <div class="card-body">
              <h5 class="card-title" style="text-align:center"></h5>
              <p class="card-text" style="text-align:center; font-size: 20px">
                <div class="card bg-info" id="cardID" style="width: 18rem;">
                  <table class="card-table table" id="cardColor">
                    <thead>
                      <tr id="cardColor">
                        <th scope="col" id="cardColor">Année</th>
                        <th scope="col" id="cardColor">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($voyagesStats as $voyagesStat):
                          ?>
                          <tr>
                              <td id="cardColor"><?= $voyagesStat['ANNEE']?></td>
                              <td id="cardColor"><?= $voyagesStat['NB']?></td>
                          </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </p>
            </div>
        </div>
      </div>
    </div>
    <br>
    <br>
      <!-- CARD COUNTRY SECOND ROW-->
    <div id="card" class="row">
      <div class="col-sm">
          <div class="card text-white bg-success mb-3" id="cardID" style="max-width: 24rem;">
          <div class="card-header text-white"><i class="fas fa-globe-americas"></i><strong> Nombre de pays visités</strong></div>
            <div class="card-body text-white">
              <h5 class="card-title" style="text-align:center"></h5>
              <p class="card-text" style="text-align: center; font-size: 20px">
                <div class="card bg-success" id="cardID" style="width: 18rem;">
                  <table class="card-table table" id="cardColor">
                    <thead>
                      <tr id="cardColor">
                        <th scope="col" id="cardColor">Année</th>
                        <th scope="col" id="cardColor">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($countryStats as $countryStat):
                          ?>
                          <tr>
                              <td id="cardColor"><?= $countryStat['ANNEE']?></td>
                              <td id="cardColor"><?= $countryStat['NBR_PAYS']?></td>
                          </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </p>
            </div>
        </div>
      </div>
      <!-- CARD PROGRAM PARTICIPANTS -->
      <div class="col-sm">
          <div class="card text-white bg-danger mb-3" id="cardID" style="max-width: 24rem;">
          <div class="card-header"><i class="fas fa-plane"></i><strong> Nombre de programmes participants</strong></div>
            <div class="card-body">
              <h5 class="card-title" style="text-align:center"></h5>
              <p class="card-text" style="text-align:center; font-size: 20px">
                <div class="card text-white bg-danger" id="cardID" style="width: 18rem;">
                  <table class="card-table table" id="cardColor">
                    <thead>
                      <tr id="cardColor">
                        <th scope="col" id="cardColor">Année</th>
                        <th scope="col" id="cardColor">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($programmeStats as $programmeStat):
                          ?>
                          <tr>
                              <td id="cardColor"><?= $programmeStat['ANNEE']?></td>
                              <td id="cardColor"><?= $programmeStat['NB']?></td>
                          </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
              </p>
            </div>
        </div>
      </div>
    </div>
  </div>
  </div>


<!-- TAB ÉTUDIANT STATS -->
  <div id="etudiantsTab" class="tabcontent">
    <table class="table_to_paginate_stats">
        <thead>
        <tr>
            <th scope="col">Année</th>
            <th scope="col">Nom du projet</th>
            <th scope="col">Pays</th>
            <th scope="col">Ville</th>
            <th scope="col">Total étudiant</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($etuStats as $etuStat):
            ?>
            <tr>
                <td><?= $etuStat['Annee']?></td>
                <td><?= $etuStat['nom_projet']?></td>
                <td><?= $etuStat['nom_pays']?></td>
                <td><?= $etuStat['ville']?></td>
                <td><?= $etuStat['NB']?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
  </div>
<!-- TAB ACCOMPAGNATEUR STATS -->
  <div id="accompagnateursTab" class="tabcontent">
    <table class="table_to_paginate_stats">
        <thead>
        <tr>
            <th scope="col">Année</th>
            <th scope="col">Nom du projet</th>
            <th scope="col">Pays</th>
            <th scope="col">Ville</th>
            <th scope="col">Total accompagnateur</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($accStats as $accStat):
            ?>
            <tr>
                <td><?= $accStat['Annee']?></td>
                <td><?= $accStat['nom_projet']?></td>
                <td><?= $accStat['nom_pays']?></td>
                <td><?= $accStat['ville']?></td>
                <td><?= $accStat['NB']?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
  </div>
<!-- TAB DESTINATIONS STATS -->
  <div id="destinationsTab" class="tabcontent">
    <table class="table_to_paginate_stats2">
        <thead>
        <tr>
            <th scope="col">Année</th>
            <th scope="col">Pays</th>
            <th scope="col">Ville</th>
            <th scope="col">Nombre de visite</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($destinationStats as $destinationStat):
            ?>
            <tr>
                <td> <?= $destinationStat['ANNEE'] ?></td>
                <td> <?= $destinationStat['nom_pays'] ?></td>
                <td> <?= $destinationStat['ville'] ?></td>
                <td> <?= $destinationStat['NB'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
  </div>

  <!-- TAB PROJETS À VENIR STATS -->
    <div id="futurProjetTab" class="tabcontent">
      <table class="table_to_paginate_stats2">
          <thead>
          <tr>
              <th scope="col">Année</th>
              <th scope="col">Pays</th>
              <th scope="col">Ville</th>
              <th scope="col">Nombre de projets</th>
          </tr>
          </thead>
          <tbody>
          <?php foreach ($futurProjetStats as $futurProjetStat):
              ?>
              <tr>
                  <td> <?= $futurProjetStat['ANNEE'] ?></td>
                  <td> <?= $futurProjetStat['nom_pays'] ?></td>
                  <td> <?= $futurProjetStat['ville'] ?></td>
                  <td> <?= $futurProjetStat['NB'] ?></td>
              </tr>
          <?php endforeach; ?>
          </tbody>
      </table>
    </div>
</div>
</div>

<?= load_script('codeMask') ?>
<script>
    var order = [[ 7, 'desc' ],[ 5, 'asc' ],[ 0, 'asc' ]];
</script>
<?= load_script('paginatorStats') ?>
<?= load_script('tab') ?>
<script>
    $(document).ready( function () {
        openTab(null, 'generalTab');
    } );
    document.getElementById('general').className += " active"
</script>
