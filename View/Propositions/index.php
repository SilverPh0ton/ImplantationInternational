<?php
/**
 * @var App\Controller\VoyagesController $voyagesController
 * @var \App\Model\Entity\Proposition[] $propositions
 * @var App\Model\Entity\Compte $connectedUser
 */

$propositionController->index();
$propositionController->voyageFromProposition();

$propositions = get('propositions');

?>
<div class="voyages index large-12 medium-12 small-12 content large-text-left medium-text-left small-text-left columns content">

    <h3>Propositions de séjour</h3>
  
    <?php if ($connectedUser->getType() == 'admin' || $connectedUser->getType() == 'prof'):
        echo nav('<button class="add-btn">Ajouter une proposition </button>', 'Propositions', 'add');
    endif; ?>

    <table class="table_to_paginate">
        <thead>
        <tr>
            <th scope="col">Nom du projet</th>
            <th scope="col">Pays</th>

            <th scope="col" class='optionalField'>Date de départ</th>
            <th scope="col" class='optionalField'>Date de retour</th>
            <th scope="col">État</th>
            <th scope="col" class="actions"> </th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($propositions as $proposition):?>
        <tr>

            <?php
            if ($proposition->getApprouvee() == 0) {
                $color = 'style="color: #000000"';
            } else if ($proposition->getApprouvee() == 2) {
                $color = 'style="color: #aaaaaa"';
            } else if ($proposition->getApprouvee() == 1) {
                $color = 'style="color: #D91515"';
            }
            ?>

            <td <?php echo $color ?> > <?= $proposition->getNomProjet() ?></td>
            <td <?php echo $color ?> > <?= $proposition->getDestination()->getNomPays() ?></td>
            <td <?php echo $color ?> class='optionalField' data-sort="<?=$proposition->getDateDepart()?>">
                <?= dateToFrench($proposition->getDateDepart()) ?></td>
            <td <?php echo $color ?> class='optionalField' data-sort="<?=$proposition->getDateRetour()?>>">
                <?= dateToFrench($proposition->getDateRetour()) ?></td>
            <td <?php echo $color ?>
                    class='optionalField'>
                <?php
                if($proposition->getApprouvee() === '0'){
                    echo "En attente";
                }
                else if($proposition->getApprouvee() === '2'){
                    echo "Validé";
                }
                else if($proposition->getApprouvee() === '1'){
                    echo "Refusé";
                }
                ?>
            </td>
            <td class="actions" <?php echo $color ?> >

                <?php
                echo nav1(
                    '<img alt="afficher icon" src="Ressource/img/eye.png" class="images" data-toggle="tooltip" data-placement = "top" title = "Afficher">',
                    'Propositions',
                    'View',
                    $proposition->getIdProposition());

                    if($proposition->getApprouvee() != '2' || isOfType([ADMIN])) {
                        echo nav1(
                            '<img alt="modifier icon" src="Ressource/img/writing.png" class="images" data-toggle="tooltip" data-placement = "top" title = "Modifier">',
                            'Propositions',
                            'Edit',
                            $proposition->getIdProposition());
                    }

                if (isOfType([ADMIN])){
                    if($proposition->getApprouvee() != '2'){
                        echo('<img data-toggle="modal" data-target="#myModal_accept_'.$proposition->getIdProposition().'" alt="accepter icon" src="Ressource/img/check-solid.png" class="images" data-placement = "top" title = "Accepter">');
                        echo('<img data-toggle="modal" data-target="#myModal_refuse_'.$proposition->getIdProposition().'" alt="refuser icon" src="Ressource/img/ban-solid.png" class="images" data-placement = "top" title = "Refuser">');
                    }
                }
                if($proposition->getApprouvee() === '2'){

                echo nav1('<img alt="Recycler le projet icon" src="Ressource/img/btRecycle.png" class="images" data-placement = "top" title = "Réutilisation du projet">',
                'Propositions',
                 'Add',
                    $proposition->getIdProposition());}
                ?>
                <div class="modal" id="<?= 'myModal_accept_'.$proposition->getIdProposition() ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Confirmation</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                Êtes-vous certain de vouloir accepter cette proposition ?
                                <form method="post" id="<?= 'form_accept_'.$proposition->getIdProposition() ?>">
                                    <input type="hidden" value="<?= $proposition->getIdProposition() ?>"
                                           name="idProp_transform">
                                </form>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <?php
                                echo('<button  type="submit" form="form_accept_'.$proposition->getIdProposition().'" class="btn btn-primary" value="bt_confirm" >Confirmer</button>');
                                echo('<button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>');
                                ?>

                            </div>

                        </div>
                    </div>
                </div>


                <!-- Modal refuser -->
                <div class="modal" id="<?= 'myModal_refuse_'.$proposition->getIdProposition() ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Confirmation</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form method="post" id="<?= 'form_refuse_'.$proposition->getIdProposition() ?>">
                                    <label for="declineReason"> Veuillez indiquer une raison de refus
                                        <input type="hidden" value="<?= $proposition->getIdProposition() ?>"
                                               name="idProp">
                                        <textarea name="declineReason" id="declineReason" cols="30" rows="10" title="Raison de refus" maxlength="255"></textarea>
                                    </label>
                                </form>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <?php
                                echo('<button form="form_refuse_'.$proposition->getIdProposition().'" type="submit" class="btn btn-primary" value="bt_refuse">Confirmer</button>');
                                echo('<button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>');
                                ?>

                            </div>

                        </div>
                    </div>
                </div>

        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>

<script>
    var order = [[ 6, 'asc' ],[ 4, 'asc' ]];
</script>
<?= load_script('paginator') ?>


