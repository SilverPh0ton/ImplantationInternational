<?php
/**
 * @var \App\Controller\ComptesController $comptesController
 */
$comptesController->login();
?>

<img src="Ressource/img/Logo-Cegep-bleu.png" alt="logo" id="image">

<?php

?>
<div class="contain">

    <h1>Connexion</h1>

    <form method="post">
    <div class="input text">
        <label for="pseudo">Nom d'utilisateur</label>
        <input type="text" name="pseudo" id="pseudo">
    </div>
    <div class="input text">
        <label for="mot-de-passe">Mot de passe</label>
        <input type="password" name="mot_de_passe" id="mot-de-passe">
    </div>
        <button type="submit">Se connecter</button>
    </form>

    <div>
        <?= nav('Première utilisation? Créer un compte','noauth','createAccount');?>
    </div>

    <div>
        <?= nav('Mot de passe oublié ?','noauth','passwordRecover');?>
    </div>

</div>

<?= load_css('login')?>
