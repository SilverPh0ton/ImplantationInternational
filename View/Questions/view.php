<?php
/**
 * @var \App\Controller\QuestionsController $questionsController
 * @var \App\Model\Entity\Question $question
 */

$id_question = $_GET['param1'];
$questionsController->view($id_question);

$question = get('question');

?>

<?= load_css('ControlOption') ?>

<div class="columns large-8 medium-10 small-12 large-centered medium-centered small-centered large-text-left medium-text-left small-text-left content">

    <h3>Question: <?= $question->getQuestion() ?></h3>

    <table class="vertical-table">
        <tr>
            <th scope="row">Catégorie</th>
            <td><?= $question->getCategorie()->getCategorie() ?></td>
        </tr>
        <tr>
            <th scope="row">Informations supplémentaires</th>
            <td><?= $question->getInfoSup() ?></td>
        </tr>
        <tr>
            <th scope="row">Affichage</th>
            <td>
                <div class="ControlOption">
                    <label for="affichage">
                        <?php if ($question->getAffichage() === 'Mention'): ?>
                            Mention (aucune réponse requise)

                        <?php elseif ($question->getAffichage() === 'Telechargement'): ?>
                            Téléchargement (aucune réponse requise) <br>

                            <?php echo download('empty.txt' ,'Télécharger');  ?>
                        <?php elseif ($question->getAffichage() === 'Case'): ?>
                            Case à cocher
                            <input type="checkbox">

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
                            Chiffre
                            <input type="number" min="<?= $min ?>" max="<?= $max ?>" step="<?= $step ?>">

                        <?php elseif ($question->getAffichage() === 'Date'): ?>
                            Date
                            <input type="date">

                        <?php elseif ($question->getAffichage() === 'Liste'):
                            $options = explode(";", $question->getInputOption()); ?>
                            Liste
                            <select>
                                <?php foreach ($options as $option): ?>
                                    <option value=<?= $option ?>> <?= $option ?></option>
                                <?php endforeach ?>
                            </select>

                        <?php elseif ($question->getAffichage() === 'Fichier'): ?>
                            Fichier
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
        </tr>
        <tr>
        <th scope="row"><?= 'Regroupement' ?></th>
                <?php if($question->getRegroupement() == 0): ?>
                <td>Étudiant</td>
                <?php elseif($question->getRegroupement()==1):?>
                <td>Accompagnateur</td>
                <?php elseif($question->getRegroupement()==2):?>
                <td>Accompagnateur et étudiant</td>
                <?php elseif($question->getRegroupement()==9):?>
                <td>Proposition</td>
                <?php endif;?>
            </td>
        </tr>
        <tr>
            <th scope="row"><?= 'Actif' ?></th>
            <td><?= $question->getActif() ? 'Oui' : 'Non'; ?></td>
        </tr>
    </table>

    <!--Button de navigation -->
    <?= nav('<button>Retour à la banque de questions </button>','questions','index'); ?>
    <?= nav1('<button>Modifier cette question </button>','questions','edit', $question->getIdQuestion()) ?>
</div>
