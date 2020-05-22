<?php
/**
 * @var App\Controller\VoyagesController $voyagesController
 */

$voyagesController->add();

$destinations = get('destinations');

?>

<div class="voyages large-8 medium-10 small-12 large-centered medium-centered small-centered large-text-left medium-text-left small-text-left content" >

    <form method="post">
        <fieldset>
            <legend>Ajouter un voyage</legend>

            <label id="nom_projet" for="nom_projet">Nom du projet</label>
            <input type="text" name="nom_projet" pattern=".*\S.*" maxlength="50" title="Le champ de peut pas être vide" required>

            <div class="input required">
                <label for="id_destination">Destination</label>
                <select name="id_destination" required="required">
                    <?php
                    foreach ($destinations as $destination):
                        ?>
                        <option value=<?= $destination->getIdDestination() ?>>
                            <?= $destination->getNomPays() ?></option>
                    <?php
                    endforeach
                    ?>
                </select>
            </div>

            <div class="input text">
                <label for="ville">Ville</label>
                <input type="text" name="ville" pattern=".*\S.*" maxlength="50"  title="Le champ de peut pas être vide" required>
            </div>

            <div class="input text">
                <label for="note">Note</label>
                <textarea name="note" maxlength="500" rows="4"></textarea>
            </div>


            <div class="input date required">
                <label for="date_depart">Date de départ</label>
                <select name="date_depart[year]" required="required">
                    <?php for ($i = date('Y'); $i <= (date('Y') +50); $i++): ?>
                        <option
                            value=<?= $i ?>
                            <?= ($i == date('Y')) ? ' selected="selected"' : '' ?>>
                            <?= $i ?>
                        </option>
                    <?php endfor; ?>
                </select>

                <select name="date_depart[month]" required="required">
                    <?php
                    $i = 0;
                    foreach ( return_months() as $month):
                        ?>
                        <option
                            value=<?= ++$i ?>
                            <?= ($i == date('m')) ? ' selected="selected"' : '' ?>>
                            <?= $month ?>
                        </option>
                    <?php
                    endforeach;
                    ?>
                </select>

                <select name="date_depart[day]" required="required">
                    <?php for ($i = 1; $i <= 31; $i++): ?>
                        <option
                            value=<?= $i ?>
                            <?= ($i == date('d')) ? ' selected="selected"' : '' ?>
                        >
                            <?= $i ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>

            <div class="input date required">
                <label for="date_retour">Date de retour</label>
                <select name="date_retour[year]" required="required">
                    <?php for ($i = date('Y'); $i <= (date('Y') +50); $i++): ?>
                        <option
                            value=<?= $i ?>
                            <?= ($i == date('Y')) ? ' selected="selected"' : '' ?>>
                            <?= $i ?>
                        </option>
                    <?php endfor; ?>
                </select>

                <select name="date_retour[month]" required="required">
                    <?php
                    $i = 0;
                    foreach ( return_months() as $month):
                        ?>
                        <option
                            value=<?= ++$i ?>
                            <?= ($i == date('m')) ? ' selected="selected"' : '' ?>>
                            <?= $month ?>
                        </option>
                    <?php
                    endforeach;
                    ?>
                </select>

                <select name="date_retour[day]" required="required">
                    <?php for ($i = 1; $i <= 31; $i++): ?>
                        <option
                            value=<?= $i ?>
                            <?= ($i == date('d')) ? ' selected="selected"' : '' ?>
                        >
                            <?= $i ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>



        <button type="submit">Ajouter</button>

    </form>
    <?= nav('<button type="button">Retour aux projets</button>', 'Voyages', 'index'); ?>
    </fieldset>
</div>



