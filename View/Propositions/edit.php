<?php
/**
 * @var App\Controller\ProgrammesController $propositionController
 * @var \App\Model\Entity\Voyage $proposition
 * @var \App\Model\Entity\Activite[] $activites
 * @var string $compteType
 */
$idCase = 0;
$id_proposition = $_GET['param1'];
$propositionController->edit($id_proposition);

$proposition = get('proposition');
$proposition_reponses = get('proposition_reponses');
$categories = get('categories');

$destinations = get('destinations');
$activites = get('activites');

$yearDepart = date("Y", strtotime($proposition->getDateDepart()));
$yearReturn = date("Y", strtotime($proposition->getDateRetour()));
?>

<?= load_script('dynamicTableEdit') ?>
<?= load_script('fonctionCase') ?>
<script>
    $(document).ready(function () {
        $('[data-toggle="popover"]').popover({
            trigger: 'hover',
            placement: 'left'
        });
    });
</script>
<style>
    .double {
        zoom: 1.2;
        transform: scale(1.2);
        -ms-transform: scale(1.2);
        -webkit-transform: scale(1.2);
        -o-transform: scale(1.2);
        -moz-transform: scale(1.2);
        transform-origin: 0 0;
        -ms-transform-origin: 0 0;
        -webkit-transform-origin: 0 0;
        -o-transform-origin: 0 0;
        -moz-transform-origin: 0 0;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="columns large-8 medium-10 small-12 large-centered medium-centered small-centered large-text-left medium-text-left small-text-left content">

    <form method="post" id="base_form" enctype="multipart/form-data">
        <fieldset>
            <legend>Modifier une proposition</legend>
            <div class="double">

                <?php if(!isOfType([ADMIN])):?>
                <input type="checkbox" id="brouillon" name="brouillon" value="oui" <?php echo ($proposition->getApprouvee() == 3) ?  'checked' :  ''; ?>>
                <label for="brouillon">Il s'agit d'un brouillon</label><br>
                <?php endif; ?>

            </div>
            <label for="nom_projet">Nom du projet</label>
            <input type="text" name="nom_projet" pattern=".*\S.*" maxlength="50" title="Le champ de peut pas être vide"
                   value="<?= $proposition->getNomProjet() ?>">

            <div class="input required">
                <label for="id_destination">Destination</label>
                <select name="id_destination" required="required">
                    <?php foreach ($destinations as $destination): ?>
                        <option value=<?= $destination->getIdDestination();
                        if ($proposition->getDestination()->getIdDestination() == $destination->getIdDestination()): {
                            echo ' selected="selected""';
                        } endif ?>
                        >
                            <?= $destination->getNomPays() ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="input text">
                <label for="ville">Ville</label>
                <input type="text" name="ville" pattern=".*\S.*" maxlength="50" title="Le champ ne peut pas être vide"
                       value="<?= $proposition->getVille() ?>">
            </div>
            <div class="input text">
                <label for="note">Note</label>
                <textarea name="note" maxlength="500" rows="4"><?= $proposition->getNote() ?></textarea>
            </div>

            <div class="input date required">
                <label for="date_depart">Date de départ</label>
                <select name="date_depart[year]" required="required">
                    <?php for ($i = date('Y'); $i <= (date('Y') + 50); $i++): ?>
                        <option
                                value=<?= $i ?>
                                <?= ($i == substr($proposition->getDateDepart(), 0, 4)) ? ' selected="selected"' : '' ?>>
                            <?= $i ?>
                        </option>
                    <?php endfor; ?>
                </select>

                <select name="date_depart[month]" required="required">
                    <?php
                    $i = 0;
                    foreach (return_months() as $month):
                        ?>
                        <option
                                value=<?= ++$i ?>
                                <?= ($i == substr($proposition->getDateRetour(), 5, 7)) ? ' selected="selected"' : '' ?>>
                            <?= $month ?>
                        </option>
                    <?php
                    endforeach;
                    ?>
                </select>

                <select name="date_depart[day]" required="required">
                    <?php for ($i = 1; $i <= 31; $i++): ?>
                        <option
                                value=<?= $i ?>
                                <?= ($i == substr($proposition->getDateDepart(), 8, 10)) ? ' selected="selected"' : '' ?>
                        >
                            <?= $i ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>

            <div class="input date required">
                <label for="date_retour">Date de retour</label>
                <select name="date_retour[year]" required="required">
                    <?php for ($i = date('Y'); $i <= (date('Y') + 50); $i++): ?>
                        <option
                                value=<?= $i ?>
                                <?= ($i == substr($proposition->getDateRetour(), 0, 4)) ? ' selected="selected"' : '' ?>>
                            <?= $i ?>
                        </option>
                    <?php endfor; ?>
                </select>

                <select name="date_retour[month]" required="required">
                    <?php
                    $i = 0;
                    foreach (return_months() as $month):
                        ?>
                        <option
                                value=<?= ++$i ?>
                                <?= ($i == substr($proposition->getDateRetour(), 5, 7)) ? ' selected="selected"' : '' ?>>
                            <?= $month ?>
                        </option>
                    <?php
                    endforeach;
                    ?>
                </select>

                <select name="date_retour[day]" required="required">
                    <?php for ($i = 1; $i <= 31; $i++): ?>
                        <option
                                value=<?= $i ?>
                                <?= ($i == substr($proposition->getDateRetour(), 8, 10)) ? ' selected="selected"' : '' ?>
                        >
                            <?= $i ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>
        </fieldset>

        <div style="text-align: center">Ajout d'activité(s)</div>
        <br>

        <table class="activityTable" style="white-space: nowrap;">
            <thead>
            <tr>
                <th>Endroit</th>
                <th>Description</th>
                <th>Date de départ</th>
                <th>Date de fin</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($activites as $activite) :

                $yearDepart = date("Y", strtotime($activite->getDateDepart()));
                $monthDepart = date("m", strtotime($activite->getDateDepart()));
                $dayDepart = date("d", strtotime($activite->getDateDepart()));

                $yearReturn = date("Y", strtotime($activite->getDateRetour()));
                $monthReturn = date("m", strtotime($activite->getDateRetour()));
                $dayReturn = date("d", strtotime($activite->getDateRetour()));
                ?>

                <tr>
                    <td class='tdEndroit'>
                        <input class="inputEndroit" type="hidden" name="endroit"
                                                 value="<?= $activite->getEndroit() ?>"><?= $activite->getEndroit() ?>
                    </td>
                    <td class='tdDescription'>
                        <input class="inputDescription" type="hidden" name="description" maxlength="100"
                                                     value="<?= $activite->getDescription() ?>"><?= $activite->getDescription() ?>
                    </td>
                    <td><input class="inputDateDepart" type="hidden" name="dateDepart"
                               value="<?= $yearDepart ?>-<?= $monthDepart ?>-<?= $dayDepart ?>"><?= $yearDepart ?>
                        -<?= $monthDepart ?>-<?= $dayDepart ?></td>
                    <td><input class="inputDateRetour" type="hidden" name="dateRetour"
                               value="<?= $yearReturn ?>-<?= $monthReturn ?>-<?= $dayReturn ?>"><?= $yearReturn ?>
                        -<?= $monthReturn ?>-<?= $dayReturn ?></td>
                    <td>
                        <button type='button' class="deleteRow"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>


            <?php endforeach; ?>

            <tr>
                <td style="padding: 10px 5px 5px;"><input type="text" maxlength="50" id="endroit_field" placeholder="Endroit"></td>
                <td style="padding: 10px 5px 5px;"><input type="text" id="description_field" maxlength="100" placeholder="Description"></td>
                <td style="padding: 10px 5px 5px;">

                    <div class="input date required">
                        <select name="activite_date_depart[year]" required="required" id="startYear">
                            <?php for ($i = date('Y'); $i <= (date('Y') + 50); $i++): ?>
                                <option
                                        value=<?= $i ?>
                                        <?= ($i == date('Y')) ? ' selected="selected"' : '' ?>>
                                    <?= $i ?>
                                </option>
                            <?php endfor; ?>
                        </select>

                        <select name="activite_date_depart[month]" required="required" id="startMonth">
                            <?php
                            $i = 0;
                            foreach (return_months() as $month):
                                ?>
                                <option
                                        value=<?= ++$i ?>
                                        <?= ($i == date('m')) ? ' selected="selected"' : '' ?>>
                                    <?= $month ?>
                                </option>
                            <?php
                            endforeach;
                            ?>
                        </select>

                        <select name="activite_date_depart[day]" required="required" id="startDay">
                            <?php for ($i = 1; $i <= 31; $i++): ?>
                                <option
                                        value=<?= $i ?>
                                        <?= ($i == date('d')) ? ' selected="selected"' : '' ?>
                                >
                                    <?= $i ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </td>
                <td style="padding: 10px 5px 5px;">


                    <div class="input date required">
                        <select name="activite_date_retour[year]" required="required" id="endYear">
                            <?php for ($i = date('Y'); $i <= (date('Y') + 50); $i++): ?>
                                <option
                                        value=<?= $i ?>
                                        <?= ($i == date('Y')) ? ' selected="selected"' : '' ?>>
                                    <?= $i ?>
                                </option>
                            <?php endfor; ?>
                        </select>

                        <select name="activite_date_retour[month]" required="required" id="endMonth">
                            <?php
                            $i = 0;
                            foreach (return_months() as $month):
                                ?>
                                <option
                                        value=<?= ++$i ?>
                                        <?= ($i == date('m')) ? ' selected="selected"' : '' ?>>
                                    <?= $month ?>
                                </option>
                            <?php
                            endforeach;
                            ?>
                        </select>

                        <select name="activite_date_retour[day]" required="required" id="endDay">
                            <?php for ($i = 1; $i <= 31; $i++): ?>
                                <option
                                        value=<?= $i ?>
                                        <?= ($i == date('d')) ? ' selected="selected"' : '' ?>
                                >
                                    <?= $i ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>


                </td>

                <td>
                    <button type="button" class="addRow"><i class="fa fa-plus"></i></button>
                </td>
            </tr>
            </tbody>
        </table>

        <br>
        <fieldset>
            <legend>Renseignements supplémentaires</legend>
            <?php if (empty($categories)): ?>
                <h2>Aucune question pour ce voyage</h2>
            <?php else: ?>

                <div class="accordion md-accordion accordion-1" id="accordionEx23" role="tablist">
                    <?php $ctr = 0; ?>
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

                                    <?php foreach ($proposition_reponses as $proposition_reponse): ?>
                                        <?php $question = $proposition_reponse->getQuestion(); ?>
                                        <?php if ($question->getCategorie()->getIdCategorie() === $categorie->getIdCategorie() && $question->getActif()): ?>
                                            <div style="width:100%; margin:0 auto; border-top: #1a1a1a;">

                                                <span><?= $question->getQuestion() ?></span>


                                                <?php $vraiValeurs = $proposition_reponse->getReponse();
                                               ?>
                                                <!--Loop pour questions-->
                                                <span>
                                                    <?php if ($question->getAffichage() === 'Case'): ?>
                                                        <br> <br>
                                                      <?php   $listeReponse = explode(";", $vraiValeurs);

                                                      $options = explode(";", $question->getInputOption());
                                                       ?>

                                                              <?php foreach ($options as $option): $idCase++; ?>

                                                              <input <?php if($listeReponse[$idCase-1] === "true") : ?>
                                                                  checked="checked"
                                                                <?php endif; ?>  id="<?= $idCase?>" class="caseClass" data-id="<?= $question->getIdQuestion()?>"  type="checkbox">
                                                                      <?= $option ?>
                                                                  </input>
                                                              <?php endforeach ?>
                                                              <input value="<?=$vraiValeurs?>" name="<?= $question->getIdQuestion()?>"  type="hidden">


                                                              <?php elseif ($question->getAffichage() === 'Radio'): ?>
                                                <br> <br>
                                                <?php
                                                $listeReponse = explode(";", $vraiValeurs);

                                                $options = explode(";", $question->getInputOption());
                                                 $idCase = 0; ?>

                                                        <?php foreach ($options as $option): $idCase++; ?>

                                                        <input <?php if($listeReponse[$idCase-1] === "true") : ?>
                                                            checked="checked"
                                                          <?php endif; ?>
                                                        name="radio<?= $question->getIdQuestion()?>" class="radioClass" data-id="<?= $question->getIdQuestion()?>"  type="radio">
                                                                <?= $option ?>
                                                            </input>
                                                        <?php endforeach ?>
                                                        <input value="<?=$vraiValeurs?>" name="<?= $question->getIdQuestion()?>"  type="hidden">

                                                    <?php elseif ($question->getAffichage() === 'Telechargement'): ?>

                                                        <?php
                                                        $fileName = $vraiValeurs;
                                                        echo download($question->getInputOption(), 'Télécharger: ' . $question->getInputOption()); ?>

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
                                                                        <?php if ($option === $vraiValeurs): {
                                                                            echo ' selected="selected"';
                                                                        } endif ?>
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
                                                                name="<?= $question->getIdQuestion() ?>"><?= $vraiValeurs ?></textarea>

                                                    <?php elseif ($question->getAffichage() === 'Couleur'): ?>
                                                        <?php if (!isset($vraiValeurs)) : $vraiValeurs = '#ffffff'; endif; ?> <!-- Default Value-->

                                                        <input type="color"
                                                               name="<?= $question->getIdQuestion() ?>"
                                                               value="<?= $vraiValeurs ?>">

                                                    <?php endif; ?>
                                                </span>

                                                <a
                                                        style="float: right"
                                                        href="javascript:void(0)"
                                                        title="Informations supplémentaires"
                                                        data-toggle="popover"
                                                        data-content="<?= $question->getInfoSup() ?>"
                                                >
                                                    <i class="fa fa-info" aria-hidden="true"
                                                       style="font-size:28px;"></i>
                                                </a>
                                            </div>
                                            <br>
                                            <hr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?= nav('<button type="button">Retour aux propositions </button>', 'Propositions', 'index'); ?>
            <button type="submit" form="base_form">Enregistrer</button>
        </fieldset>

    </form>

</div>
