<?php
include_once 'View/Helper.php';
include_once 'Entity/Compte.php';

session_start();
if (isset($_SESSION["connectedUser"])) {
    $connectedUser = $_SESSION["connectedUser"];
    $compteType = $connectedUser->getType();
}

if (!isset($_SESSION["globalData"])) {
    $_SESSION["globalData"] = [];
}

if (!isset($_SESSION["flashList"])) {
    $_SESSION["flashList"] = new ArrayObject();
}

use App\Controller\ComptesController;?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="/420626RI/Equipe_2/ProjetInternational/favicon.ico">

    <title>
        Bureau international
    </title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <?= load_css('base')?>
    <?= load_css('style')?>
    <?= load_css('custom')?>
    <?= load_css('header')?>

    <script src="https://code.jquery.com/jquery-3.4.1.js"
            integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
            crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
            integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

</head>

<body>

<header>
    <div id="ligne1">
        <?= nav('<img src="Ressource/img/Logo-Cegep.png" alt="logo cegep" id="logo"> Bureau international', 'voyages', 'index')?>

<?php if (isset($_SESSION["connectedUser"])):?>
            <?= nav('<img src="Ressource/img/log-out.png" alt="logout icon" id="logout">', 'comptes', 'logout')?>
            <?= nav1('<img src="Ressource/img/user.png" alt="user icon" id="user">', 'comptes', 'view', $_SESSION["connectedUser"]->getIdCompte());?>
<?php endif;?>

        <span id="bienvenue"> Bienvenue <?= !empty($_SESSION["connectedUser"]) ? ',' . $_SESSION["connectedUser"]->getPseudo() : ""?> </span>

    </div>

    <nav>
        <ul class="nav-links">
<?php if (isset($compteType)):?>

<?php if(isOfType([ADMIN,PROF]))
                echo nav('<li class="navbutton">Propositions de projet</li>', 'propositions', 'index')
?>

<?php if(isOfType([ADMIN,PROF,ETUDIANT]))
                    echo nav('<li class="navbutton">Projets de mobilité</li>', 'voyages', 'index')
?>


<?php if(isOfType([ADMIN]))
                    echo nav('<li class="navbutton">Utilisateurs</li>', 'comptes', 'index')
?>

<?php if(isOfType([PROF]))
                    echo nav('<li class="navbutton">Liste des participants</li>', 'comptes', 'index')
?>

<?php if(isOfType([ADMIN]))
                    echo nav('<li class="navbutton">Banque de questions</li>', 'questions', 'index')
?>

<?php if(isOfType([ADMIN]))
                    echo nav('<li class="navbutton">Configurations</li>', 'configuration', 'index')
?>

<?php if(isOfType([ADMIN]))
                    echo nav('<li class="navbutton">Statistiques</li>', 'statistiques', 'index')
?>

<?php if(isOfType([ADMIN,PROF,ETUDIANT]))
                    echo nav('<li class="navbutton">Tutoriel</li>', 'noauth', 'tutoriel')
?>

<?php if(isOfType([ADMIN,PROF,ETUDIANT]))
                    echo nav1('<li class="navbutton">Profil</li>', 'comptes', 'view', $_SESSION["connectedUser"]->getIdCompte())
?>

<?php if(isOfType([ADMIN,PROF,ETUDIANT]))
                    echo nav('<li class="navbutton">Informations supplémentaires</li>', 'noauth', 'info')
?>
<?php endif?>

        </ul>

        <div class="burger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
    </nav>
</header>

<?php
$flaslist = $_SESSION["flashList"];
foreach ($flaslist as $flash):
?>
<?php if ($flash[0] === '1'):?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $flash[1]?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php elseif ($flash[0] === '0'):?>
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <?= $flash[1]?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php elseif ($flash[0] === '-1'):?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $flash[1]?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif?>
<?php endforeach;
$_SESSION["flashList"] = new ArrayObject();
?>

