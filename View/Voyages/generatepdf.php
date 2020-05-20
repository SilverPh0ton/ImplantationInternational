<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$titre = $_POST['titre'];
$pays = $_POST['pays'];
$ville = $_POST['ville'];
$note = $_POST['note'];
$dateD = $_POST['dateD'];
$dateR = $_POST['dateR'];
$actif = $_POST['actif'];
$nbrpart = $_POST['nbrpart'];
$arrVoyages=array("titre"=>$titre,"pays"=>$pays,"ville"=>$ville,"note"=>$note,"dateD"=>$dateD,"dateR"=>$dateR,"actif"=>$actif,"nbrpart"=>$nbrpart);
$_SESSION['arrVoyages']= json_encode($arrVoyages);

?>
