<?= load_css('tutoriel') ?>

<body data-spy="scroll" data-target="#myScrollspy" data-offset="84">
<?php
if (isOfType([ADMIN]))
    include_once("View/Noauth/Tutoriel/tutoriel-admin.php");
else if (isOfType([PROF]))
    include_once("View/Noauth/Tutoriel/tutoriel-acomp.php");
else if (isOfType([ETUDIANT]))
    include_once("View/Noauth/Tutoriel/tutoriel-etu.php");
?>
</body>