<div class="container clearfix text-center" >
<?php
    $switch_controller = 'Comptes';
    $switch_action = 'Login';

    if (isset($_GET['controller']) && isset($_GET['action'])) {
        $switch_controller = $_GET['controller'];
        $switch_action = $_GET['action'];
    }

    switch ($switch_controller) {
        /*ActivationsController*/
        case 'Activations':
            include_once 'Controller/ActivationsController.php';
            $activationController = new \App\Controller\ActivationsController();

            if ($switch_action === 'Index') {
                include('View/Activations/index.php');
            } else if ($switch_action === 'Add') {
                include('View/Activations/add.php');
            }
            break;

        /*CategoriesController*/
        case 'Categories':
            include_once 'Controller/CategoriesController.php';
            $categoriesController = new \App\Controller\CategoriesController();

            if ($switch_action === 'Add') {
                include('View/Categories/add.php');
            } else if ($switch_action === 'Edit') {
                include('View/Categories/edit.php');

            }
            break;

        /*ConfigurationController*/
        case 'Configuration':
            include_once 'Controller/ConfigurationController.php';
            $configurationController = new \App\Controller\ConfigurationController();

            if ($switch_action === 'Index') {
                include('View/Configuration/index.php');
            }
            break;

        /*DestinationController*/
        case 'Destinations':
            include_once 'Controller/DestinationsController.php';
            $destinationsController = new \App\Controller\DestinationsController();

            if ($switch_action === 'Add') {
                include('View/Destinations/add.php');
            } else if ($switch_action === 'Edit') {
                include('View/Destinations/edit.php');
            }
            break;

        /*NoauthController*/
        case 'Noauth':
            include_once 'Controller/NoauthController.php';
            $noAuthController = new \App\Controller\NoauthController();

            if ($switch_action === 'CreateAccount') {
                include('View/Noauth/create_account.php');
            } else if ($switch_action === 'PasswordRecover') {
                include('View/Noauth/password_recover.php');
            } else if ($switch_action === 'Info') {
                include('View/Noauth/info.php');
            } else if ($switch_action === 'AccessDenied') {
                include('View/Noauth/access_denied.php');
            } else if ($switch_action === 'Tutoriel') {
                include('View/Noauth/tutoriel.php');
            }
            break;

        /*ProgrammesController*/
        case 'Programmes':
            include_once 'Controller/ProgrammesController.php';
            $programmesController = new \App\Controller\ProgrammesController();

            if ($switch_action === 'Add') {
                include('View/Programmes/add.php');
            } else if ($switch_action === 'Edit') {
                include('View/Programmes/edit.php');
            }
            break;

        /*QuestionsController*/
        case 'Questions':
            include_once 'Controller/QuestionsController.php';
            $questionsController = new \App\Controller\QuestionsController();

            if ($switch_action === 'Index') {
                include('View/Questions/index.php');
            } else if ($switch_action === 'View') {
                include('View/Questions/view.php');
            } else if ($switch_action === 'Add') {
                include('View/Questions/add.php');
            } else if ($switch_action === 'Edit') {
                include('View/Questions/edit.php');
            }
            break;

        /*ValeursController*/
        case 'Valeurs':
            include_once 'Controller/ValeursController.php';
            $valeursController = new \App\Controller\ValeursController();

            if ($switch_action === 'Index') {
                include('View/Valeurs/index.php');
            } else if ($switch_action === 'Edit') {
                include('View/Valeurs/edit.php');
            }
            break;


        /*VoyaggesController*/
        case 'Voyages':
            include_once 'Controller/VoyagesController.php';
            $voyagesController = new \App\Controller\VoyagesController();

            if ($switch_action === 'Index') {
                include('View/Voyages/index.php');
            } else if ($switch_action === 'View') {
                include('View/Voyages/view.php');
            } else if ($switch_action === 'Add') {
                include('View/Voyages/add.php');
            } else if ($switch_action === 'Edit') {
                include('View/Voyages/edit.php');
            } else if ($switch_action === 'Viewparticipants') {
                include('View/Voyages/viewparticipants.php');
            }
            break;

        /*VoyagesQuestionsController*/
        case 'VoyagesQuestions':
            include_once 'Controller/VoyagesQuestionsController.php';
            $voyagesQuestionsController = new \App\Controller\VoyagesQuestionsController();

            if ($switch_action === 'Index') {
                include('View/VoyagesQuestions/index.php');
            }
            break;

        /*ComptesController*/
        case 'Comptes':
            include_once 'Controller/ComptesController.php';
            $comptesController = new ComptesController();

            if ($switch_action === 'Index') {
                include('View/Comptes/index.php');
            } else if ($switch_action === 'View') {
                include('View/Comptes/view.php');
            } else if ($switch_action === 'Edit') {
                include('View/Comptes/edit.php');
            } else if ($switch_action === 'Logout') {
                $comptesController->logout();
            } else if ($switch_action === 'Add') {
                include('View/Comptes/add.php');
            } else if ($switch_action === 'Login') {
                include('View/Comptes/login.php');
            }
            break;

        /*PropositionsController*/
        case 'Propositions':
            include_once 'Controller/PropositionsController.php';
            $propositionController = new \App\Controller\PropositionsController();

            if ($switch_action === 'Index') {
                include('View/Propositions/index.php');
            } else if ($switch_action === 'View') {
                include('View/Propositions/view.php');
            } else if ($switch_action === 'Edit') {
                include('View/Propositions/edit.php');
            }else if ($switch_action === 'Add') {
                include('View/Propositions/add.php');
            }
            break;

        /*StatisitiquesController*/
        case 'Statistiques':
            include_once 'Controller/StatistiqueController.php';
            $statistiqueController = new \App\Controller\StatistiqueController();

            if ($switch_action === 'Index') {
                include('View/Statistiques/index.php');
            }
            break;

    }

    if (isset($_SESSION["globalData"])) {
        $_SESSION["globalData"] = [];
    }
?>
</div>

<footer>
</footer>


<script>
    $("form").submit(function () {
        $(":submit").text("En  cours...").prop("disabled", true);
    });
</script>

<?= load_script('navigation')?>


</body>
</html>
