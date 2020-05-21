
<?php
/**
 * @var \App\Controller\ComptesController $comptesController

$comptesController->login();*/


$pseudo_err = $courriel_err = "";
$noAuthController->passwordRecover();


?>
<img src="Ressource/img/Logo-Cegep-bleu.png" alt="logo" id="image">


<div class="contain">

    <h1>Mot de passe oublié</h1>
    <h6 style="color: white">Un courriel contenant votre nouveau mot de passe vous sera envoyé.</h6>

    <form method="post" action="">
        <div class="input text">
            <label for="pseudo">Nom d'utilisateur</label>
            <input type="text" name="pseudo" id="pseudo" required>
            <?= $pseudo_err ?>
        </div>
        <div class="input text">
            <label for="courriel">Courriel</label>0
            <input type="email" name="courriel" id="mot-courriel-passe required">
            <?= $courriel_err ?>
        </div>
        <button type="submit">Soumettre</button>

    </form>
<?= nav('<button  style="margin: 0" type="button">Retour </button>', 'Comptes', 'login'); ?>
 </div>

<?= load_css('login') ?>
