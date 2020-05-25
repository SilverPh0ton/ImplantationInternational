<?php
/**
 * @var \App\Controller\ProgrammesController $programmesController
 * @var \App\Model\Entity\Programme $programme
 */

$id_programme = $_GET['param1'];
$programmesController->edit($id_programme);

$programme = get('programme');
?>

<div class="programmes form columns large-8 medium-10 small-12 large-centered medium-centered small-centered large-text-left medium-text-left small-text-left content">

    <form method="post">
        <fieldset>
            <legend>Modifier le programme</legend>
            <div class="input text required">
                <label for="nom_programme">Nom de programme</label>
                <input type="text" name="nom_programme" pattern=".*\S.*" maxlength="50" title="Le champ de peut pas être vide" value="<?= $programme->getNomProgramme()?>" required>
            </div>
            <div class="input text required">
                <label for="actif">Actif</label>
                <input type="checkbox" name="actif" id="actif" <?= ($programme->getActif() ? 'checked' : '')?>>
            </div>
        </fieldset>
        <button type="submit">Enregistrer</button>
    </form>

    <!--Button de navigation -->
    <?= nav('<button>Retour aux configurations</button>','Configuration','index');?>
</div>