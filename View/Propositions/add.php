<?php
/**
 * @var App\Controller\ProgrammesController $propositionController
 */

$propositionController->add();
$propositionDB = new PropositionsDB();
$propositionReponseDB = new PropositionReponsesDB();

$destinations = get('destinations');
$categoriesProposition = get('categoriesProposition');
$questionsProposition = get('questionProposition');
if(isset($_GET['param1'])){
    $proposition = $propositionDB->getPropositionFromId($_GET['param1']);
}

$ctr = 1;
$id = 0;

?>
<?= load_css('tab')?>
<?= load_css('form')?>
<?= load_css('ControlOption')?>
<?= load_script('dynamicTable')?>
<?= load_script('fonctionCase')?>

    <script>
        $(document).ready(function () {
            $('[data-toggle="popover"]').popover({
                trigger: 'hover',
                placement: 'left'
            });
        });


    </script>

    <style>
        .double {
            zoom: 1.2;
            transform: scale(1.2);
            -ms-transform: scale(1.2);
            -webkit-transform: scale(1.2);
            -o-transform: scale(1.2);
            -moz-transform: scale(1.2);
            transform-origin: 0 0;
            -ms-transform-origin: 0 0;
            -webkit-transform-origin: 0 0;
            -o-transform-origin: 0 0;
            -moz-transform-origin: 0 0;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <div class="columns large-8 medium-10 small-12 large-centered medium-centered small-centered large-text-left medium-text-left small-text-left content">

        <form method="post" id="base_form45" enctype="multipart/form-data" action="index.php?controller=Propositions&action=Add">

            <fieldset>
                <legend>Ajouter une proposition</legend>

<?php if (!isOfType([ADMIN])):?>
                    <div class="double">
                        <input type="checkbox" id="brouillon" name="brouillon" value="oui">
                        <label for="brouillon">Il s'agit d'un brouillon</label><br>
                    </div>
<?php endif;?>
                <br>
                <div class="input required">
                    <label id="nom_projet" for="nom_projet">Nom du projet</label>
                    <input type="text" name="nom_projet" pattern=".*\S.*" maxlength="50" title="Le champ de peut pas être vide" value="<?php if(isset($proposition)){echo $proposition->getNomProjet();}else echo '';?>" required>
                </div>

                <div class="input required">
                    <label for="id_destination">Destination</label>
                    <select name="id_destination" required="required">
<?php
                        foreach ($destinations as $destination):
?>
                            <option value=<?= $destination->getIdDestination()?><?php if(isset($proposition)){if($proposition->getDestination()->getIdDestination() == $destination->getIdDestination()){echo 'selected';}}?>>
                                <?= $destination->getNomPays()?></option>
<?php
                        endforeach
?>
                    </select>
                </div>

                <div class="input text">
                    <label for="ville">Ville</label>
                    <input type="text" name="ville" pattern=".*\S.*" value="<?php if(isset($proposition)){echo $proposition->getVille();}else echo '';?>" maxlength="50" title="Le champ ne peut pas être vide">
                </div>


                <div class="input text">
                    <label for="note">Note</label>
                    <textarea name="note" maxlength="500" rows="4"><?php if(isset($proposition)){echo $proposition->getNote();}else echo '';?></textarea>
                </div>

                <div class="input date required">
                    <label for="date_depart">Date de départ</label>
                    <select name="date_depart[year]" required="required">
<?php for ($i = date('Y'); $i <= (date('Y') + 50); $i++):?>
                            <option
                                    value=<?= $i?>
                                    <?= ($i == date('Y')) ? ' selected="selected"' : ''?>>
                                <?= $i?>
                            </option>
<?php endfor;?>
                    </select>

                    <select name="date_depart[month]" required="required">
<?php
                        $i = 0;
                        foreach (return_months() as $month):
?>
                            <option
                                    value=<?= ++$i?>
                                    <?= ($i == date('m')) ? ' selected="selected"' : ''?>>
                                <?= $month?>
                            </option>
<?php
                        endforeach;
?>
                    </select>

                    <select name="date_depart[day]" required="required">
<?php for ($i = 1; $i <= 31; $i++):?>
                            <option
                                    value=<?= $i?>
                                    <?= ($i == date('d')) ? ' selected="selected"' : ''?>
                            >
                                <?= $i?>
                            </option>
<?php endfor;?>
                    </select>
                </div>

                <div class="input date required">
                    <label for="date_retour">Date de retour</label>
                    <select name="date_retour[year]" required="required">
<?php for ($i = date('Y'); $i <= (date('Y') + 50); $i++):?>
                            <option
                                    value=<?= $i?>
                                    <?= ($i == date('Y')) ? ' selected="selected"' : ''?>>
                                <?= $i?>
                            </option>
<?php endfor;?>
                    </select>

                    <select name="date_retour[month]" required="required">
<?php
                        $i = 0;
                        foreach (return_months() as $month):
?>
                            <option
                                    value=<?= ++$i?>
                                    <?= ($i == date('m')) ? ' selected="selected"' : ''?>>
                                <?= $month?>
                            </option>
<?php
                        endforeach;
?>
                    </select>

                    <select name="date_retour[day]" required="required">
<?php for ($i = 1; $i <= 31; $i++):?>
                            <option
                                    value=<?= $i?>
                                    <?= ($i == date('d')) ? ' selected="selected"' : ''?>
                            >
                                <?= $i?>
                            </option>
<?php endfor;?>
                    </select>
                </div>

            </fieldset>

            <div style="text-align: center">Calendrier des activités prévues</div>
            <br>

            <table id="activityTable" class="activityTable" style="white-space: nowrap;">
                <thead>
                <tr>
                    <th>Endroit</th>
                    <th>Description</th>
                    <th>Date de départ</th>
                    <th>Date de fin</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td style="padding: 10px 5px 5px;"><input type="text" id="endroit_field" class="endroit_field" maxlength="50" placeholder="Endroit"></td>
                    <td style="padding: 10px 5px 5px;"><input type="text" id="description_field" maxlength="100" placeholder="Description"></td>
                    <td style="padding: 10px 5px 5px;">

                        <div class="input date required">
                            <select name="activite_date_depart[year]" required="required" id="startYear">
<?php for ($i = date('Y'); $i <= (date('Y') + 50); $i++):?>
                                    <option
                                            value=<?= $i?>
                                            <?= ($i == date('Y')) ? ' selected="selected"' : ''?>>
                                        <?= $i?>
                                    </option>
<?php endfor;?>
                            </select>

                            <select name="activite_date_depart[month]" required="required" id="startMonth">
<?php
                                $i = 0;
                                foreach (return_months() as $month):
?>
                                    <option
                                            value=<?= ++$i?>
                                            <?= ($i == date('m')) ? ' selected="selected"' : ''?>>
                                        <?= $month?>
                                    </option>
<?php
                                endforeach;
?>
                            </select>

                            <select name="activite_date_depart[day]" required="required" id="startDay">
<?php for ($i = 1; $i <= 31; $i++):?>
                                    <option
                                            value=<?= $i?>
                                            <?= ($i == date('d')) ? ' selected="selected"' : ''?>
                                    >
                                        <?= $i?>
                                    </option>
<?php endfor;?>
                            </select>
                        </div>
                    </td>

                    <td style="padding: 10px 5px 5px;">

                        <div class="input date required">
                            <select name="activite_date_retour[year]" required="required" id="endYear">
<?php for ($i = date('Y'); $i <= (date('Y') + 50); $i++):?>
                                    <option
                                            value=<?= $i?>
                                            <?= ($i == date('Y')) ? ' selected="selected"' : ''?>>
                                        <?= $i?>
                                    </option>
<?php endfor;?>
                            </select>

                            <select name="activite_date_retour[month]" required="required" id="endMonth">
<?php
                                $i = 0;
                                foreach (return_months() as $month):
?>
                                    <option
                                            value=<?= ++$i?>
                                            <?= ($i == date('m')) ? ' selected="selected"' : ''?>>
                                        <?= $month?>
                                    </option>
<?php
                                endforeach;
?>
                            </select>

                            <select name="activite_date_retour[day]" required="required" id="endDay">
<?php for ($i = 1; $i <= 31; $i++):?>
                                    <option
                                            value=<?= $i?>
                                            <?= ($i == date('d')) ? ' selected="selected"' : ''?>
                                    >
                                        <?= $i?>
                                    </option>
<?php endfor;?>
                            </select>
                        </div>
                    </td>

                    <td>
                        <button type="button" class="addRow"><i class="fa fa-plus"></i></button>
                    </td>
                </tr>
                </tbody>
            </table>

            <br>
            <fieldset>
                <legend>Renseignements supplémentaires</legend>
                <div class="accordion md-accordion accordion-1" id="accordionEx23" role="tablist">
<?php foreach ($categoriesProposition as $categorie):?>
                        <div class="card">
                            <div class="card-header blue lighten-3 z-depth-1" role="tab" id="heading<?php $ctr++;
                            echo $ctr?>">
                                <h5 class="text-uppercase mb-0 py-1">
                                    <a class="white-text font-weight-bold" data-toggle="collapse"
                                       href="#collapse<?php echo $ctr?>" aria-expanded="true"
                                       aria-controls="collapse<?php echo $ctr?>">
                                        <?= $categorie->getCategorie()?>
                                    </a>
                                </h5>
                            </div>
                            <div id="collapse<?php echo $ctr?>" class="collapse" role="tabpanel"
                                 aria-labelledby="heading<?php echo $ctr?>" data-parent="#accordionEx23">
                                <div class="card-body">

<?php foreach ($questionsProposition as $question):
                                        if(isset($_GET['param1'])){
                                            $propoquestion = $propositionReponseDB->getPropositionReponseFromPropositionIdAndQuestionId($_GET['param1'],$question->getIdQuestion());
                                            if(isset($propoquestion)){
                                                $reponse = $propoquestion->getReponse();
                                            }

                                        }?>

<?php if ($question->getCategorie()->getIdCategorie() === $categorie->getIdCategorie() && $question->getActif()):?>
                                        <div style="width:100%; margin:0 auto; border-top: #1a1a1a;">

                                            <span><?= $question->getQuestion() . "<br />" . "<br />"?></span>

                                            <!--Loop pour questions-->
                                            <span>
<?php if ($question->getAffichage() === 'Case'):?>
<?php if (!isset($vraiValeurs)) : $vraiValeurs = 'off'; endif;
                                                    $options = explode(";", $question->getInputOption());
                                                    if(isset($reponse)){
                                                        $caseacocher = explode(";",$reponse);
                                                    }

                                                    $idCase  = 0;?>

<?php foreach ($options as $option): $idCase++;?>

                                                        <input id="<?= $id?>" name="case<?= $question->getIdQuestion()?>" class="caseClass" data-id="<?= $question->getIdQuestion()?>"<?php if(isset($caseacocher)){if($caseacocher[$idCase-1] == 'true'){echo 'checked';}}?>  type="checkbox">
                                                                    <?= $option?>
                                                                </input>
<?php endforeach?>
                                                            <input value="false" name="<?= $question->getIdQuestion()?>"  type="hidden">



<?php elseif ($question->getAffichage() === 'Radio'):
                                                    $options = explode(";", $question->getInputOption());
                                                    if(isset($reponse)){
                                                        $caseacocher = explode(";",$reponse);
                                                    }

?>

<?php
                                                    $idCase  = 0;
                                                    foreach ($options as $option): $idCase++;
?>

                                                        <input name="radio<?= $question->getIdQuestion()?>" class="radioClass" data-id="<?= $question->getIdQuestion()?>"<?php if(isset($caseacocher)){if($caseacocher[$idCase-1] == 'true'){echo 'checked';}}?>  type="radio">
                                                                    <?= $option?>
                                                                </input>
<?php endforeach?>
                                                            <input value="false" name="<?= $question->getIdQuestion()?>"  type="hidden">

<?php elseif ($question->getAffichage() === 'Telechargement'):?>

<?php
                                                    echo download($question->getInputOption(), 'Télécharger : '. $question->getInputOption());
?>

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

                                                    <input type="number"
                                                           name="<?= $question->getIdQuestion()?>"
                                                           id="<?= $question->getIdQuestion()?>"
                                                           value="<?php if(isset($reponse))echo $reponse; else echo $min?>" min="<?= $min?>"
                                                           max="<?= $max?>" step="<?= $step?>">

<?php elseif ($question->getAffichage() === 'Date'):?>
<?php if (!isset($vraiValeurs)) : $vraiValeurs = '2019-01-01'; endif;?> <!-- Default Value-->

                                                    <input type="date"
                                                           name="<?= $question->getIdQuestion()?>"
                                                           id="<?= $question->getIdQuestion()?>"
                                                           value="<?php if(isset($reponse))echo $reponse; else echo ""?>">

<?php elseif ($question->getAffichage() === 'Liste'):
                                                    $options = explode(";", $question->getInputOption());?>
<?php if (!isset($vraiValeurs)) : $vraiValeurs = $options[0]; endif;?> <!-- Default Value-->

                                                    <select name=<?= $question->getIdQuestion()?>>
<?php foreach ($options as $option):?>
                                                                <option value=<?= $option?><?php if(isset($reponse)){if($reponse==$option) echo "selected";}?>>
                                                                    <?= $option?>
                                                                </option>
<?php endforeach?>
                                                        </select>

<?php elseif ($question->getAffichage() === 'Fichier'):?>

                                                    <input type="file"
                                                           name="<?= $question->getIdQuestion()?>">
<?php
                                                    if(!empty($question->getInputOption()))
                                                    {
                                                        echo download($question->getInputOption(), 'Télécharger : '.$question->getInputOption());
                                                    }
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

                                                    <input type="range" class="slider"
                                                           name="<?= $question->getIdQuestion()?>"
                                                           id="<?= $question->getIdQuestion()?>"
                                                           value="<?php if(isset($reponse))echo $reponse; else echo $min?>"
                                                           onchange="$('#rangeValue<?= $question->getIdQuestion()?>').text(this.value);"
                                                           min="<?= $min?>" max="<?= $max?>">
                                                    <span
                                                            id="rangeValue<?= $question->getIdQuestion()?>"><?php if(isset($reponse))echo $reponse; else echo $min?></span>
                                                    <br><br>

<?php elseif ($question->getAffichage() === 'ZoneTexte'):?>
                                                    <textarea id="<?= $question->getIdQuestion()?>" name="<?= $question->getIdQuestion()?>"><?php if(isset($reponse)){echo $reponse;} else{echo "";}?></textarea>

<?php endif;?>
                                            </span>

                                            <a
                                                    style="float: right"
                                                    href="javascript:void(0)"
                                                    title="Informations supplémentaires"
                                                    data-toggle="popover"
                                                    data-content="<?= $question->getInfoSup()?>"
                                            >
                                                <i class="fa fa-info" aria-hidden="true" style="font-size:28px;"></i>
                                            </a>
                                        </div>
                                        <br>
                                        <hr>
<?php endif;?>
<?php endforeach;?>
                                </div>
                            </div>
                        </div>

<?php endforeach;?>
                </div>
                <br>
                <?= nav('<button type="button">Retour aux propositions </button>', 'Propositions', 'index');?>
                <button type="submit" form="base_form45" name="btn_submit" id="test" value="ajouter" onclick="savedata()">Ajouter</button>

            </fieldset>
            <br>
        </form>
    </div>
<?= load_script('onLoadStorage/addProposition')?>