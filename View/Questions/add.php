<?php
/**
 * @var \App\Controller\QuestionsController $questionsController
 * @var \App\Model\Entity\Categorie[] $categories
 */
if (isset($_GET['param1'])) {
    $source = $_GET['param1'];
} else {
    $source = null;
}

$questionsController->add($source);

$categories = get('categories');

?>

<?= load_css('ControlOption') ?>

<div class="questions form columns large-8 medium-10 small-12 content large-centered medium-centered small-centered large-text-left medium-text-left small-text-left">
    <form method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Ajouter une question</legend>
            <div class="input required">
                <label for="id_categorie">Catégorie</label>
                <select name="id_categorie" required="required">
                    <?php
                    foreach ($categories as $categorie):
                        ?>
                        <option value=<?= $categorie->getIdCategorie() ?>>
                            <?= $categorie->getCategorie() ?></option>
                    <?php
                    endforeach
                    ?>
                </select>
            </div>

            <div class="input text">
                <label for="question">Question</label>
                <input type="text" name="question" pattern=".*\S.*" maxlength="800" title="Le champ de peut pas être vide">
            </div>

            <div class="input required">
                <label for="affichage">Mode d'affichage (Comment l'utilisateur doit répondre)</label>

                <div class="grid-container">
                    <div class="ControlOption">
                        <input type="radio" name="affichage" value="Mention" checked="checked" class="displayOption">
                        <label>Mention <br> (aucune réponse requise)</label>
                    </div>

                    <div class="ControlOption">
                        <input type="radio" name="affichage" value="Telechargement" class="displayOption">
                        <label>Document à télécharger <br> (aucune réponse requise)</label>
                        <?= download('empty.txt', 'Télécharger') ?>
                    </div>

                    <div class="ControlOption">
                        <input type="radio" name="affichage" value="Case" class="displayOption">
                        <label for="affichage">Case à cocher</label> <br>
                        <input type="checkbox">
                    </div>

                    <div class="ControlOption">
                        <input type="radio" name="affichage" value="Chiffre" class="displayOption">
                        <label for="affichage">Nombre</label> <br>
                        <input type="number">
                    </div>

                    <div class="ControlOption">
                        <input type="radio" name="affichage" value="Date" class="displayOption">
                        <label for="affichage">Date</label> <br>
                        <input type="date">
                    </div>

                    <div class="ControlOption">
                        <input type="radio" name="affichage" value="Liste" class="displayOption">
                        <label for="affichage">Liste déroulante</label> <br>
                        <select>
                            <option>Option 1</option>
                            <option>Option 2</option>
                            <option>Option 3</option>
                            <option>Option 4</option>
                        </select>
                    </div>

                    <div class="ControlOption">
                        <input type="radio" name="affichage" value="Fichier" class="displayOption">
                        <label for="affichage">Déposer un document numérique</label> <br>
                        <input type="file">
                    </div>

                    <div class="ControlOption">
                        <input type="radio" name="affichage" value="Curseur" class="displayOption">
                        <label for="affichage"> Curseur de défilement</label> <br>
                        <input type="range" class="slider" name="rangeInput"
                               onchange="$('#rangeValue').text(this.value);">
                        <span id="rangeValue">0</span>
                    </div>

                    <div class="ControlOption">
                        <input type="radio" name="affichage" value="ZoneTexte" class="displayOption">
                        <label for="affichage">Zone de texte</label> <br>
                        <textarea></textarea>
                    </div>

                </div>
            </div>

            <label id="options">Options d'affichage</label>
            <div id="optionBorder" disabled="none">

                <div id="list_option">
                    <label for="list_option">Entrez les options séparées de point-virgule. Ex.: «Option 1;Option
                        2;Option 3»</label>
                    <input type="text" name="list_option" pattern=".*\S.*" maxlength="500" title="Le champ de peut pas être vide">
                </div>

                <div id="value_min">
                    <label for="value_min">Valeur minimum autorisée</label>
                    <input type="number" name="value_min" pattern=".*\S.*" value="0" min="0" max="9999999" required>
                </div>

                <div id="value_max">
                    <label for="value_max">Valeur maximum autorisée</label>
                    <input type="number" name="value_max" pattern=".*\S.*" value="100" min="0" max="9999999" required>
                </div>

                <div id="value_step">
                    <label for="value_step">Intervalle entre deux valeurs</label>
                    <input type="number" name="value_step" pattern=".*\S.*" value="1" step="0.001" min="0" max="9999999" required>
                </div>

                <div id="file">
                    <label for="file">Document</label>
                    <input type="file" name="file">
                </div>

            </div>

            <div>
                <label for="regroupement">Regroupement</label>
                <select id="regroupement" name="regroupement" required="required">
                    <option value="etudiant"/>
                    Étudiant</option>
                    <option value="prof"/>
                    Accompagnateur</option>
                    <option value="prof_etu"/>
                    Accompagnateur et étudiant</option>
                    <option value="proposition"/>
                    Proposition</option>
                </select>
            </div>
            <div id="info_sup">
                <label for="">Informations supplémentaires</label>
                <textarea name="info_sup" maxlength="250"></textarea>
            </div>
            <div id="input_option">
                <input type="hidden" id="input_option" value="none" maxlength="100">
            </div>
            <button type="submit">Ajouter</button>
            <?= nav('<button type="button">Retourner à la liste de questions</button>', 'questions', 'index'); ?>
        </fieldset>

    </form>


</div>

<?= load_script('optionsDisplayer') ?>
