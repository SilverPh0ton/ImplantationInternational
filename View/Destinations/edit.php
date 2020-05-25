<?php
/**
 * @var \App\Controller\DestinationsController $destinationsController
 * @var \App\Model\Entity\Destination $destination
 */
$id_destination = $_GET['param1'];
$destinationsController->edit($id_destination);

$destination = get('destination');

?>

<div class="destinations form columns large-8 medium-10 small-12 large-centered medium-centered small-centered large-text-left medium-text-left small-text-left content">
    <form method="post">
    <fieldset>
        <legend>Modifier la destination</legend>
        <div class="input text">
            <label for="nom_pays">Nom de pays</label>
            <input type="text" name="nom_pays" id="nom_pays" pattern = ".*\S.*" minlength="1" maxlength="50" title="Le champ de peut pas être vide" value="<?= $destination->getNomPays()?>" required>
        </div>
        <div class="input checkbox">
            <label for="actif">Actif</label>
            <input type="checkbox" name="actif" id="actif" <?= ($destination->getActif() ? 'checked' : '')?> >
        </div>
    </fieldset>

        <button type="submit">Enregistrer</button>
    </form>

    <!--Button de navigation -->
    <?= nav('<button>Retour aux configurations </button>', 'Configuration', 'index');?>
</div>

