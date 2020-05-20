<?php
/**
 * @var \App\Controller\QuestionsController $questionsController
 * @var \App\Model\Entity\Question[] $questionsPourEleve
 * @var \App\Model\Entity\Question[] $questionsPourProf
 * @var \App\Model\Entity\Question[] $questionsPourProfEleve
 * @var \App\Model\Entity\Question[] $questionsPourProposition
 */

$questionsController->index();

$questionsPourEleve = get('questionsPourEleve');
$questionsPourProf = get('questionsPourProf');
$questionsPourProfEleve = get('questionsPourProfEleve');
$questionsPourProposition = get('questionsPourProposition');
?>

<?= load_css('ControlOption') ?>
<?= load_css('tab')?>

<div class="questions index columns large-12 medium-12 small-12 large-text-left medium-text-left small-text-left content">

    <h3>Banque de questions</h3>

    <?= nav('<button class="add-btn">Ajouter une question</button>','questions','add'); ?>

    <div class="tab">
        <button id="eleve" class="tablinks active" onclick="openTab(event, 'eleveTab')">Pour étudiant</button>
        <button id="prof" class="tablinks" onclick="openTab(event, 'profTab')">Pour accompagnateur</button>
        <button id="eleve_prof" class="tablinks" onclick="openTab(event, 'eleve_profTab')">Pour accompagnateur et étudiant</button>
        <button id="proposition" class="tablinks" onclick="openTab(event, 'propositionTab')">Pour les propositions de voyage</button>
    </div>
    <div class="tab tabContainer">

    <div id="eleveTab" class="tabcontent" style="display: block">
        <table class="table_to_paginate">
            <thead>
            <tr>
                <th scope="col" class='optionalField' style="width: 10%">Categorie</th>
                <th scope="col" style="width: 25%">Question</th>
                <th scope="col" style="width: 25%">Affichage</th>
                <th scope="col" class='optionalField' style="width: 5%">Actif</th>
                <th scope="col" class='optionalField' style="width: 25%">Informations supplémentaires</th>
                <th scope="col" class="actions" style="width: 10%"></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($questionsPourEleve as $question):
                $color = $question->getActif() ? '' : 'style="color: #aaaaaa"'
                ?>
                <tr>
                    <td <?php echo $color ?> class='optionalField'><?= $question->getCategorie()->getCategorie() ?></td>
                    <td <?php echo $color ?> ><?= $question->getQuestion() ?></td>
                    <td <?php echo $color ?> >
                        <div class="ControlOption">
                            <label for="affichage">
                                <?php if ($question->getAffichage() === 'Mention'): ?>
                                    Mention (aucune réponse requise)

                                <?php elseif ($question->getAffichage() === 'Case'): ?>
                                    Choix multiple
                                    <input type="checkbox">

                                <?php elseif ($question->getAffichage() === 'Telechargement'): ?>
                                    Document à télécharger (aucune réponse requise) <br>
                                    <?php ;
                                    echo download($question->getInputOption(),'Télécharger: ' . $question->getInputOption());
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

                                    Nombre
                                    <input type="number" min="<?= $min ?>" max="<?= $max ?>" step="<?= $step ?>">

                                <?php elseif ($question->getAffichage() === 'Date'): ?>
                                    Date
                                    <input type="date">

                                <?php elseif ($question->getAffichage() === 'Liste'):
                                    $options = explode(";", $question->getInputOption()); ?>
                                    Liste déroulante
                                    <select style="width: 93%">
                                        <?php foreach ($options as $option): ?>
                                            <option value=<?= $option ?>> <?= $option ?></option>
                                        <?php endforeach ?>
                                    </select>

                                <?php elseif ($question->getAffichage() === 'Fichier'): ?>
                                    Déposer un document numérique
                                    <input type="file">

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
                                    Curseur de défilement
                                    <input type="range" class="slider"
                                           onchange="$('#rangeValue<?= $question->getIdQuestion() ?>').text(this.value);"
                                           min="<?= $min ?>" max="<?= $max ?>" step="<?= $step ?>">
                                    <span id="rangeValue<?= $question->getIdQuestion() ?>"><?= ($min + $max) / 2 ?></span>

                                <?php elseif ($question->getAffichage() === 'ZoneTexte'): ?>
                                    Zone de texte
                                    <textarea></textarea>

                                <?php endif; ?>
                            </label>
                        </div>
                    </td>
                    <td <?php echo $color ?> class='optionalField'><?= $question->getActif() ? 'Oui' : 'Non'; ?></td>
                    <td <?php echo $color ?> class='optionalField'><?= $question->getInfoSup() ?></td>
                    <td class="actions">
                        <?= nav1(
                            '<img alt="afficher ico" src="Ressource/img/eye.png" class="images" data-toggle="tooltip" data-placement = "top" title = "Afficher">',
                            'Questions',
                            'view',
                            $question->getIdQuestion()
                        );
                        ?>
                        <?= nav1(
                            '<img alt="modifier icon" src="Ressource/img/writing.png" class="images" data-toggle="tooltip" data-placement = "top" title = "Modifier">',
                            'Questions',
                            'edit',
                            $question->getIdQuestion());
                        ?>

                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div id="profTab" class="tabcontent">
        <table class="table_to_paginate">
            <thead>
            <tr>
                <th scope="col" class='optionalField' style="width: 10%">Categorie</th>
                <th scope="col" style="width: 25%">Question</th>
                <th scope="col" style="width: 25%">Affichage</th>
                <th scope="col" class='optionalField' style="width: 25%">Information supplémentaire</th>
                <th scope="col" class='optionalField' style="width: 5%">Actif</th>
                <th scope="col" class="actions" style="width: 10%"></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($questionsPourProf as $question):
                $color = $question->getActif() ? '' : 'style="color: #aaaaaa"'
                ?>
                <tr>
                    <td <?php echo $color ?> class='optionalField'><?= $question->getCategorie()->getCategorie() ?></td>
                    <td <?php echo $color ?> ><?= $question->getQuestion() ?></td>
                    <td <?php echo $color ?> >
                        <div class="ControlOption">
                            <label for="affichage">
                                <?php if ($question->getAffichage() === 'Mention'): ?>
                                    Mention (aucune réponse requise)

                                <?php elseif ($question->getAffichage() === 'Case'): ?>
                                    Choix multiple
                                    <input type="checkbox">

                                <?php elseif ($question->getAffichage() === 'Telechargement'): ?>
                                    Document à télécharger (aucune réponse requise) <br>
                                    <?php
                                    echo download($question->getInputOption(),'Télécharger: ' . $question->getInputOption());
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

                                    Nombre
                                    <input type="number" min="<?= $min ?>" max="<?= $max ?>" step="<?= $step ?>">

                                <?php elseif ($question->getAffichage() === 'Date'): ?>
                                    Date
                                    <input type="date">

                                <?php elseif ($question->getAffichage() === 'Liste'):
                                    $options = explode(";", $question->getInputOption()); ?>
                                    Liste déroulante
                                    <select style="width: 93%">
                                        <?php foreach ($options as $option): ?>
                                            <option value=<?= $option ?>> <?= $option ?></option>
                                        <?php endforeach ?>
                                    </select>

                                <?php elseif ($question->getAffichage() === 'Fichier'): ?>
                                    Déposer un document numérique
                                    <input type="file">

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
                                    Curseur de défilement
                                    <input type="range" class="slider"
                                           onchange="$('#rangeValue<?= $question->getIdQuestion() ?>').text(this.value);"
                                           min="<?= $min ?>" max="<?= $max ?>" step="<?= $step ?>">
                                    <span id="rangeValue<?= $question->getIdQuestion() ?>"><?= ($min + $max) / 2 ?></span>

                                <?php elseif ($question->getAffichage() === 'ZoneTexte'): ?>
                                    Zone de texte
                                    <textarea></textarea>

                                <?php elseif ($question->getAffichage() === 'Couleur'): ?>
                                    Couleur
                                    <input type="color">

                                <?php endif; ?>
                            </label>
                        </div>
                    </td>
                    <td <?php echo $color ?> class='optionalField'><?= $question->getInfoSup() ?></td>
                    <td <?php echo $color ?> class='optionalField'><?= $question->getActif() ? 'Oui' : 'Non'; ?></td>
                    <td class="actions">
                        <?= nav1(
                            '<img alt="afficher ico" src="Ressource/img/eye.png" class="images" data-toggle="tooltip" data-placement = "top" title = "Afficher">',
                            'Questions',
                            'view',
                            $question->getIdQuestion()
                        );
                        ?>
                        <?= nav1(
                            '<img alt="modifier icon" src="Ressource/img/writing.png" class="images" data-toggle="tooltip" data-placement = "top" title = "Modifier">',
                            'Questions',
                            'edit',
                            $question->getIdQuestion());
                        ?>

                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div id="eleve_profTab" class="tabcontent">
        <table class="table_to_paginate">
            <thead>
            <tr>
                <th scope="col" class='optionalField' style="width: 10%">Categorie</th>
                <th scope="col" style="width: 25%">Question</th>
                <th scope="col" style="width: 25%">Affichage</th>
                <th scope="col" class='optionalField' style="width: 25%">Information supplémentaire</th>
                <th scope="col" class='optionalField' style="width: 5%">Actif</th>
                <th scope="col" class="actions" style="width: 10%"></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($questionsPourProfEleve as $question):
                $color = $question->getActif() ? '' : 'style="color: #aaaaaa"'
                ?>
                <tr>
                    <td <?php echo $color ?> class='optionalField'><?= $question->getCategorie()->getCategorie() ?></td>
                    <td <?php echo $color ?> ><?= $question->getQuestion() ?></td>
                    <td <?php echo $color ?> >
                        <div class="ControlOption">
                            <label for="affichage">
                                <?php if ($question->getAffichage() === 'Mention'): ?>
                                    Mention (aucune réponse requise)

                                <?php elseif ($question->getAffichage() === 'Case'): ?>
                                    Choix multiple
                                    <input type="checkbox">

                                <?php elseif ($question->getAffichage() === 'Telechargement'): ?>
                                    Document à télécharger (aucune réponse requise) <br>
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

                                    Nombre
                                    <input type="number" min="<?= $min ?>" max="<?= $max ?>" step="<?= $step ?>">

                                <?php elseif ($question->getAffichage() === 'Date'): ?>
                                    Date
                                    <input type="date">

                                <?php elseif ($question->getAffichage() === 'Liste'):
                                    $options = explode(";", $question->getInputOption()); ?>
                                    Liste déroulante
                                    <select style="width: 93%">
                                        <?php foreach ($options as $option): ?>
                                            <option value=<?= $option ?>> <?= $option ?></option>
                                        <?php endforeach ?>
                                    </select>

                                <?php elseif ($question->getAffichage() === 'Fichier'): ?>
                                    Déposer un document numérique
                                    <input type="file">

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
                                    Curseur de défilement
                                    <input type="range" class="slider"
                                           onchange="$('#rangeValue<?= $question->getIdQuestion() ?>').text(this.value);"
                                           min="<?= $min ?>" max="<?= $max ?>" step="<?= $step ?>">
                                    <span id="rangeValue<?= $question->getIdQuestion() ?>"><?= ($min + $max) / 2 ?></span>

                                <?php elseif ($question->getAffichage() === 'ZoneTexte'): ?>
                                    Zone de texte
                                    <textarea></textarea>

                                <?php elseif ($question->getAffichage() === 'Couleur'): ?>
                                    Couleur
                                    <input type="color">

                                <?php endif; ?>
                            </label>
                        </div>
                    </td>
                    <td <?php echo $color ?> class='optionalField'><?= $question->getInfoSup() ?></td>
                    <td <?php echo $color ?> class='optionalField'><?= $question->getActif() ? 'Oui' : 'Non'; ?></td>
                    <td class="actions">
                        <?= nav1(
                            '<img alt="afficher ico" src="Ressource/img/eye.png" class="images" data-toggle="tooltip" data-placement = "top" title = "Afficher">',
                            'Questions',
                            'view',
                            $question->getIdQuestion()
                        );
                        ?>
                        <?= nav1(
                            '<img alt="modifier icon" src="Ressource/img/writing.png" class="images" data-toggle="tooltip" data-placement = "top" title = "Modifier">',
                            'Questions',
                            'edit',
                            $question->getIdQuestion());
                        ?>

                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div id="propositionTab" class="tabcontent">
        <table class="table_to_paginate">
            <thead>
            <tr>
                <th scope="col" class='optionalField' style="width: 10%">Categorie</th>
                <th scope="col" style="width: 25%">Question</th>
                <th scope="col" style="width: 25%">Affichage</th>
                <th scope="col" class='optionalField' style="width: 25%">Information supplémentaire</th>
                <th scope="col" class='optionalField' style="width: 5%">Actif</th>
                <th scope="col" class="actions" style="width: 10%"></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($questionsPourProposition as $question):
                $color = $question->getActif() ? '' : 'style="color: #aaaaaa"'
                ?>
                <tr>
                    <td <?php echo $color ?> class='optionalField'><?= $question->getCategorie()->getCategorie() ?></td>
                    <td <?php echo $color ?> ><?= $question->getQuestion() ?></td>
                    <td <?php echo $color ?> >
                        <div class="ControlOption">
                            <label for="affichage">
                                <?php if ($question->getAffichage() === 'Mention'): ?>
                                    Mention (aucune réponse requise)

                                <?php elseif ($question->getAffichage() === 'Case'): ?>
                                    Choix multiple
                                    <input type="checkbox">

                                <?php elseif ($question->getAffichage() === 'Telechargement'): ?>
                                    Document à télécharger (aucune réponse requise) <br>
                                    <?php
                                    echo download($question->getInputOption(), 'Télécharger: ' . $question->getInputOption());
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

                                    Nombre
                                    <input type="number" min="<?= $min ?>" max="<?= $max ?>" step="<?= $step ?>">

                                <?php elseif ($question->getAffichage() === 'Date'): ?>
                                    Date
                                    <input type="date">

                                <?php elseif ($question->getAffichage() === 'Liste'):
                                    $options = explode(";", $question->getInputOption()); ?>
                                    Liste déroulante
                                    <select style="width: 93%">
                                        <?php foreach ($options as $option): ?>
                                            <option value=<?= $option ?>> <?= $option ?></option>
                                        <?php endforeach ?>
                                    </select>

                                <?php elseif ($question->getAffichage() === 'Fichier'): ?>
                                    Déposer un document numérique
                                    <input type="file">

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
                                    Curseur de défilement
                                    <input type="range" class="slider"
                                           onchange="$('#rangeValue<?= $question->getIdQuestion() ?>').text(this.value);"
                                           min="<?= $min ?>" max="<?= $max ?>" step="<?= $step ?>">
                                    <span id="rangeValue<?= $question->getIdQuestion() ?>"><?= ($min + $max) / 2 ?></span>

                                <?php elseif ($question->getAffichage() === 'ZoneTexte'): ?>
                                    Zone de texte
                                    <textarea></textarea>

                                <?php elseif ($question->getAffichage() === 'Couleur'): ?>
                                    Couleur
                                    <input type="color">

                                <?php endif; ?>
                            </label>
                        </div>
                    </td>
                    <td <?php echo $color ?> class='optionalField'><?= $question->getInfoSup() ?></td>
                    <td <?php echo $color ?> class='optionalField'><?= $question->getActif() ? 'Oui' : 'Non'; ?></td>
                    <td class="actions">
                        <?= nav1(
                            '<img alt="afficher ico" src="Ressource/img/eye.png" class="images" data-toggle="tooltip" data-placement = "top" title = "Afficher">',
                            'Questions',
                            'view',
                            $question->getIdQuestion()
                        );
                        ?>
                        <?= nav1(
                            '<img alt="modifier icon" src="Ressource/img/writing.png" class="images" data-toggle="tooltip" data-placement = "top" title = "Modifier">',
                            'Questions',
                            'edit',
                            $question->getIdQuestion());
                        ?>

                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    </div>

</div>

<script>
    var order = [[ 4, 'desc' ],[ 0, 'asc' ]];
    let scrollY_val = '45vh';
</script>
<?= load_script('paginator') ?>
<?= load_script('tab') ?>
<script>
    $(document).ready( function () {
        openTab(null, 'eleveTab');
    } );
    document.getElementById('eleve').className += " active"
</script>



