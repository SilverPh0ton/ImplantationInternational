<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$nomU = $_POST['nomU'];
$type = $_POST['type'];
$courriel = $_POST['courriel'];
$prenom = $_POST['prenom'];
$nom = $_POST['nom'];
$telephone = $_POST['telephone'];
$programme = $_POST['programme'];
$dateNaissance = $_POST['dateNaissance'];
$voyage = $_POST['voyage'];
$arrComptes=array("nomU"=>$nomU,"type"=>$type,"courriel"=>$courriel,"prenom"=>$prenom,"nom"=>$nom,"telephone"=>$telephone,"programme"=>$programme,"dateNaissance"=>$dateNaissance, "voyage"=>$voyage);
$_SESSION['arrComptes']= json_encode($arrComptes);
?>
