<?php
/**
 * @var App\Controller\VoyagesController $voyagesController
 * @var \App\Model\Entity\Voyage $voyage
 * @var string $compteType
 */

$id_voyage = $_GET['param1'];
$voyagesController->edit($id_voyage);

$voyage = get('voyage');

$destinations = get('destinations');

?>

<?php if ($compteType === 'admin' || $compteType === 'prof' && !$voyage->getApprouvee()): ?>

    <div class="voyages large-8 medium-10 small-12 large-centered medium-centered small-centered large-text-left medium-text-left small-text-left content">

        <form method="post">


            <fieldset>
                <div class="input required">
                    <legend>Modifier un voyage</legend>
                    <br>
                    <label for="nom_projet">Nom du projet</label>
                    <input type="text" name="nom_projet" pattern=".*\S.*" title="Le champ de peut pas être vide"
                           value="<?= $voyage->getNomProjet() ?>" maxlength="30" required>


                    <label for="id_destination">Destination</label>
                    <select name="id_destination" required="required">
                        <?php foreach ($destinations as $destination): ?>
                            <option value=<?= $destination->getIdDestination();
                            if ($voyage->getDestination()->getIdDestination() == $destination->getIdDestination()): {
                                echo ' selected="selected""';
                            } endif ?>
                            >
                                <?= $destination->getNomPays() ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="input text">
                    <label for="ville">Ville</label>
                    <input type="text" name="ville" pattern=".*\S.*" title="Le champ de peut pas être vide"
                           value="<?= $voyage->getVille() ?>" maxlength="50">
                </div>

                <div class="input text">
                    <label for="note">Note</label>
                    <textarea name="note" maxlength="500" rows="4"><?= $voyage->getNote() ?></textarea>
                </div>

                <div class="input text input required">
                    <label for="cout">Coût</label>
                    <input type="number" name="cout" min="0" max="99999999" maxlength="10" step="0.01"
                           value="<?= $voyage->getCout() ?>" required>
                </div>

                <div class="input date required">
                    <label for="date_limite">Date limite d'inscription</label>
                    <select name="date_limite[year]" required="required">
                        <?php for ($i = date('Y'); $i <= (date('Y') + 50); $i++): ?>
                            <option
                                    value=<?= $i ?>
                                <?= ($i == substr($voyage->getDateLimite(), 0, 4)) ? ' selected="selected"' : '' ?>>
                                <?= $i ?>
                            </option>
                        <?php endfor; ?>
                    </select>

                    <select name="date_limite[month]" required="required">
                        <?php
                        $i = 0;
                        foreach (return_months() as $month):
                            ?>
                            <option
                                    value=<?= ++$i ?>
                                <?= ($i == substr($voyage->getDateLimite(), 5, 7)) ? ' selected="selected"' : '' ?>>
                                <?= $month ?>
                            </option>
                        <?php
                        endforeach;
                        ?>
                    </select>

                    <select name="date_limite[day]" required="required">
                        <?php for ($i = 1; $i <= 31; $i++): ?>
                            <option
                                    value=<?= $i ?>
                                    <?= ($i == substr($voyage->getDateLimite(), 8, 10)) ? ' selected="selected"' : '' ?>
                            >
                                <?= $i ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="input date required">
                    <label for="date_depart">Date de départ</label>
                    <select name="date_depart[year]" required="required">
                        <?php for ($i = date('Y'); $i <= (date('Y') + 50); $i++): ?>
                            <option
                                    value=<?= $i ?>
                                <?= ($i == substr($voyage->getDateDepart(), 0, 4)) ? ' selected="selected"' : '' ?>>
                                <?= $i ?>
                            </option>
                        <?php endfor; ?>
                    </select>

                    <select name="date_depart[month]" required="required">
                        <?php
                        $i = 0;
                        foreach (return_months() as $month):
                            ?>
                            <option
                                    value=<?= ++$i ?>
                                <?= ($i == substr($voyage->getDateDepart(), 5, 7)) ? ' selected="selected"' : '' ?>>
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
                                    <?= ($i == substr($voyage->getDateDepart(), 8, 10)) ? ' selected="selected"' : '' ?>
                            >
                                <?= $i ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="input date required">
                    <label for="date_retour">Date de retour</label>
                    <select name="date_retour[year]" required="required">
                        <?php for ($i = date('Y'); $i <= (date('Y') + 50); $i++): ?>
                            <option
                                    value=<?= $i ?>
                                <?= ($i == substr($voyage->getDateRetour(), 0, 4)) ? ' selected="selected"' : '' ?>>
                                <?= $i ?>
                            </option>
                        <?php endfor; ?>
                    </select>

                    <select name="date_retour[month]" required="required">
                        <?php
                        $i = 0;
                        foreach (return_months() as $month):
                            ?>
                            <option
                                    value=<?= ++$i ?>
                                <?= ($i == substr($voyage->getDateRetour(), 5, 7)) ? ' selected="selected"' : '' ?>>
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
                                    <?= ($i == substr($voyage->getDateRetour(), 8, 10)) ? ' selected="selected"' : '' ?>
                            >
                                <?= $i ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>

                <?php if (isOfType([ADMIN])): ?>
                    <div class="input">
                        <label for="actif">Actif</label>
                        <input type="checkbox" name="actif" <?= ($voyage->getActif() ? 'checked' : '') ?>>
                    </div>
                <?php endif; ?>

                <button type="submit">Enregistrer</button>

                <!--Button de navigation -->
                <?php if (isOfType([PROF]))
                    echo nav('<button type="button">Liste des étudiants</button>', 'comptes', 'index')
                ?>
                <?= nav('<button type="button">Revenir à la liste des voyages</button>', 'Voyages', 'index'); ?>
            </fieldset>
        </form>
    </div>

<?php else: ?>

    <H1>Ce voyage a été approuvé et ne peut plus être modifié.</H1>

    <!--Button de navigation -->
    <?= nav('<button>Revenir à la liste des voyages</button>', 'Voyages', 'index'); ?>
<?php endif; ?>

</form>




