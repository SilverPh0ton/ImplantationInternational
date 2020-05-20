<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$arrComptes = json_decode($_SESSION['arrComptes']);
$nomU = $arrComptes->nomU;
$type = $arrComptes->type;
$courriel = $arrComptes->courriel;
$prenom = $arrComptes->prenom;
$nom = $arrComptes->nom;
$telephone = $arrComptes->telephone;
$programme = $arrComptes->programme;
$dateNaissance = $arrComptes->dateNaissance;
$voyage = $arrComptes->voyage;
// Include
require_once "../Voyages/dompdf/autoload.inc.php";

// Reference de Dompdf namespace
use Dompdf\Dompdf;

// Instantiate dompdf class
$dompdf = new Dompdf();

// Load HTML content
$html = "
<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css' integrity='sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk' crossorigin='anonymous'>

  <style>
  .note{
    font:bold;
  }
  th{
    text-align:left;
  }
  td{
    text-align:right;
  }
  .trvide{
    background-color:#002042;
  }
  h1{
    text-align:center;
    margin-bottom:10%;
    text-decoration: underline;
  }
  table{
    width:100%;
  }
  body{
    font-size:20px;
  }
  </style>

  <h1>$prenom $nom</h1>
  <h2>$voyage</h2>
  <div>
  <table class='table table-striped'>
    <tr class='trvide'>
    <th class='trvide'></th>
    <td class='trvide'></td>
    </tr>
    <tr>
      <th scope='row'>Type</th>
      <td>$type</td>
    </tr>
    <tr>
      <th scope='row'>Adresse courriel</th>
      <td>$courriel</td>
    </tr>
    <tr>
      <th>Numéro de téléphone</th>
      <td>$telephone</td>
    </tr>
    <tr>
      <th scope='row'>Programme</th>
      <td>$programme</td>
    </tr>
    <tr>
      <th scope='row'>Date de naissance</th>
      <td>$dateNaissance</td>
    </tr>
    </table>
 </div>
 ";

$dompdf->loadHtml($html);

// Setup paper size
$dompdf->setPaper('letter','landscape');

//Render the HTML as PDF

$dompdf->render();

// Output the generated PDF
$dompdf->stream($prenom."".$nom, array("Attachment" => 0));
?>
