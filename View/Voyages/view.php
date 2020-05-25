<?php
/**
 * @var App\Controller\VoyagesController $voyagesController
 * @var \App\Model\Entity\Voyage $voyage
 */


$id_voyage = $_GET['param1'];
$voyagesController->view($id_voyage);

$voyage = get('voyage');
$userCount = get('userCount');
$compteConnecter=$_SESSION["connectedUser"]
  
if(is_null($voyage)){
    return $voyagesController->redirect('voyages', 'index');
}
?>

<div class="columns large-8 medium-10 small-12 large-centered medium-centered small-centered large-text-left medium-text-left small-text-left content" >

    <h3 id="titre">Nom du projet: <?= $voyage->getNomProjet() ?></h3>

    <table class="vertical-table">
        <tr>
            <th scope="row">Pays</th>
            <td id="pays"><?= $voyage->getDestination()->getNomPays() ?></td>
        </tr>
        <tr>
            <th scope="row">Ville</th>
            <td id="ville"><?= $voyage->getVille() ?></td>
        </tr>
        <tr>
            <th scope="row">Note</th>
            <td id="note"><?= $voyage->getNote() ?></td>
        </tr>
        <tr>
            <th scope="row">Date de départ</th>
            <td id="dateD"><?= dateToFrench($voyage->getDateDepart()) ?></td>
        </tr>
        <tr>
            <th scope="row">Date de retour</th>
            <td id="dateR"><?= dateToFrench($voyage->getDateRetour()) ?></td>
        </tr>
        <tr>
            <th scope="row">Actif</th>
            <td id="actif"><?= $voyage->getActif() ? 'Oui' : 'Non'; ?></td>
        </tr>
        <tr>
            <th scope="row">Participant(s)</th>
            <td id="nbrpart"> <?php
                if($compteConnecter->getType()!='etudiant') {

                    echo nav1(
                        '<img alt="afficher icon" src="Ressource/img/eye.png" class="images" data-toggle="tooltip" data-placement = "top" title = "Afficher">',
                        'Voyages',
                        'viewparticipants',
                        $id_voyage);
                }?> <?= $userCount ?> participant(s)</td>
        </tr>
        <tr>
            <th scope="row">Proposition d'origine</th>
            <td>
                <?= nav2(
                    '<img alt="afficher icon" src="Ressource/img/eye.png" class="images" data-toggle="tooltip" data-placement = "top" title = "Afficher">',
                    'Propositions',
                    'View',
                    $voyage->getIdProposition(),
                    $id_voyage);
                ?>
            </td>
        </tr>
    </table>


    <?= nav('<button>Revenir à la liste des projets</button>', 'Voyages', 'index') ?>
    <script type="text/javascript">
    $( document ).ready(function() {

$('#generate').click(function(){

       titre   = $('#titre').text();
       pays    = $('#pays').text();
       ville   = $('#ville').text();
       note    = $('#note').text();
       dateD   = $('#dateD').text();
       dateR   = $('#dateR').text();
       actif   = $('#actif').text();
       nbrpart = $('#nbrpart').text();

        if (ville == ""){
        ville = "Non précisé";}
        if (note == ""){
        note = "Aucune note";}
        //alert(titre+""+pays+""+ville+""+note+""+dateD+""+dateR+""+actif+""+nbrpart);
          $.ajax({
                  url: "./View/Voyages/generatepdf.php",
                  type: 'POST',
                    data:{
                      titre:titre,
                      pays:pays,
                      ville:ville,
                      note:note,
                      dateD:dateD,
                      dateR:dateR,
                      actif:actif,
                      nbrpart:nbrpart

                    },
                  success: function(res) {
                    window.open("View/Voyages/afficherpdf.php",'_blank');
                  },
                  error:function(res){
                    alert('error');
                  }
              });

        });
  });
    </script>
    <button id="generate">Générer un PDF</button>


</div>
