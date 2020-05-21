<?php
/**
 * @var \App\Model\Entity\Compte[] $comptes
 * @var \App\Model\Entity\Compte $connectedUser
 * @var \App\Controller\VoyagesController $voyagesController ;
 */
$id_voyage = $_GET['param1'];
$voyagesController->Viewparticipants($id_voyage);

$comptes = get('comptes');
$compteType = $connectedUser->getType();
?>

<div class="comptes index large-12 medium-12 small-12 content large-text-left medium-text-left small-text-left">

    <h3>Paticipants au voyage</h3>

    <table class="table_to_paginate">
        <thead>
        <tr>
            <th scope="col"><?= 'Nom d\'utilisateur'?></th>
            <th scope="col" class='optionalField'><?= 'Type'?></th>
            <th scope="col"><?= 'Prénom'?></th>
            <th scope="col"><?= 'Nom'?></th>
            <th scope="col" class='optionalField'><?= 'Programme'?></th>
            <th scope="col" class='optionalField'><?= 'Actif'?></th>
            <th scope="col" class="actions"></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($comptes as $compte):
            $color = $compte->getActif() ? '' : 'style="color: #aaaaaa"'
            ?>
            <tr>
                <td <?php echo $color ?> ><?= $compte->getPseudo() ?></td>
                <td <?php echo $color ?> class='optionalField'>
                    <?php
                    if ($compte->getType() === 'etudiant') {
                        echo 'Étudiant';
                    } elseif ($compte->getType() === 'prof') {
                        echo 'Accompagnateur';
                    } 
                    ?>
                </td>
                <td <?php echo $color ?> ><?= $compte->getPrenom() ?></td>
                <td <?php echo $color ?> ><?= $compte->getNom() ?></td>
                <td <?php echo $color ?> class='optionalField'><?= $compte->getProgramme()->getNomProgramme() ?></td>
                <td <?php echo $color ?> class='optionalField'><?= $compte->getActif() ? 'Oui' : 'Non'; ?></td>
                <td class="actions">

                    <?php
                    echo nav1('<img alt="afficher icon" src="Ressource/img/eye.png" class="images" data-toggle="tooltip" data-placement = "top" title = "Modifier">','Comptes','View',$compte->getIdCompte());
                    if ($connectedUser->getType() === 'admin') {
                      echo nav1('<img alt="afficher icon" src="Ressource/img/writing.png" class="images" data-toggle="tooltip" data-placement = "top" title = "Modifier">','Comptes','Edit',$compte->getIdCompte());
                    }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>

<!--Button de navigation -->
<?php if ($compteType === 'admin'):
    echo nav('<button>Ajouter un utilisateur </button>','comptes','add');
endif; ?>

<script>
    var order = [[ 5, 'desc' ],[ 0, 'asc' ]];
</script>
<?= load_script('paginator') ?>
