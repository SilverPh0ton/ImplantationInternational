<?php
/**
 * @var App\Controller\VoyagesController $voyagesController
 * @var \App\Model\Entity\Proposition $proposition
 */

$id_proposition = $_GET['param1'];

if (isset($_GET['param2'])) {
    $source = $_GET['param2'];
} else {
    $source = null;
}

$propositionController->view($id_proposition, $source);

$compteDemande = get('compteDemande');
$proposition = get('proposition');
$proposition_reponses = get('proposition_reponses');
$categories = get('categories');
$activites = get('activites');

?>

<div class="voyages view columns large-8 medium-10 small-12 large-centered medium-centered small-centered large-text-left medium-text-left small-text-left content">
    <h3>Proposition de projet: <?= $proposition->getNomProjet() ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row">Proposition par:</th>
            <td><?= $compteDemande->getNom().', '.$compteDemande->getPrenom() ?></td>
        </tr>
        <tr>
            <th scope="row">Pays</th>
            <td><?= $proposition->getDestination()->getNomPays() ?></td>
        </tr>
        <tr>
            <th scope="row">Ville</th>
            <td><?= $proposition->getVille() ?></td>
        </tr>

        <tr>
            <th scope="row">Note</th>
            <td><?= $proposition->getNote() ?></td>
        </tr>
        <tr>
            <th scope="row">Date de départ</th>
            <td><?= dateToFrench($proposition->getDateDepart()) ?></td>
        </tr>
        <tr>
            <th scope="row">Date de retour</th>
            <td><?= dateToFrench($proposition->getDateRetour()) ?></td>
        </tr>
        <tr>
            <th scope="row">État</th>
            <td>
                <?php
                if($proposition->getApprouvee() === '0'){
                    echo "En attente";
                }
                else if($proposition->getApprouvee() === '2'){
                    echo "Validé";
                }
                else if($proposition->getApprouvee() === '1'){
                    echo "Refusé";
                }else if($proposition->getApprouvee() === '3'){
                    echo "Brouillon";
                }
                ?>
            </td>
        </tr>
        <?php if($proposition->getApprouvee() === '1'):?>
            <tr>
                <th scope="row">Raison de refus</th>
                <td><?= $proposition->getMsgRefus() ?></td>
            </tr>
        <?php endif;?>

        <table class="activityTable">
            <thead>
            <tr>
                <th>Proposition par:</th>
                <th>Endroit</th>
                <th>Description</th>
                <th>Date de départ</th>
                <th>Date de fin</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($activites as $activite): ?>
                <tr>
                    <td><?= $compteDemande->getNom().', '.$compteDemande->getPrenom() ?></td>
                    <td><?php echo $activite->getEndroit(); ?></td>

                    <td><?php echo $activite->getDescription(); ?></td>

                    <td><?php echo dateToFrench($activite->getDateDepart()); ?></td>
                    <td><?php echo dateToFrench($activite->getDateRetour()); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php if (empty($activites)): ?>
            <h2>Aucune question pour ce voyage</h2>
        <?php endif; ?>
    </table>

    <fieldset>
        <legend>Renseignements supplémentaires</legend>
        <?php if (empty($categories)): ?>
            <h2>Aucune question pour ce voyage</h2>
        <?php else: ?>

            <div class="accordion md-accordion accordion-1" id="accordionEx23" role="tablist">
                <?php $ctr = 0; ?>
                <?php foreach ($categories as $categorie): ?>
                    <div class="card">
                        <div class="card-header blue lighten-3 z-depth-1" role="tab" id="heading<?php $ctr++;
                        echo $ctr ?>">
                            <h5 class="text-uppercase mb-0 py-1">
                                <a class="white-text font-weight-bold" data-toggle="collapse"
                                   href="#collapse<?php echo $ctr ?>" aria-expanded="true"
                                   aria-controls="collapse<?php echo $ctr ?>">
                                    <?= $categorie->getCategorie() ?>
                                </a>
                            </h5>
                        </div>
                        <div id="collapse<?php echo $ctr ?>" class="collapse" role="tabpanel"
                             aria-labelledby="heading<?php echo $ctr ?>" data-parent="#accordionEx23">
                            <div class="card-body">

                                <?php foreach ($proposition_reponses as $proposition_reponse): ?>
                                    <?php $question = $proposition_reponse->getQuestion(); ?>
                                    <?php if ($question->getCategorie()->getIdCategorie() === $categorie->getIdCategorie() && $question->getActif()): ?>
                                        <div style="width:100%; margin:0 auto; border-top: #1a1a1a;">

                                            <span><?= $question->getQuestion() ?></span>

                                            <?php $vraiValeurs = $proposition_reponse->getReponse(); ?>
                                            <label for="affichage">
                                                <!--Loop pour questions-->
                                                <span><?php if ($question->getAffichage() === 'Case'): ?>
                                                        <?php if (!isset($vraiValeurs)) : $vraiValeurs = 'off'; endif; ?> <!-- Default Value-->

                                                        <input type="checkbox"
                                                               name="<?= $question->getIdQuestion() ?>"
                                        <?php if ('on' === $vraiValeurs): {
                                            echo ' checked';
                                        } endif ?>
                                    >

                                                    <?php elseif ($question->getAffichage() === 'Telechargement'): ?>

                                                        <?php
                                                        echo download($question->getInputOption(),'Télécharger: ' . $question->getInputOption());?>

                                                    <?php elseif ($question->getAffichage() === 'Chiffre'):
                                                        $extrmum = explode(";", $question->getInputOption());
                                                        if (sizeof($extrmum) >= 3) {
                                                            $min = $extrmum[0];
                                                            $max = $extrmum[1];
                                                            $step = $extrmum[2];
                                                        } else {
                                                            $min = 0;
                                                            $max = 100;
                                                            $step = 1;
                                                        }
                                                        ?>
                                                        <?php if (!isset($vraiValeurs)) : $vraiValeurs = '0'; endif; ?> <!-- Default Value-->

                                                        <input type="number"
                                                               name="<?= $question->getIdQuestion() ?>"
                                                               value="<?= $vraiValeurs ?>" min="<?= $min ?>"
                                                               max="<?= $max ?>" step="<?= $step ?>">

                                                    <?php elseif ($question->getAffichage() === 'Date'): ?>
                                                        <?php if (!isset($vraiValeurs)) : $vraiValeurs = '2019-01-01'; endif; ?> <!-- Default Value-->

                                                        <input type="date"
                                                               name="<?= $question->getIdQuestion() ?>"
                                                               value="<?= $vraiValeurs ?>">

                                                    <?php elseif ($question->getAffichage() === 'Liste'):
                                                        $options = explode(";", $question->getInputOption()); ?>
                                                        <?php if (!isset($vraiValeurs)) : $vraiValeurs = $options[0]; endif; ?> <!-- Default Value-->

                                                        <select name=<?= $question->getIdQuestion() ?>>
                                        <?php foreach ($options as $option): ?>
                                            <option value=<?= $option ?>
                                                    <?php if ($option === $vraiValeurs): {
                                                        echo ' selected="selected"';
                                                    } endif ?>
                                            >
                                                <?= $option ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>

                                                    <?php elseif ($question->getAffichage() === 'Fichier'): ?>
                                                        <?php
                                                        if (!isset($vraiValeurs)) {
                                                            $vraiValeurs = 'empty.txt';
                                                        }//Default Value
                                                        echo download(  $vraiValeurs,'Télécharger: ' . $vraiValeurs);
                                                        ?>

                                                    <?php elseif ($question->getAffichage() === 'Curseur'):
                                                        $extrmum = explode(";", $question->getInputOption());
                                                        if (sizeof($extrmum) >= 3) {
                                                            $min = $extrmum[0];
                                                            $max = $extrmum[1];
                                                            $step = $extrmum[2];
                                                        } else {
                                                            $min = 0;
                                                            $max = 100;
                                                            $step = 1;
                                                        }
                                                        ?>
                                                        <?php if (!isset($vraiValeurs)) : $vraiValeurs = ($min + $max) / 2; endif; ?> <!-- Default Value-->

                                                        <input type="range" class="slider"
                                                               name="<?= $question->getIdQuestion() ?>"
                                                               value="<?= $vraiValeurs ?>"
                                                               onchange="$('#rangeValue<?= $question->getIdQuestion() ?>').text(this.value);"
                                                               min="<?= $min ?>" max="<?= $max ?>">
                                                        <span
                                                                id="rangeValue<?= $question->getIdQuestion() ?>"><?= $vraiValeurs ?></span>
                                                        <br><br>

                                                    <?php elseif ($question->getAffichage() === 'ZoneTexte'): ?>
                                                        <?php if (!isset($vraiValeurs)) : $vraiValeurs = ''; endif; ?> <!-- Default Value-->

                                                        <textarea
                                                                name="<?= $question->getIdQuestion() ?>"><?= $vraiValeurs ?></textarea>

                                                    <?php elseif ($question->getAffichage() === 'Couleur'): ?>
                                                        <?php if (!isset($vraiValeurs)) : $vraiValeurs = '#ffffff'; endif; ?> <!-- Default Value-->

                                                        <input type="color"
                                                               name="<?= $question->getIdQuestion() ?>"
                                                               value="<?= $vraiValeurs ?>">

                                                    <?php endif; ?></span>
                                                <span style="float: right">

                                      <a href="#" title="Informations supplémentaires" data-toggle="popover"
                                         data-trigger="focus" data-content="<?= $question->getInfoSup() ?>"> <i
                                                  class="fa fa-info" aria-hidden="true" style="font-size:28px;"></i></a>
                                    </span>


                                        </div><br>
                                        <hr>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </fieldset>

    <?php
    if ($source == null) {//Redirige à la page appropriée
        echo nav('<button>Retour aux propositions </button>', 'Propositions', 'index');
    }
    else{
        echo nav1('<button>Retour aux voyage </button>', 'Voyages', 'view', $source);
    }
    ?>
</div>

