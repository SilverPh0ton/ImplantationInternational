<?php
/**
 * @var \App\Controller\ProgrammesController $programmesController
 */

$programmesController->add();
?>

<div class="programmes form columns large-8 medium-10 small-12 large-centered medium-centered small-centered large-text-left medium-text-left small-text-left content">

    <form method="post">
        <fieldset>
            <legend>Ajouter un programme</legend>
            <div class="input text required">
                <label for="nom_programme">Nom de programme</label>
                <input type="text" name="nom_programme" pattern=".*\S.*" maxlength="50" title="Le champ de peut pas être vide" required>
            </div>
        </fieldset>
        <button type="submit">Ajouter</button>
    </form>

    <!--Button de navigation -->
    <?= nav('<button>Retour aux configurations</button>','Configuration','index'); ?>
</div>

