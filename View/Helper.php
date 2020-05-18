<?php

function dollar($base_string)
{

    if ($base_string > 9999) {
        return (number_format($base_string, 2, ',', ' ') . " $");
    } else {
        return (number_format($base_string, 2, ',', '') . " $");
    }
}


function return_months()
{
    $months = [
        1 => "Janvier",
        2 => "Février",
        3 => "Mars",
        4 => "Avril",
        5 => "Mai",
        6 => "Juin",
        7 => "Juillet",
        8 => "Août",
        9 => "Septembre",
        10 => "Octobre",
        11 => "Novembre",
        12 => "Décembre"];
    return $months;
}

function dateToFrench($date)
{
    $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $french_months = return_months();
    return str_replace($english_months, $french_months, date('j F Y', strtotime($date) ) );
}

function return_month_from_number($index)
{
    return return_months()[$index];
}

function load_css($input_css)
{
    return '<link rel = "stylesheet" href="Ressource/css/' . $input_css . '.css">';
}

function load_script($input_js)
{
    return '<script type="text/javascript" src="Ressource/js/' . $input_js . '.js"></script>';
}

function nav($str_html, $controller_name, $action_name)
{
    return '<a href="?controller=' . ucfirst($controller_name) . '&action=' . ucfirst($action_name) . '">' . $str_html . '</a>';
}

function nav1($str_html, $controller_name, $action_name, $param1)
{
    return '<a href="?controller=' . ucfirst($controller_name) . '&action=' . ucfirst($action_name) . '&param1=' . $param1 . '">' . $str_html . '</a>';
}

function nav2($str_html, $controller_name, $action_name, $param1, $param2)
{
    return '<a href="?controller=' . ucfirst($controller_name) . '&action=' . ucfirst($action_name) . '&param1=' . $param1 . '&param2=' . $param2 . '">' . $str_html . '</a>';
}

function get($tag)
{
    return $_SESSION["globalData"][$tag];
}


function download($filename, $txt)
{
    return '<a href="Ressource/uploads/' . $filename . '">' . $txt . '</a>';

}

define("ADMIN", "admin");
define("PROF", "prof");
define("ETUDIANT", "etudiant");

function isOfType($types)
{
    if (isset($_SESSION["connectedUser"])) {
        $connectedUser = $_SESSION["connectedUser"];
        $compteType = $connectedUser->getType();

        if(! in_array($compteType, $types))
        {
            return false;
        }
        return true;
    }
    return false;
}

