<?php
/**
 * @var \App\Controller\CategoriesController $categoriesController
 * @var \App\Model\Entity\Categorie $categorie
 */

$id_categorie = $_GET['param1'];
$categoriesController->edit($id_categorie);

$categorie = get('categorie');
?>

<div class="categories form columns large-8 medium-10 small-12 large-centered medium-centered small-centered large-text-left medium-text-left small-text-left content">

    <form method="post">
        <fieldset>
            <legend>Modifier la catégorie</legend>
            <div class="input text required">
                <label for="categorie">Catégorie</label>
                <input name="categorie" id="categorie" pattern=".*\S.*" title="Le champ ne peut pas être vide"
                       type="text" maxlength="50" value="<?= $categorie->getCategorie() ?>" required>
            </div>
            <div class=" input text required">
                <label for="actif">Actif</label>
                <input type="checkbox" name="actif" id="actif" <?= ($categorie->getActif() ? 'checked' : '') ?>>
            </div>

        </fieldset>

        <button type="submit">Enregistrer</button>
    </form>
    <!--Button de navigation -->

    <?= nav('<button>Retour aux configurations </button>', 'Configuration', 'index'); ?>
</div>
