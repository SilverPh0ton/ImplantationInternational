<?php
/**
 * @var \App\Controller\NoauthController $noAuthController
 * @var \App\Model\Entity\Programme[] $programmes
 */

$noAuthController->createAccount();
$programmes = get('programmes');

?>

<div class="comptes form large-8 medium-10 small-12 large-centered medium-centered small-centered large-text-left medium-text-left small-text-left content">

    <form method="post">
        <fieldset>
            <legend>Créer un compte</legend>

            <div class="input text required">
                <label for="pseudo">Nom d'utilisateur</label>
                <input type="text" required name="pseudo" id="pseudo" pattern=".*\S.*"  maxlength="30" title="Le champ de peut pas être vide">
            </div>

            <div class="input password required">
                <label for="mot_de_passe">Mot de passe</label>
                <input type="password" required name="mot_de_passe" id="mot_de_passe" pattern=".*\S.*" minlength="8" maxlength="30"
                       title="Le champ de peut pas être vide">
            </div>

            <div class="input password required">
                <label for="mot_de_passe_confirme">Confirmer le mot de passe</label>
                <input type="password" required name="mot_de_passe_confirme" id="mot_de_passe_confirme" pattern=".*\S.*" minlength="8" maxlength="30"
                       title="Le champ de peut pas être vide">
            </div>

            <div class="input text required">
                <label for="courriel">Courriel</label>
                <input type="text" required name="courriel" id="courriel" pattern=".+[/@].+[/.].+" maxlength="50"
                       title="Ceci n'est pas un courriel valide">
            </div>

            <div class="input text required">
                <label for="nom">Nom</label>
                <input type="text" required name="nom" id="nom" pattern=".*\S.*" maxlength="30" title="Le champ de peut pas être vide">
            </div>

            <div class="input text required">
                <label for="prenom">Prénom</label>
                <input type="text" required name="prenom" id="prenom" pattern=".*\S.*" maxlength="30" title="Le champ de peut pas être vide">
            </div>

            <div class="input date required">
                <label>Date de naissance</label>
                <select name="date_naissance[year]" required="required">
     <?php for ($i = (date('Y')-1); $i >= (date('Y') -100); $i--): ?>
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
                </select>
            </div>

            <div class="input tel required">
                <label for="telephone">Téléphone (999-999-9999 0000:poste facultatif)</label>
                <input required type="tel" name="telephone" id="telephone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}([ ]{1}[0-9]*)?" maxlength="20"
                       title="(999-999-9999 0000:poste facultatif)">
            </div>

            <div class="input required">
                <label for="id_programme">Programme</label>
                <select name="id_programme" required="required">
     <?php
                    foreach ($programmes as $programme):
                        $programme = unserialize($programme);
          ?>
                        <option value=<?= $programme->getIdProgramme(); ?> >
                            <?= $programme->getNomProgramme() ?>
                        </option>
     <?php
                    endforeach
      ?>
                </select>
            </div>

            <div class="input number required">
                <label for="code_activation">Code d'activation</label>
                <input id="code_activation" required type="text" name="code_activation" pattern="[A-Z0-9]{5}-){4}[A-Z0-9]{5}" title="Le champ ne peut pas être vide" maxlength="14">
            </div>
            <button type="submit">Créer le compte</button>
            <!--Button de navigation -->
            <?= nav('<button type="button"> Retour à la connexion </button>', 'Comptes', 'login'); ?>
        </fieldset>

    </form>


</div>
