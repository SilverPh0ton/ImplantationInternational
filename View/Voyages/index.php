<?php
/**
 * @var App\Controller\VoyagesController $voyagesController
 * @var \App\Model\Entity\Voyage[] $voyages
 * @var App\Model\Entity\Compte $connectedUser
 */

$voyagesController->index();

$voyages = get('voyages');

?>

<div class="voyages index large-12 medium-12 small-12 content large-text-left medium-text-left small-text-left">

    <h3>Projets de mobilité</h3>

    <table class="table_to_paginate">
        <thead>
        <tr>
            <th scope="col">Nom du projet</th>
            <th scope="col">Pays</th>
            <th scope="col">Ville</th>
            <th scope="col" class='optionalField'>Date de départ</th>
            <th scope="col" class='optionalField'>Date de retour</th>
            <th scope="col" class='optionalField'><?= 'Actif'?></th>
            <th scope="col" class="actions"></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($voyages as $voyage):
            $color = $voyage->getActif() ? '' : 'style="color: #aaaaaa"';
            ?>
            <tr>
                <td <?php echo $color ?> > <?= $voyage->getNomProjet() ?></td>
                <td <?php echo $color ?> > <?= $voyage->getDestination()->getNomPays() ?></td>
                <td <?php echo $color ?> > <?= $voyage->getVille() ?></td>
                <td <?php echo $color ?> class='optionalField' data-sort="<?=$voyage->getDateDepart()?>">
                    <?= dateToFrench($voyage->getDateDepart()) ?></td>
                <td <?php echo $color ?> class='optionalField' data-sort="<?=$voyage->getDateRetour()?>">
                    <?= dateToFrench($voyage->getDateRetour()) ?></td>
                <td <?php echo $color ?> class='optionalField'><?= $voyage->getActif() ? 'Oui' : 'Non'; ?></td>

                <td class="actions" <?php echo $color ?> >
                    <?= nav1(
                        '<img alt="afficher icon" src="Ressource/img/eye.png" class="images" data-toggle="tooltip" data-placement = "top" title = "Afficher">',
                        'Voyages',
                        'View',
                        $voyage->getIdVoyage());
                    ?>
                    <?php
                    if ($connectedUser->getType() == 'admin' || $connectedUser->getType() == 'prof') {
                        if ($connectedUser->getType() == 'admin'){
                        echo nav1(
                            '<img alt="modifier icon" src="Ressource/img/writing.png" class="images" data-toggle="tooltip" data-placement = "top" title = "Modifier">',
                            'Voyages',
                            'Edit',
                            $voyage->getIdVoyage());
                              }
                        echo nav1(
                            '<img alt="invitation icon" src="Ressource/img/invite.png" class="images" data-toggle="tooltip" data-placement = "top" title = "Code d\'activation">',
                            'Activations',
                            'Index',
                            $voyage->getIdVoyage());

                        echo nav1(
                            '<img alt="formulaire icon" src="Ressource/img/clipboard.png" class="images" data-toggle="tooltip" data-placement = "top" title = "Liste de formulaire">',
                            'Valeurs',
                            'Index',
                            $voyage->getIdVoyage());
                    }

                    if ($connectedUser->getType() == 'admin') {
                        echo nav1(
                            '<img alt="formulaire icon" src="Ressource/img/design.png" class="images" data-toggle="tooltip" data-placement = "top" title = "Editeur de formulaire">',
                            'VoyagesQuestions',
                            'Index',
                            $voyage->getIdVoyage());
                    }

                    if ($connectedUser->getType() == 'etudiant') {
                        echo nav2(
                            '<img alt="formulaire icon" src="Ressource/img/clipboard.png" class="images" data-toggle="tooltip" data-placement = "top" title = "Formulaire">',
                            'Valeurs',
                            'Edit',
                            $voyage->getIdVoyage(),
                            $connectedUser->getIdCompte());
                    }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>



<?php if ($connectedUser->getType() != 'admin'): ?>

    <div class="activations form large-12 medium-12 columns content">

        <form method="post">
            <fieldset>
                <legend> Joindre un autre projet</legend>
                <div class="input text required">
                    <label for="code_activation">Code d'activation</label>
                    <input id="code_activation" type="text" name="code_activation" pattern="[A-Z0-9]{5}-){4}[A-Z0-9]{5}"
                           title="Le champ ne peut pas être vide" maxlength="14">
                </div>
            </fieldset>
            <button type="submit">Se joindre au projet</button>
        </form>

    </div>

<?php endif; ?>

<?= load_script('codeMask') ?>
<script>
    var order = [[ 7, 'desc' ],[ 5, 'asc' ],[ 0, 'asc' ]];
</script>
<?= load_script('paginator') ?>
