<?php
/**
 * @var \App\Controller\DestinationsController $destinationsController

 */

$destinationsController->add();
?>

<div class="destinations form columns large-8 medium-10 small-12 large-centered medium-centered small-centered large-text-left medium-text-left small-text-left content">

    <form method="post">
    <fieldset>
        <legend>Ajouter une destination</legend>
        <div class="input text">
            <label for="nom_pays">Nom de pays</label>
            <input type="text" name="nom_pays" id="nom_pays" pattern = ".*\S.*" minlength="1" maxlength="50" title="Le champ de peut pas être vide" required>
        </div>
    </fieldset>

        <button type="submit">Ajouter</button>
    </form>

    <!--Button de navigation -->
    <?= nav('<button>Retour aux configurations </button>', 'Configuration', 'index'); ?>
</div>

