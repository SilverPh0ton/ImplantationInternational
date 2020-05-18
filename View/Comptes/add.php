<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Compte $compte
 * @var \App\Model\Entity\Programme[] $programmes
 * @var App\Controller\ComptesController $compteController;
 */

$comptesController->add();

$programmes = get('array_prog');



?>

<div class="comptes form columns large-8 medium-10 small-12 large-centered medium-centered small-centered large-text-left medium-text-left small-text-left content">

    <form method="post">

        <fieldset>
            <legend>Créer un compte</legend>

            <div class="input text required"><label for="pseudo">Nom d'utilisateur</label>
                <input name="pseudo" id="pseudo" title="Le champ de peut pas être vide" pattern=".*\S.*" type="text" maxlength="30" required>

                <label for="mot_de_passe">Mot de passe</label>
                <input name="mot_de_passe" type="password" pattern=".*\S.*" title="Le champ de peut pas être vide"
                       id="mot_de_passe" minlength="8" maxlength="30" required>
                <label for="mot_de_passe_confirme">Confirmer le mot de passe</label>
                <input name="mot_de_passe_confirme" id="mot_de_passe_confirme" type="password" required pattern=".*\S.*" minlength="8" maxlength="30"
                       title="Le champ de peut pas être vide">

                <label for="select_type_acc">Type de compte</label>
                <select id="select_type_acc" name="select_type_acc">
                    <option value="etudiant">Étudiant</option>
                    <option value="prof">Accompagnateur</option>
                    <option value="admin">Administrateur</option>
                </select>

                <div class="input checkbox"><input type="hidden" name="actif" value="0"><label for="actif"><input
                                type="checkbox" name="actif" value="1" id="actif" checked="checked">Actif</label></div>

                <label for="courriel">Courriel</label>
                <input name="courriel" type="email" id="courriel" pattern=".+[/@].+[/.].+"
                       title="Ceci n'est pas un courriel valide" maxlength="50" required>

                <label for="nom">Nom</label>
                <input name="nom" id="nom" pattern=".*\S.*" title="Le champ de peut pas être vide" type="text" maxlength="30" required>
                <label for="prenom">Prénom</label>
                <input name="prenom" id="prenom" pattern=".*\S.*" title="Le champ de peut pas être vide" type="text" maxlength="30" required>

                <div class="input date required">
                    <label>Date de naissance</label>
                    <select name="date_naissance[year]" required="required">
                        <?php for ($i = date('Y')-1; $i >= (date('Y') -100); $i--): ?>
                            <option
                                    value=<?= $i ?>
                                <?= ($i == date('Y')) ? ' selected="selected"' : '' ?>>
                                <?= $i ?>
                            </option>
                        <?php endfor; ?>
                    </select>

                    <select name="date_naissance[month]" required="required">
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

                    <select name="date_naissance[day]" required="required">
                        <?php for ($i = 1; $i <= 31; $i++): ?>
                            <option
                                    value=<?= $i ?>
                                    <?= ($i == date('d')) ? ' selected="selected"' : '' ?>
                            >
                                <?= $i ?>
                            </option>
                        <?php endfor; ?>
                    </select></div>

            </div>
                <label for="telephone">Téléphone (999-999-9999 0000:poste facultatif)</label>
                <input name="telephone" id="telephone" title="(999-999-9999 0000:poste facultatif)" type="tel"
                       pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}([ ]{1}[0-9]*)?" maxlength="20">


                <div class="input required">
                    <label for="id_programme">Programme</label>
                    <select name="id_programme" required="required" id="id_programme">
                        <?php
                        foreach ($programmes as $programme):
                            $programme=unserialize($programme)
                            ?>
                            <option value=<?= $programme->getIdProgramme(); ?> >

                                <?= $programme->getNomProgramme() ?>
                            </option>
                        <?php
                        endforeach
                        ?>
                    </select>
                </div>

        </fieldset>
        <button type="submit">Créer</button>
    </form>

    <?php echo nav('<button>Revenir à la liste des utilisateurs</button>', 'Comptes', 'index'); ?>

</div>
