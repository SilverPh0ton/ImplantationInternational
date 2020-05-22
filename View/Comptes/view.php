<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Compte $compte
 * @var  \App\Controller\ComptesController $comptesController
 */
/*$session = $this->request->getSession();
$user_data = $session->read('Auth.User');*/

$id_compte = $_GET['param1'];
$comptesController->view($id_compte);

$compte = get('compte');
$listVoyage = get('listVoyage');

?>

<div class="comptes view columns large-8 medium-10 small-12 large-centered medium-centered small-centered large-text-left medium-text-left small-text-left content">


    <h3>Compte de: <?= $compte->getPseudo() ?></h3>

    <table class="vertical-table">
        <tr>
            <th scope="row">Nom d'utilisateur</th>
            <td id='nomU'><?= $compte->getPseudo() ?></td>
        </tr>
        <tr>
            <th scope="row">Type</th>
            <td id='type'>
                <?php
                if ($compte->getType() === 'etudiant') {
                    echo 'Étudiants';
                } elseif ($compte->getType() === 'prof') {
                    echo 'Accompagnateur';
                } elseif ($compte->getType()  === 'admin') {
                    echo 'Administrateur';
                }
                ?>
            </td>
        </tr>
        <tr>
            <th scope="row">Courriel</th>
            <td id='courriel'><?= $compte->getCourriel() ?></td>
        </tr>
        <tr>
            <th scope="row">Prénom</th>
            <td id='prenom'><?= $compte->getPrenom() ?></td>
        </tr>
        <tr>
            <th scope="row">Nom</th>
            <td id='nom'><?= $compte->getNom() ?></td>
        </tr>
        <tr>
            <th scope="row">Téléphone</th>
            <td id='telephone'><?= $compte->getTelephone() ?></td>
        </tr>
        <tr>
            <th scope="row">Programme</th>
            <td id='programme'><?= $compte->getProgramme()->getNomProgramme() ?></td>
        </tr>
        <tr>
            <th scope="row">Date de naissance</th>
            <td id='dateNaissance'><?=dateToFrench($compte->getDateNaissance()) ?></td>
        </tr>

        <?php if($compte->getType() != 'admin'):?>
            <tr>
                <th scope="row">Voyage(s) associé(s)</th>
                <td id='voyage'><?=$listVoyage?></td>
            </tr>
        <?php endif; ?>

    </table>

    <!--Button de navigation -->
    <?php
    if(isOfType([ADMIN,PROF])){
        
        if(isset($_GET['param2'])){
            echo nav1('<button> Retour à la liste des participants </button>', 'Voyages', 'viewparticipants',$_GET['param2']);
        } else {
        echo nav('<button> Retour à la liste des participants </button>', 'Comptes', 'index');
        }
     }
    else{
        echo nav('<button type="button">Revenir à la liste des séjours</button>', 'Voyages', 'index');
    }
    ?>

    <?= nav1('<button type="button"> Modifier ce compte </button>','Comptes','edit',$compte->getIdCompte());?>
    <script type="text/javascript">
    $( document ).ready(function() {

  $('#generate').click(function(){

       nomU   = $('#nomU').text();
       type    = $('#type').text();
       courriel   = $('#courriel').text();
       prenom    = $('#prenom').text();
       nom   = $('#nom').text();
       telephone   = $('#telephone').text();
       programme   = $('#programme').text();
       dateNaissance = $('#dateNaissance').text();
       voyage = $('#voyage').text();

          $.ajax({
                  url: "./View/Comptes/generatepdf.php",
                  type: 'POST',
                    data:{
                      nomU:nomU,
                      type:type,
                      courriel:courriel,
                      prenom:prenom,
                      nom:nom,
                      telephone:telephone,
                      programme:programme,
                      dateNaissance:dateNaissance,
                      voyage:voyage

                    },
                  success: function(res) {
                    window.open("View/Comptes/afficherpdf.php",'_blank');
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
