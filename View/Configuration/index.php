<?php
/**
 * @var \App\Controller\ConfigurationController $configurationController
 * @var \App\Model\Entity\Categorie[] $categories
 * @var \App\Model\Entity\Programme[] $programmes
 * @var \App\Model\Entity\Destination[] $destinations
 * @var string $code
 */

$configurationController->index();

$categories = get('categories');
$programmes = get('programmes');
$destinations = get('destinations');

$categoriesProposition = get('categoriesProposition');
$questionProposition = get('questionProposition');
$questionsFormulaire = get('questionFormulaire');

$ctr =1;
?>

<?= load_css('tab')?>
<?= load_css('form') ?>
<?= load_css('ControlOption') ?>

<div class="large-12 medium-12 small-12 content large-centered medium-centered small-centered large-text-left medium-text-left small-text-left">
    <h3>Configurations</h3>

    <div class="tab" style="border: none;">
        <button type="button" id="categories" class="tablinks active" onclick="openTab(event, 'categoriesTab')">Catégories</button>
        <button type="button" id="programmes" class="tablinks" onclick="openTab(event, 'programmesTab')">Programmes</button>
        <button type="button" id="destinations" class="tablinks" onclick="openTab(event, 'destinationsTab')">Destinations</button>
        <button type="button" id="propositions" class="tablinks" onclick="openTab(event, 'propositionsTab')">Formulaires pour propositions de voyage</button>
    </div>
    <div class="tab tabContainer">

        <div id="categoriesTab" class="tabcontent" style="width: 90%; margin: 0 auto;">
            <table class="table_to_paginate" >
                <thead>
                <tr>
                    <th scope="col">Catégories</th>
                    <th scope="col">Actif</th>
                    <th scope="col">Par défaut</th>
                    <th scope="col" class="actions"></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($categories as $categorie):
                    $color = $categorie->getActif() ? '' : 'style="color: #aaaaaa;" '
                    ?>
                    <tr>
                        <td <?php echo $color ?> ><?= $categorie->getCategorie() ?></td>
                        <td <?php echo $color ?> ><?= ($categorie->getActif() ? 'Oui' : 'Non') ?></td>
                        <td <?php echo $color ?> ><?= ($categorie->getDefault() ? 'Oui' : 'Non') ?></td>
                        <td class="actions" style="text-align: right">
                            <?= nav1(
                                '<img alt="modifier icon" src="Ressource/img/writing.png" class="images" data-toggle="tooltip" data-placement = "top" title = "Modifier">',
                                'Categories',
                                'Edit',
                                $categorie->getIdCategorie());
                            ?>

                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <!--Button de navigation -->
            <?= nav('<button>  Ajouter une catégorie </button>', 'Categories', 'add'); ?>
        </div>

        <div id="programmesTab" class="tabcontent" style="width: 90%; margin: 0 auto;">
            <table class="table_to_paginate">
                <thead>
                <tr>
                    <th scope="col">Programmes</th>
                    <th scope="col">Actif</th>
                    <th scope="col" class="actions"></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($programmes as $programme):
                    $programme = unserialize($programme);
                    $color = $programme->getActif() ? '' : 'style="color: #aaaaaa"'
                    ?>
                    <tr>
                        <td <?php echo $color ?> ><?= $programme->getNomProgramme() ?></td>
                        <td <?php echo $color ?> ><?= ($programme->getActif() ? 'Oui' : 'Non') ?></td>
                        <td class="actions" style="text-align: right">
                            <?= nav1(
                                '<img alt="modifier icon" src="Ressource/img/writing.png" class="images" data-toggle="tooltip" data-placement = "top" title = "Modifier">',
                                'Programmes',
                                'Edit',
                                $programme->getIdProgramme());
                            ?>

                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <!--Button de navigation -->
            <?= nav('<button> Ajouter un programme </button>', 'Programmes', 'add'); ?>
        </div>

        <div id="destinationsTab" class="tabcontent" style="width: 90%; margin: 0 auto;">
            <table class="table_to_paginate">
                <thead>
                <tr>
                    <th scope="col" >Pays</th>
                    <th scope="col">Actif</th>
                    <th scope="col" class="actions"></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($destinations as $destination):
                    $color = $destination->getActif() ? '' : 'style="color: #aaaaaa"'
                    ?>
                    <tr>
                        <td <?php echo $color ?> ><?= $destination->getNomPays() ?></td>
                        <td <?php echo $color ?> ><?= ($destination->getActif() ? 'Oui' : 'Non') ?></td>
                        <td class="actions" style="text-align: right">
                            <?= nav1(
                                '<img alt="modifier icon" src="Ressource/img/writing.png" class="images" data-toggle="tooltip" data-placement = "top" title = "Modifier">',
                                'Destinations',
                                'Edit',
                                $destination->getIdDestination());
                            ?>

                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <!--Button de navigation -->
            <?= nav('<button> Ajouter une destination </button>', 'Destinations', 'add'); ?>
        </div>

        <div id="propositionsTab" class="tabcontent" style="width: 90%; margin: 0 auto;">
            <form method="post">
                <fieldset>
                    <legend>Éditeur de formulaire pour les propositions</legend>
                    <?php
                    $id_questions = array();
                    if ($questionsFormulaire != null) {
                        foreach ($questionsFormulaire as $formulaireQuestion) {
                            array_push($id_questions, $formulaireQuestion->getIdQuestion());
                        }
                    }
                    ?>
                    <ul class="sortableCat accordion md-accordion accordion-1" role="tablist">
                        <?php $cat_order_ctr = -1; ?>
                        <?php foreach ($categoriesProposition as $categorie): ?>
                            <?php $cat_order_ctr++ ?>

                            <li class="card-header" id="heading<?= ++$ctr ?>">
                                <input type="checkbox" class="parentCheckbox" id="categorie_<?= $categorie->getIdCategorie() ?>"
                                       value="1">
                                <span class="caret" style="display:inline-block; width: 95%;">
                            <?= $categorie->getCategorie() ?>
                        </span>
                                <ul class="nested sortableQu">
                                    <table>
                                        <tr>
                                            <th class="row5"></th>
                                            <th class="row45">Affichage</th>
                                            <th class="row45">Information supplémentaire</th>
                                            <th class="row5"></th>
                                        </tr>
                                    </table>
                                    <?php $order_ctr = 0; ?>
                                    <?php foreach ($questionProposition as $question): ?>
                                        <?php if ($question->getCategorie()->getIdCategorie() === $categorie->getIdCategorie() && $question->getActif()): ?>
                                            <li>
                                                <table>
                                                    <tr>
                                                        <td class="row5">
                                                            <input type="checkbox" class="childCheckbox"
                                                                   name="check_<?= $question->getIdQuestion() ?>"
                                                                   id="question_<?= $question->getIdQuestion() ?>"
                                                                   value="1"
                                                                <?= (in_array($question->getIdQuestion(), $id_questions)) ? ' checked="checked"' : ''?>>
                                                        </td>
                                                        <td class="row45">
                                                            <div class="ControlOption">
                                                                <label for="affichage"><?php echo($question->getQuestion()); ?> <br> <br>
                                                                    <?php if ($question->getAffichage() === 'Case'): ?>
                                                                      <?php $options = explode(";", $question->getInputOption()); ?>

                                                                      <?php foreach ($options as $option): ?>
                                                                          <input type="checkbox"><?= $option ?></input>
                                                                      <?php endforeach ?>


                                                                            <?php elseif ($question->getAffichage() === 'Radio'): ?>
                                                                            <?php $options = explode(";", $question->getInputOption()); ?>

                                                                            <?php foreach ($options as $option): ?>
                                                                                <input type="radio" name="radio">  <?= $option ?></input>
                                                                            <?php endforeach ?>

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
                                                                        <input type="number" min="<?= $min ?>"
                                                                               max="<?= $max ?>"
                                                                               step="<?= $step ?>">

                                                                    <?php elseif ($question->getAffichage() === 'Telechargement'): ?>
                                                                        <?php echo download($question->getInputOption(),'Télécharger : '.$question->getInputOption());
                                                                        ?>

                                                                    <?php elseif ($question->getAffichage() === 'Date'): ?>
                                                                        <input type="date">

                                                                    <?php elseif ($question->getAffichage() === 'Liste'):
                                                                        $options = explode(";", $question->getInputOption()); ?>
                                                                        <select>
                                                                            <?php foreach ($options as $option): ?>
                                                                                <option
                                                                                        value=<?= $option ?>> <?= $option ?></option>
                                                                            <?php endforeach ?>
                                                                        </select>

                                                                    <?php elseif ($question->getAffichage() === 'Fichier'): ?>
                                                                        <input type="file">

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
                                                                        <input type="range" class="slider"
                                                                               onchange="$('#rangeValue<?= $question->getIdQuestion() ?>').text(this.value);"
                                                                               min="<?= $min ?>" max="<?= $max ?>"
                                                                               step="<?= $step ?>">
                                                                        <span
                                                                                id="rangeValue<?= $question->getIdQuestion() ?>"><?= ($min + $max) / 2 ?></span>

                                                                    <?php elseif ($question->getAffichage() === 'ZoneTexte'): ?>
                                                                        <textarea></textarea>

                                                                    <?php elseif ($question->getAffichage() === 'Couleur'): ?>
                                                                        <input type="color">

                                                                    <?php endif; ?>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td class="row45"><?php echo($question->getInfoSup()) ?></td>
                                                        <td class="row5">
                                                            <?= nav1(
                                                                '<img alt="modifier icon" src="Ressource/img/writing.png" class="images" data-toggle="tooltip" data-placement = "top" title = "Modifier">',
                                                                'Questions',
                                                                'edit',
                                                                $question->getIdQuestion());
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <input hidden class="order" type="text" value="<?= $order_ctr++ ?>"
                                                                   name="order_<?= $question->getIdQuestion() ?>">
                                                        </td>
                                                        <td>
                                                            <input hidden class="cat_order" type="text" value="<?= $cat_order_ctr ?>"
                                                                   name="cat_order_<?= $question->getIdQuestion() ?>">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </fieldset>

                <button type="submit" id="submitBtn">Enregistrer</button>
            </form>
        </div>

    </div>
</div>

<script>
    let order = [[ 1, 'desc' ],[ 0, 'asc' ]];
    let scrollY_val = '40vh';
</script>
<?= load_script('paginator') ?>
<?= load_script('treeView') ?>
<?= load_script('tab') ?>

<script>
    $(document).ready( function () {
        openTab(null, 'categoriesTab');
    } );
    document.getElementById('categories').className += " active"
</script>
