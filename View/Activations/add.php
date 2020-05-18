<?php
/**
 * @var \App\Controller\ActivationsController $activationController
 */

$id_voyage = $_GET["param1"];
$activationController->add($id_voyage);

?>

<div class="activations large-8 medium-10 small-12 large-centered medium-centered small-centered large-text-left medium-text-left small-text-left content">

   <form method="post">
    <fieldset>
        <legend>Générer des codes d'activation</legend>

        <label>
            <input type="number" min="1" max="99" name="nbr_code" value="1">
        </label>

       <button type="submit">Générer</button><!--//Button de type submit-->
   </form>

    <!--Button de navigation -->
    <?= nav('<button type="button">Revenir à la liste des voyages</button>', 'Voyages', 'index');?>
    <?= nav1('<button type="button">Retour à la liste des codes existants</button>', 'Activations', 'index', $id_voyage);?>
    </fieldset>


</div>
