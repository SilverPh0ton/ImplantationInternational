<?php
/**
 * @var \App\Controller\VoyagesQuestionsController $valeursController
 * @var \App\Model\Entity\Compte $compte
 * @var \App\Model\Entity\Categorie[] $categories
 * @var \App\Model\Entity\Question[] $questions
 * @var \App\Model\Entity\Valeur[] $valeurs
 */
$ctr = 1;
$id_voyage = $_GET['param1'];
$id_compte = $_GET['param2'];
$valeursController->edit($id_voyage, $id_compte);


$nom_projet = get('nom_projet');
$compte = get('compte');
$categories = get('categories');
$questions = get('questions');
$valeurs = get('valeurs');

$connectedUser = $_SESSION["connectedUser"];
?>

<?= load_css('form') ?>
<?= load_css('ControlOption') ?>

<script>
    $(document).ready(function () {
        $('[data-toggle="popover"]').popover({
            trigger: 'hover',
            placement: 'left'
        });
    });
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<div class="valeurs index columns large-8 medium-10 small-12 large-centered medium-centered small-centered large-text-left medium-text-left small-text-left content">

    <form method="post" enctype="multipart/form-data">
        <fieldset>
            <legend><?= 'Formulaire de ' . $compte->getPrenom() . ' ' . $compte->getNom() . ' pour le projet ' . $nom_projet ?></legend>
            <?php if (empty($categories)): ?>
                <h2>Aucune question pour ce voyage</h2>
            <?php else: ?>

                <div class="accordion md-accordion accordion-1" id="accordionEx23" role="tablist">

                    <?php foreach ($categories as $categorie): ?>

                        <div class="card">
                            <div class="card-header blue lighten-3 z-depth-1" role="tab" id="heading<?php $ctr++;
                            echo $ctr ?>">
                                <h5 class="text-uppercase mb-0 py-1">
                                    <a class="white-text font-weight-bold" data-toggle="collapse"
                                       href="#collapse<?php echo $ctr ?>" aria-expanded="true"
                                       aria-controls="collapse<?php echo $ctr ?>">
                                        <?= $categorie->getCategorie() ?>
                                    </a>
                                </h5>
                            </div>
                            <div id="collapse<?php echo $ctr ?>" class="collapse" role="tabpanel"
                                 aria-labelledby="heading<?php echo $ctr ?>" data-parent="#accordionEx23">
                                <div class="card-body">

                                    <?php foreach ($questions as $question): ?>

                                        <?php if ($question->getCategorie()->getIdCategorie() === $categorie->getIdCategorie() && $question->getActif()): ?>
                                            <div style="width:100%; margin:0 auto; border-top: #1a1a1a;">

                                                <span><?= $question->getQuestion() ?></span>

                                                <?php
                                                $vraiValeurs = null;
                                                foreach ($valeurs as $valeur) {
                                                    if ($valeur->getIdQuestion() === $question->getIdQuestion())
                                                        $vraiValeurs = $valeur->getReponse();
                                                }
                                                ?>

                                                <label for="affichage">
                                                    <!--Loop pour questions-->
                                                    <span>
                                                        <?php if ($question->getAffichage() === 'Case'): ?>
                                                            <?php if (!isset($vraiValeurs)) : $vraiValeurs = 'off'; endif; ?> <!-- Default Value-->

                                                            <input type="checkbox"
                                                                   name="<?= $question->getIdQuestion() ?>"
                                                            <?= ('on' === $vraiValeurs) ? ' checked' : '' ?>
                                                            >

                                                        <?php elseif ($question->getAffichage() === 'Telechargement'): ?>

                                                            <?php
                                                            echo download(  $question->getInputOption(),'Télécharger: ' . $question->getInputOption());
                                                            ?>

                                                        <?php elseif ($question->getAffichage() === 'Chiffre'):
                                                            $extrmum = explode(";", $question->getInputOption());
                                                            if (sizeof($extrmum) >= 3) {
                                                                $min = $extrmum[0];
                                                                $max = $extrmum[1];
                                                                $step = $extrmum[2];
                                                            } else {
                                                                $min = 0;
                                                                $max = 100;
                                                                $step = 1;
                                                            }
                                                            ?>
                                                            <?php if (!isset($vraiValeurs)) : $vraiValeurs = '0'; endif; ?> <!-- Default Value-->

                                                            <input type="number"
                                                                   name="<?= $question->getIdQuestion() ?>"
                                                                   value="<?= $vraiValeurs ?>" min="<?= $min ?>"
                                                                   max="<?= $max ?>" step="<?= $step ?>">

                                                        <?php elseif ($question->getAffichage() === 'Date'): ?>
                                                            <?php if (!isset($vraiValeurs)) : $vraiValeurs = '2019-01-01'; endif; ?> <!-- Default Value-->

                                                            <input type="date"
                                                                   name="<?= $question->getIdQuestion() ?>"
                                                                   value="<?= $vraiValeurs ?>">

                                                        <?php elseif ($question->getAffichage() === 'Liste'):
                                                            $options = explode(";", $question->getInputOption()); ?>
                                                            <?php if (!isset($vraiValeurs)) : $vraiValeurs = $options[0]; endif; ?> <!-- Default Value-->

                                                            <select name=<?= $question->getIdQuestion() ?>>
                                                                <?php foreach ($options as $option): ?>
                                                                    <option value=<?= $option ?>
                                                                            <?= ($option === $vraiValeurs) ? ' selected="selected"' : '' ?>
                                                                    >
                                                                        <?= $option ?>
                                                                    </option>
                                                                <?php endforeach ?>
                                                            </select>

                                                        <?php elseif ($question->getAffichage() === 'Fichier'): ?>

                                                            <input type="file"
                                                                   name="<?= $question->getIdQuestion() ?>">
                                                            <?php
                                                            if (!isset($vraiValeurs)) {
                                                                $vraiValeurs = 'empty.txt';
                                                            }//Default Value
                                                            echo download($vraiValeurs, 'Télécharger: ' . $vraiValeurs);
                                                            ?>

                                                        <?php elseif ($question->getAffichage() === 'Curseur'):
                                                            $extrmum = explode(";", $question->getInputOption());
                                                            if (sizeof($extrmum) >= 3) {
                                                                $min = $extrmum[0];
                                                                $max = $extrmum[1];
                                                                $step = $extrmum[2];
                                                            } else {
                                                                $min = 0;
                                                                $max = 100;
                                                                $step = 1;
                                                            }
                                                            ?>
                                                            <?php if (!isset($vraiValeurs)) : $vraiValeurs = ($min + $max) / 2; endif; ?> <!-- Default Value-->

                                                            <input type="range" class="slider"
                                                                   name="<?= $question->getIdQuestion() ?>"
                                                                   value="<?= $vraiValeurs ?>"
                                                                   onchange="$('#rangeValue<?= $question->getIdQuestion() ?>').text(this.value);"
                                                                   min="<?= $min ?>" max="<?= $max ?>">
                                                            <span
                                                                    id="rangeValue<?= $question->getIdQuestion() ?>"><?= $vraiValeurs ?></span>
                                                            <br><br>

                                                        <?php elseif ($question->getAffichage() === 'ZoneTexte'): ?>
                                                            <?php if (!isset($vraiValeurs)) : $vraiValeurs = ''; endif; ?> <!-- Default Value-->

                                                            <textarea
                                                                    name="<?= $question->getIdQuestion() ?>"><?= $vraiValeurs ?>
                                                            </textarea>
                                                        <?php endif; ?>
                                                    </span>
                                                    <?php if(!empty($question->getInfoSup())): ?>
                                                      <a
                                                              style="float: right"
                                                              href="javascript:void(0)"
                                                              title="Informations supplémentaires"
                                                              data-toggle="popover"
                                                              data-content="<?= $question->getInfoSup() ?>"
                                                      >
                                                          <i class="fa fa-info" aria-hidden="true" style="font-size:28px;"></i>
                                                      </a>
                                                    <?php endif;?>
                                            </div><br>
                                            <hr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </div>
                <?php
                if ($connectedUser->getIdCompte() == $id_compte) {
                    echo '<button type="submit">Enregistrer</button>';
                }
                ?>
            <?php endif; ?>
            <!--Button de navigation -->
            <?php
            if (isOfType([ADMIN, PROF])) {
                echo nav1('<button type="button"> Retour aux formulaires</button>', 'valeurs', 'index', $id_voyage);

            } else {
                echo nav('<button type="button"> Retour aux voyages</button>', 'Voyages', 'index');
            }
            ?>

        </fieldset>
    </form>


</div>
