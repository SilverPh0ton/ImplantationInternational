<?php
/**
 * @var \App\Controller\VoyagesQuestionsController $voyagesQuestionsController
 * @var \App\Model\Entity\Categorie[] $categoriesProf
 * @var \App\Model\Entity\Categorie[] $categoriesEtu
 * @var \App\Model\Entity\Question[] $listQuestionProf
 * @var \App\Model\Entity\Question[] $listQuestionEtu
 * @var \App\Model\Entity\VoyagesQuestion[] $voyagesQuestions
 */
$id_voyage = $_GET['param1'];
$voyagesQuestionsController->index($id_voyage);
$nom_projet = get('nom_projet');
$categoriesProf = get('categoriesProf');
$categoriesEtu = get('categoriesEtu');
$listQuestionProf = get('listQuestionProf');
$listQuestionEtu = get('listQuestionEtu');
$voyagesQuestionsProf = get('voyagesQuestionsProf');
$voyagesQuestionsEtu = get('voyagesQuestionsEtu');
$ctr = 1;
?>

<?= load_css('form') ?>
<?= load_css('ControlOption') ?>


<div class="voyagesQuestions columns large-9 medium-12 small-12 content large-centered medium-centered small-centered large-text-left medium-text-left small-text-left">
    <form method="post">
        <fieldset>
            <legend>Éditeur de formulaire pour les accompagnateurs du projet: <?php echo($nom_projet) ?></legend>
            <ul class="sortableCat accordion md-accordion accordion-1" role="tablist">
                <?php
                $id_questions = array();
                if ($voyagesQuestionsProf != null) {
                    foreach ($voyagesQuestionsProf as $voyageQuestion) {
                        array_push($id_questions, $voyageQuestion->getIdQuestion());
                    }
                }
                ?>
                <?php $cat_order_ctr = -1; ?>
                <?php foreach ($categoriesProf as $categorie): ?>
                    <?php $cat_order_ctr++ ?>

                    <li class="card-header" id="heading<?= ++$ctr ?>">
                        <input type="checkbox" class="parentCheckbox" id="categorie_<?= $categorie->getIdCategorie() ?>" value="1"<?php if ($categorie->getDefault()==1) echo 'checked' ?>>
                        <span class="caret" style="display:inline-block; width: 95%;">
                            <?= $categorie->getCategorie() ?>

                        </span>

                        <ul class="nested sortableQu">
                            <table>
                                <tr>
                                    <th class="row5"></th>
                                    <th class="row45">Affichage</th>
                                    <th class="row45">Information supplémentaire</th>
                                    <th class="row5" style="width: 10%"></th>
                                </tr>
                            </table>
                            <?php $order_ctr = 0; ?>
                            <?php foreach ($listQuestionProf as $question): ?>
                                <?php if ($question->getCategorie()->getIdCategorie() === $categorie->getIdCategorie() && $question->getActif()): ?>
                                    <li>
                                        <table>
                                            <tr>
                                                <td class="row5">

                                                    <input type="checkbox" class="childCheckbox"
                                                           name="check_<?= $question->getIdQuestion() ?>_1"
                                                           id="question_<?= $question->getIdQuestion() ?>"
                                                           value="1"
                                                        <?= ($categorie->getDefault()==1 || in_array($question->getIdQuestion(), $id_questions)) ? ' checked="checked"' : '' ?>>
                                                </td>
                                                <td class="row45">
                                                    <div class="ControlOption">
                                                        <label for="affichage"><?php echo($question->getQuestion()); ?>

                                                        <?php if ($question->getAffichage() === 'Case'): ?>
                                                        <?php $options = explode(";", $question->getInputOption()); ?>

                                                        <?php foreach ($options as $option): ?>
                                                    
                                                            <input type="checkbox"><?= $option ?></input>
                                                            <br>
                                                        <?php endforeach ?>

                                                        
                                                        <?php elseif ($question->getAffichage() === 'Radio'): ?>
                                                            <br><br>
                                                        <?php $options = explode(";", $question->getInputOption()); ?>

                                                        <?php foreach ($options as $option): ?>
                                                   
                                                            <input type="radio" name="radio">  <?= $option ?></input>
                                                            <br>
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
                                                                <?php echo download( $question->getInputOption(),'Télécharger: '.$question->getInputOption()); ?>

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

                                                            <?php endif; ?>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="row45"><?php echo($question->getInfoSup()) ?></td>
                                                <td class="row5">
                                                    <?= nav2(
                                                        '<img alt="modifier icon" src="Ressource/img/writing.png" class="images" data-toggle="tooltip" data-placement = "top" title = "Modifier">',
                                                        'Questions',
                                                        'edit',
                                                        $question->getIdQuestion(),
                                                        $id_voyage);
                                                    ?>
                                                </td>
                                                <td>
                                                    <input hidden class="order" type="text" value="<?= $order_ctr++ ?>"
                                                           name="order_<?= $question->getIdQuestion() ?>_1">
                                                </td>
                                                <td>
                                                    <input hidden class="cat_order" type="text" value="<?= $cat_order_ctr ?>"
                                                           name="cat_order_<?= $question->getIdQuestion() ?>_1">
                                                </td>
                                                <td>
                                                    <input hidden class="pour_prof" type="text" value="1"
                                                           name="pour_prof_<?= $question->getIdQuestion() ?>_1">
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

            <legend>Éditeur de formulaire pour les étudiants du projet: <?php echo($nom_projet) ?></legend>
            <ul class="sortableCat accordion md-accordion accordion-1" id="accordionEx23" role="tablist">
                <?php
                $id_questions = array();
                if ($voyagesQuestionsEtu != null) {
                    foreach ($voyagesQuestionsEtu as $voyageQuestion) {
                        array_push($id_questions, $voyageQuestion->getIdQuestion());
                    }
                }
                ?>
                <?php $cat_order_ctr = -1; ?>
                <?php foreach ($categoriesEtu as $categorie): ?>
                    <?php $cat_order_ctr++ ?>

                    <li class="card-header" id="heading<?= ++$ctr ?>">
                        <input type="checkbox" class="parentCheckbox" id="categorie_<?= $categorie->getIdCategorie() ?>" value="1"<?php if ($categorie->getDefault()==1) echo 'checked' ?>>
                        <span class="caret" style="display:inline-block; width: 95%;">
                                    <?= $categorie->getCategorie() ?>
                                </span>
                        <ul class="nested sortableQu">
                            <table>
                                <tr>
                                    <th class="row5"></th>
                                    <th class="row45">Affichage</th>
                                    <th class="row45">Information supplémentaire</th>
                                    <th class="row5" style="width: 10%"></th>
                                </tr>
                            </table>
                            <?php $order_ctr = 0; ?>
                            <?php foreach ($listQuestionEtu as $question): ?>
                                <?php if ($question->getCategorie()->getIdCategorie() === $categorie->getIdCategorie() && $question->getActif()): ?>

                                    <li>
                                        <table>
                                            <tr>
                                                <td class="row5"><input type="checkbox" class="childCheckbox"
                                                                        name="check_<?= $question->getIdQuestion() ?>_1"
                                                                        id="question_<?= $question->getIdQuestion() ?>"
                                                                        value="1"
                                                        <?= ($categorie->getDefault()==1 || in_array($question->getIdQuestion(), $id_questions)) ? ' checked="checked"' : '' ?>>
                                                </td>
                                                <td class="row45">
                                                    <div class="ControlOption">
                                                        <label for="affichage"><?php echo($question->getQuestion()) ?>
                                                            <?php if ($question->getAffichage() === 'Case'): ?>
                                                              <br><br>
                                                              <?php $options = explode(";", $question->getInputOption()); ?>

                                                              <?php foreach ($options as $option): ?>
                                                                  <input type="checkbox"><?= $option ?></input>
                                                                  <br>
                                                              <?php endforeach ?>
 
                                                        <?php elseif ($question->getAffichage() === 'Radio'): ?>
                                                            <br><br>
                                                        <?php $options = explode(";", $question->getInputOption()); ?>

                                                        <?php foreach ($options as $option): ?>
                                                   
                                                            <input type="radio" name="radio">  <?= $option ?></input>
                                                            <br>
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
                                                                Téléchargement (aucune réponse requise) <br>
                                                                <?php echo download( $question->getInputOption(),'Télécharger: '.$question->getInputOption()); ?>

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
                                                    <?= nav2(
                                                        '<img alt="modifier icon" src="Ressource/img/writing.png" class="images" data-toggle="tooltip" data-placement = "top" title = "Modifier">',
                                                        'Questions',
                                                        'edit',
                                                        $question->getIdQuestion(),
                                                        $id_voyage);
                                                    ?>
                                                </td>
                                                <td>
                                                    <input hidden class="order" type="text" value="<?= $order_ctr++ ?>"
                                                           name="order_<?= $question->getIdQuestion() ?>_0">
                                                </td>
                                                <td >
                                                    <input hidden class="cat_order" type="text" value="<?= $cat_order_ctr ?>"
                                                           name="cat_order_<?= $question->getIdQuestion() ?>_0">
                                                </td>
                                                <td>
                                                    <input hidden class="pour_prof" type="text" value="0"
                                                           name="pour_prof_<?= $question->getIdQuestion() ?>_0">
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
    <!--Button de navigation -->
    <?= nav('<button>Retour aux séjours </button>', 'Voyages', 'index'); ?>
    <?= nav1('<button>Ajouter une question </button>', 'Questions', 'add', $id_voyage); ?>

</div>
<?= load_script('treeView') ?>

<script>
    <?php foreach ($voyagesQuestions as $voyagesQuestion): ?>
    checkOption(<?= $voyagesQuestion->getQuestion()->getIdQuestion() ?>);
    <?php endforeach; ?>
</script>
