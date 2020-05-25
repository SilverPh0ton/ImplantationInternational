<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Compte $compte
 * @var \App\Model\Entity\Programme[] $programmes
 * @var App\Controller\ComptesController $compteController ;
 */
//$session = $this->request->getSession();
//$user_data = $session->read('Auth.User');


$id_compte = $_GET['param1'];

$comptesController->edit($id_compte);

$compte = get('compte');
$programmes = get('array_prog');
?>

<div class="comptes form columns large-8 medium-10 small-12 large-centered medium-centered small-centered large-text-left medium-text-left small-text-left content">

    <form method="post">
        <fieldset>
            <legend>Modification de compte</legend>

            <div class="input required">
                <label for="pseudo">Nom d'utilisateur</label>
                <input name="pseudo" id="pseudo" pattern=".*\S.*" maxlength="30"
                       title="Le champ de peut pas être vide" type="text"
                       value="<?= $compte->getPseudo() ?>" required>
            </div>

            <div class="input required">
                <label for="courriel">Courriel</label>
                <input name="courriel" id="courriel" type="email" pattern=".+[/@].+[/.].+" maxlength="50"
                       title="Ceci n\'est pas un courriel valide" value="<?= $compte->getCourriel() ?>" required>
            </div>

            <div class="input required">
                <label for="nom">Nom</label>
                <input name="nom" id="nom" pattern=".*\S.*" maxlength="30" title="Le champ de peut pas être vide"
                       type="text"
                       value="<?= $compte->getNom() ?>" required>
            </div>

            <div class="input required">
                <label for="prenom">Prénom</label>
                <input name="prenom" id="prenom" pattern=".*\S.*" maxlength="30"
                       title="Le champ de peut pas être vide" type="text"
                       value="<?= $compte->getPrenom() ?>" required>
            </div>

            <div class="input date required">

                <label>Date de naissance</label>
                <select name="date_naissance[year]" required="required">
                    <?php for ($i = date('Y'); $i >= (date('Y') - 100); $i--): ?>
                        <option
                                value=<?= $i ?>
                            <?= ($i == substr($compte->getDateNaissance(), 0, 4)) ? ' selected="selected"' : '' ?>>
                            <?= $i ?>
                        </option>
                    <?php endfor; ?>
                </select>

                <select name="date_naissance[month]" required="required">
                    <?php
                    $i = 0;
                    foreach (return_months() as $month):
                        ?>
                        <option
                                value=<?= ++$i ?>
                            <?= ($i == substr($compte->getDateNaissance(), 5, 7)) ? ' selected="selected"' : '' ?>>
                            <?= $month ?>
                        </option>
                    <?php
                    endforeach;
                    ?>
                </select>


                <select name="date_naissance[day]" required="required">
                    <?php for ($i = 1; $i <= 31; $i++): ?>
                        <option
                                value="<?= $i ?>"
                            <?= ($i == substr($compte->getDateNaissance(), 8, 9)) ? ' selected="selected"' : '' ?>>
                            <?= $i ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>

            <div class="input">
                <label for="telephone">Téléphone (999-999-9999 0000:poste facultatif)</label>
                <input name="telephone" id="telephone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}([ ]{1}[0-9]*)?"
                       maxlength="20"
                       title="(999-999-9999 0000:poste facultatif)" type="tel"
                       value="<?= $compte->getTelephone() ? $compte->getTelephone() : ''; ?>">
            </div>

            <div class="input required">
                <label for="id_programme">Programme</label>
                <select name="id_programme" required="required" id="id_programme">
                    <?php
                    foreach ($programmes as $programme):
                        $programme = unserialize($programme)
                        ?>
                        <option value="<?= $programme->getNomProgramme(); ?>" <?= ($compte->getProgramme()->getNomProgramme() === $programme->getNomProgramme()) ? ' selected="selected"' : ''; ?>>
                            <?= $programme->getNomProgramme() ?>
                        </option>
                    <?php
                    endforeach
                    ?>
                </select>
            </div>

            <?php if (isOfType([ADMIN,PROF])): ?>
                <div class="input">
                <label for="anonyme">Voulez-vous que les autres accompagnateurs voient votre profil?</label>

                <input type="radio" name="anonyme" value="1" <?= ($compte->getAnonyme() ? 'checked' : '') ?>> Oui
                <input type="radio" name="anonyme" value="0" <?= (!$compte->getAnonyme() ? 'checked' : '')?>> Non
            </div>
            <?php
             else: ?>
          <input type="radio" name="anonyme" value="1" hidden>
             <?php endif; ?>
            <?php if (isOfType([ADMIN])): ?>
                <div class="input">
                    <label for="type">Type de compte</label>
                    <select name="type" id="type">
                        <option value="etudiant" <?= ($compte->getType() === ETUDIANT) ? ' selected="selected"' : ''; ?>>
                            Étudiants
                        </option>
                        <option value="prof" <?= ($compte->getType() === PROF) ? ' selected="selected"' : ''; ?>>
                            Accompagnateur
                        </option>
                        <option value="admin" <?= ($compte->getType() === ADMIN) ? ' selected="selected"' : ''; ?>>
                            Administrateur
                        </option>
                    </select>
                </div>
                <input type="hidden" name="type" value="<?= $compte->getType() ?>">
                <button type="button" data-toggle="modal" data-target="#myModal_promote"> Promouvoir en accompagnateur
                </button>
            <?php elseif (isOfType([PROF,ETUDIANT])): ?>
                <input type="hidden" name="type" value="<?= $compte->getType() ?>">
            <?php endif; ?>

            <?php if (isOfType([ADMIN])): ?>
                <div class="input">
                    <label for="actif">Actif</label>
                    <input type="checkbox" id="actif" name="actif" <?= ($compte->getActif() ? 'checked' : '') ?>>
                </div>
            <?php elseif (isOfType([PROF,ETUDIANT])): ?>
                <input hidden type="checkbox" id="actif" name="actif" <?= ($compte->getActif() ? 'checked' : '') ?>>
            <?php endif; ?>

            <div>
                <button type="submit" onclick="savedata()">Enregistrer</button>
                <!--Button de navigation -->
                <?php
                if (isOfType([ADMIN, PROF])) {
                    echo nav('<button type="button"> Retour à la liste des comptes </button>', 'Comptes', 'index');
                } else {
                    echo nav1('<button type="button">Revenir à mon comptes</button>', 'Comptes', 'view', $id_compte);
                }
                ?>
            </div>

        </fieldset>

    </form>

    <div class="modal" id="<?= 'myModal_promote' ?>">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Confirmation</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" >
                    <!-- Modal body -->
                    <div class="modal-body">

                        Êtes-vous certain de vouloir promouvoir cet étudiant ? Une fois fait, il faudra demander
                        à un administrateur pour le ramener au status d’étudiant.

                        <input type="text" value="true" name="promote" hidden>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" value="bt_confirm">
                            Confirmer
                        </button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <?php
    if (isset($_SESSION["connectedUser"])) {
        $connectedUser = $_SESSION["connectedUser"];
        $compteType = $connectedUser->getType();
        if ($compteType == 'admin' || $compteType == 'prof') {
            nav('<button> Retour à la liste des participants </button>', 'Comptes', 'index');
        }

    }
    ?>


</div>

<div class="comptes form columns large-8 medium-10 small-12 large-centered medium-centered small-centered large-text-left medium-text-left small-text-left content">

    <form method="post">
        <fieldset>
            <legend>Modification de mot de passe</legend>
            <div class="input text required">
                <label for="mot_de_passe">Mot de passe</label>
                <input name="mot_de_passe" id="mot_de_passe" value="" type="password" minlength="9" maxlength="30"
                       required>
                <label for="mot_de_passe_confirme">Confirmer votre mot de passe</label>
                <input name="mot_de_passe_confirme" id="mot_de_passe_confirme" value="" type="password" minlength="9"
                       maxlength="30" required>
            </div>
            <button type="submit">Enregistrer le mot de passe</button>
        </fieldset>

    </form>
</div>

<?= load_script('onLoadStorage/editCompte') ?>
