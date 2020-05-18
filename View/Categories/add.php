<?php
/**
 * @var \App\Controller\CategoriesController $categoriesController
 */

$categoriesController->add();
?>

<div class="categories form columns large-8 medium-10 small-12 large-centered medium-centered small-centered large-text-left medium-text-left small-text-left content">

    <form method="post">
    <fieldset>
        <legend>Ajouter une catégorie</legend>
        <div class="input text required">

        <label for="categorie">Catégorie</label>
        <input id="categorie" name="categorie" pattern=".*\S.*" title="Le champ de peut pas être vide" type="text" maxlength="50" required>
        </div>
        <button type="submit">Ajouter</button>
        <!--Button de navigation -->
        <?= nav('<button type="button">Retour aux configurations </button>','Configuration','index'); ?>
    </fieldset>

  </form>


</div>
