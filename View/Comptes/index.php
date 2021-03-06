<?php
/**
 * @var \App\Model\Entity\Compte[] $comptes
 * @var \App\Model\Entity\Compte $connectedUser
 * @var App\Controller\ComptesController $compteController ;
 */
$comptesController->index();

$comptes = get('comptes');
$compteType = $connectedUser->getType();
?>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js" crossorigin="anonymous"></script>

<div class="comptes index large-12 medium-12 small-12 content large-text-left medium-text-left small-text-left">

    <?php if(isOfType([ADMIN]))
        echo '<h3>Utilisateurs</h3>'
    ?>
    <?php if(isOfType([PROF]))
        echo '<h3>Participants</h3>'
    ?>
    <?php if ($compteType === 'admin'):
        echo nav('<button class="add-btn">Ajouter un utilisateur </button>','comptes','add');
    endif; ?>

    <br>
    <table class="table_to_paginate_part">
        <thead>
        <tr>
            <th scope="col"><?= 'Nom d\'utilisateur'?></th>
            <th scope="col" class='optionalField'><?= 'Type'?></th>
            <th scope="col"><?= 'Prénom'?></th>
            <th scope="col"><?= 'Nom'?></th>
            <th scope="col" class='optionalField'><?= 'Programme'?></th>
            <th scope="col" class='optionalField'><?= 'Actif'?></th>
            <th scope="col" class="actions"></th>
            <th scope="col"><?= 'Courriel'?></th>
            <th scope="col"><?= 'Téléphone'?></th>
            <th scope="col"><?= 'Date de naissance'?></th>
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
                    } elseif ($compte->getType() === 'admin') {
                        echo 'Administrateur';
                    }
                    ?>
                </td>
                <td <?php echo $color ?> ><?= $compte->getPrenom() ?></td>
                <td <?php echo $color ?> ><?= $compte->getNom() ?></td>
                <td <?php echo $color ?> class='optionalField'><?= $compte->getProgramme()->getNomProgramme() ?></td>
                <td <?php echo $color ?> class='optionalField'><?= $compte->getActif() ? 'Oui' : 'Non'; ?></td>
                <td class="actions">

                    <?php
                    if($compte->getAnonyme()||$compteType=='admin'){
                    echo nav1('<img alt="afficher icon" src="Ressource/img/eye.png" class="images" data-toggle="tooltip" data-placement = "top" title = "Voir">','Comptes','View',$compte->getIdCompte());
                    if ($connectedUser->getType() === 'admin') {
                      echo nav1('<img alt="afficher icon" src="Ressource/img/writing.png" class="images" data-toggle="tooltip" data-placement = "top" title = "Modifier">','Comptes','Edit',$compte->getIdCompte());
                    }}
                    ?>
                </td>
                <td><?= $compte->getCourriel() ?></td>
                <td><?= $compte->getTelephone() ?></td>
                <td><?= $compte->getDateNaissance() ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    var order = [[ 5, 'desc' ],[ 0, 'asc' ]];

    sessionStorage.removeItem('pseudo');
    sessionStorage.removeItem('select_type_acc');
    sessionStorage.removeItem('actif');
    sessionStorage.removeItem('courriel');
    sessionStorage.removeItem('prenom');
    sessionStorage.removeItem('nom');
    sessionStorage.removeItem('telephone');
    sessionStorage.removeItem('id_programme');
    sessionStorage.removeItem('date_naissance[year]');
    sessionStorage.removeItem('date_naissance[month]');
    sessionStorage.removeItem('date_naissance[day]');
</script>
<?= load_script('paginatorParticipants') ?>
