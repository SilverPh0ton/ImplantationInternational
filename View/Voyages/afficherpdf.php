<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$arrVoyages = json_decode($_SESSION['arrVoyages']);
$titre = $arrVoyages->titre;
$pays = $arrVoyages->pays;
$ville = $arrVoyages->ville;
$note = $arrVoyages->note;
$dateD = $arrVoyages->dateD;
$dateR = $arrVoyages->dateR;
$actif = $arrVoyages->actif;
$nbrpart = $arrVoyages->nbrpart;

// Include
require_once "dompdf/autoload.inc.php";

// Reference de Dompdf namespace
use Dompdf\Dompdf;

// Instantiate dompdf class
$dompdf = new Dompdf();

// Load HTML content


$dompdf->loadHtml("
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

  <h1>$titre</h1>
  <div>
  <table class='table table-striped'>
    <tr class='trvide'>
    <th class='trvide'></th>
    <td class='trvide'></td>
    </tr>
    <tr>
      <th scope='row'>Pays</th>
      <td>$pays</td>
    </tr>
    <tr>
      <th scope='row'>Ville</th>
      <td>$ville</td>
    </tr>
    <tr>
      <th scope='row'>Date de départ</th>
      <td>$dateD</td>
    </tr>
    <tr>
      <th scope='row'>Date de retour</th>
      <td>$dateR</td>
    </tr>
    <tr>
      <th>Actif</th>
      <td>$actif</td>
    </tr>
    <tr>
      <th scope='row'>Participants</th>
      <td>$nbrpart</td>
    </tr>
    </table>
 </div>
 <div class='note'>Note</div>
 <div><p>$note</p></div>


 ");

// Setup paper size
$dompdf->setPaper('letter','landscape');

//Render the HTML as PDF

$dompdf->render();

// Output the generated PDF
$dompdf->stream("ProjetMobilite", array("Attachment" => 0));
?>
