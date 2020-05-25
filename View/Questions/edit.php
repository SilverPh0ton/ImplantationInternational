<?php
/**
 * @var \App\Controller\QuestionsController $questionsController
 * @var \App\Model\Entity\Categorie[] $categories
 * @var \App\Model\Entity\Question $question
 */

$id_question = $_GET['param1'];


if (isset($_GET['param2'])) {
    $source = $_GET['param2'];
    $questionsController->edit($id_question, $source);

} else {
    $questionsController->edit($id_question);
}

$categories = get('categories');
$question = get('question');

?>

<?= load_css('ControlOption') ?>

<div class="questions form columns large-8 medium-10 small-12 large-centered medium-centered small-centered large-text-left medium-text-left small-text-left content">
    <form method="post" >
        <fieldset>
            <legend>Modifier la question</legend>
            <div class="input required">
                <label for="id_categorie">Catégorie</label>
                <select id="categorie">
     <?php
                    foreach ($categories as $categorie):
          ?>
                        <option value=<?= $categorie->getIdCategorie();
                        if ($categorie->getIdCategorie() == $question->getCategorie()->getIdCategorie()): {
                            echo ' selected="selected"';
                        } endif ?>
                        ><?= $categorie->getCategorie() ?></option>
     <?php
                    endforeach
      ?>
                </select>
                <input type="hidden" id="id_categorie" name="id_categorie" value="<?= $categorie->getIdCategorie()?>">
            </div>

            <div>
                <label for="question">Question</label>
                <input type="text" name="question" pattern=".*\S.*" maxlength="800"
                       title="Le champ de peut pas être vide" value="<?= $question->getQuestion() ?>">
            </div>

            <div class="input required">
                <label for="affichage">Mode d'affichage (Comment l'étudiant doit repondre)</label>

                <div class="ControlOption">
     <?php if ("Mention" == $question->getAffichage()): ?>
                        <input hidden type="radio" name="affichage" value="Mention"
                               class="displayOption" <?php if ("Mention" == $question->getAffichage()): {
                            echo 'checked="checked"';
                        } endif; ?> >
                        <label>Mention <br> (aucune réponse requise)</label>

     <?php elseif ("Telechargement" == $question->getAffichage()): ?>
                        <input hidden type="radio" name="affichage" value="Telechargement"
                               class="displayOption" <?php if ("Telechargement" == $question->getAffichage()): {
                            echo 'checked="checked"';
                        } endif ?> >
                        <label>Document à télécharger <br> (aucune réponse requise)</label>
         <?php echo download('empty.txt', 'Télécharger') ?>

     <?php elseif ("Case" == $question->getAffichage()): ?>
                        <input hidden type="radio" name="affichage" value="Case"
                               class="displayOption" <?php if ("Case" == $question->getAffichage()): {
                            echo 'checked="checked"';
                        } endif ?> >
                        <label for="affichage">Choix multiple</label> <br>
                        <input type="checkbox">

         <?php elseif ("Radio" == $question->getAffichage()): ?>
                        <input hidden type="radio" name="affichage" value="Radio"
                               class="displayOption" <?php if ("Radio" == $question->getAffichage()): {
                            echo 'checked="checked"';
                        } endif ?> >
                        <label for="affichage">Radio</label> <br>
                        <input type="radio">


     <?php elseif ("Chiffre" == $question->getAffichage()): ?>
                        <input hidden type="radio" name="affichage" value="Chiffre"
                               class="displayOption" <?php if ("Chiffre" == $question->getAffichage()): {
                            echo 'checked="checked"';
                        } endif ?> >
                        <label for="affichage">Nombre</label> <br>
                        <input type="number">


     <?php elseif ("Date" == $question->getAffichage()): ?>
                        <input hidden type="radio" name="affichage" value="Date"
                               class="displayOption" <?php if ("Date" == $question->getAffichage()): {
                            echo 'checked="checked"';
                        } endif ?> >
                        <label for="affichage">Date</label> <br>
                        <input type="date">

     <?php elseif ("Liste" == $question->getAffichage()): ?>
                        <input hidden type="radio" name="affichage" value="Liste"
                               class="displayOption" <?php if ("Liste" == $question->getAffichage()): {
                            echo 'checked="checked"';
                        } endif ?> >
                        <label for="affichage">Liste déroulante</label> <br>
                        <select>
                            <option>Option 1</option>
                            <option>Option 2</option>
                            <option>Option 3</option>
                            <option>Option 4</option>
                        </select>

     <?php elseif ("Fichier" == $question->getAffichage()): ?>
                        <input hidden type="radio" name="affichage" value="Fichier"
                               class="displayOption" <?php if ("Fichier" == $question->getAffichage()): {
                            echo 'checked="checked"';
                        } endif ?> >
                        <label for="affichage">Déposer un document numérique</label> <br>
                        <input type="file">

     <?php elseif ("Curseur" == $question->getAffichage()): ?>
                        <input hidden type="radio" name="affichage" value="Curseur"
                               class="displayOption" <?php if ("Curseur" == $question->getAffichage()): {
                            echo 'checked="checked"';
                        } endif ?> >
                        <label for="affichage"> Curseur de défilement</label> <br>
                        <input type="range" class="slider" name="rangeInput"
                               onchange="$('#rangeValue').text(this.value);">
                        <span id="rangeValue">0</span>

     <?php elseif ("ZoneTexte" == $question->getAffichage()): ?>
                        <input hidden type="radio" name="affichage" value="ZoneTexte"
                               class="displayOption" <?php if ("ZoneTexte" == $question->getAffichage()): {
                            echo 'checked="checked"';
                        } endif ?> >
                        <label for="affichage">Zone de texte</label> <br>
                        <textarea></textarea>

     <?php endif; ?>
                </div>
            </div>

            <div>
                <label id="options">Options d'affichage</label>
                <div id="optionBorder" disabled="none">

     <?php
                    $min = 0;
                    $max = 100;
                    $step = 1;
                    $list = 'Option 1;Option 2;Option 3;Option 4';
                    $file = 'Aucun fichier déposé';
                    if ($question->getAffichage() === 'Curseur' || $question->getAffichage() === 'Chiffre') {
                        $extrmum = explode(";", $question->getInputOption());
                        if (sizeof($extrmum) >= 3) {
                            $min = $extrmum[0];
                            $max = $extrmum[1];
                            $step = $extrmum[2];
                        }
                    } else if ($question->getAffichage() === 'Liste' || $question->getAffichage() === 'Case' || $question->getAffichage() === 'Radio') {
                        $list = $question->getInputOption();
                    } else if ($question->getAffichage() === 'Telechargement') {
                        $file = $question->getInputOption();
                    }
      ?>

                    <div id="list_option">
                        <label for="list_option">Entrez les options séparées de point-virgule. Ex.: Option 1;Option
                            2;Option 3</label>
                        <input type="text" name="list_option" value="<?= $list ?>" pattern=".*\S.*" maxlength="500"
                               title="Le champ de peut pas être vide">
                    </div>

                    <div id="value_min">
                        <label for="value_min">Valeur minimum autorisée</label>
                        <input type="number" name="value_min" value="<?= $min ?>" max="9999999" required>
                    </div>

                    <div id="value_max">
                        <label for="value_max">Valeur maximum autorisée</label>
                        <input type="number" name="value_max" value="<?= $max ?>" max="9999999" required>
                    </div>

                    <div id="value_step">
                        <label for="value_step">Interval entre deux valeurs</label>
                        <input type="number" name="value_step" value="<?= $step ?>" step="0.001" min="0" max="9999999"
                               required>
                    </div>

                    <div id="file">
                        <label for="myfile">Document</label>
                        <input type="file" name="file">
                        <br>
                        <span><?= $file ?> </span>
                    </div>

                </div>
            </div>

            <div>
                <label for="regroupement">Regroupement</label>
 <?php $typeRegroupement = ""; ?>
                <select id="regroupementChange">
                    <option value="etudiant" <?php if (0 == $question->getRegroupement()): {
                    $typeRegroupement = "etudiant";
                        echo ' selected';
                    } endif ?>>Étudiant
                    </option>
                    <option value="prof" <?php if (1 == $question->getRegroupement()): {
                        $typeRegroupement = "prof";
                        echo ' selected';
                    } endif ?> >Accompagnateur
                    </option>
                    <option value="prof_etu" <?php if (2 == $question->getRegroupement()): {
                        $typeRegroupement = "prof_etu";
                        echo ' selected';
                    } endif ?>>Accompagnateur et étudiant
                    </option>
                    <option value="proposition" <?php if (9 == $question->getRegroupement()): {
                        $typeRegroupement = "proposition";
                        echo ' selected';
                    } endif ?>>Proposition
                    </option>
                </select>
                <input type="hidden" id="regroupementHidden" name="regroupement" value="<?=  $typeRegroupement?>">
            </div>

            <div>
                <label for="actif">Actif?</label>
                <input type="checkbox" name="actif" <?= ($question->getActif() ? 'checked' : '') ?>>
            </div>

            <div>
                <label for="info_sup">Informations supplémentaire</label>
                <textarea name="info_sup" maxlength="250"><?= $question->getInfoSup() ?></textarea>
            </div>

            <div>
                <input name="input_option" type="hidden" id="input_option" value="<?= $question->getInputOption() ?>">
            </div>
            <button type="submit">Enregistrer</button>
            <?= nav('<button type="button">Retourner à la liste de questions</button>', 'questions', 'index'); ?>
        </fieldset>


    </form>


</div>

<?= load_script('optionsDisplayer') ?>
