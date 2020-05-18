<?php

namespace App\Controller;

class AppController
{
    public function initialize()
    {
        //Check access
    }

    public function redirect($controller, $action)
    {
        header('Location: ?controller=' . ucfirst($controller).'&action='. ucfirst($action));
    }

    public function redirectParam1($controller, $action, $param1)
    {
        header('Location: ?controller=' . ucfirst($controller) . '&action=' . ucfirst($action) . '&param1=' . $param1 );
    }

    public function redirectParam2($controller, $action, $param1, $param2)
    {
        header('Location: ?controller=' . ucfirst($controller) . '&action=' . ucfirst($action) . '&param1=' . $param1 . '&param2=' . $param2 );
    }

    public function isAuthorized($authorizedTypes)
    {
        if (isset($_SESSION["connectedUser"])) {
            $connectedUser = $_SESSION["connectedUser"];
            $compteType = $connectedUser->getType();
        }
        else{
            $this->redirect("Comptes", "Login");
            return false;
        }

        if(! in_array($compteType, $authorizedTypes))
        {
            $this->redirect("noauth", "accessDenied");
            return false;
        }
        return true;
    }

    public function flashGood($msg){
        $_SESSION["flashList"]->append(['1', $msg]);
    }

    public function flashNeutral($msg){
        $_SESSION["flashList"]->append(['0', $msg]);
    }

    public function flashBad($msg){
        $_SESSION["flashList"]->append(['-1', $msg]);
    }

    public function set($tag, $value){
        $_SESSION["globalData"][$tag] = $value;
    }

    function isLeap($year)
    {
        return (date('L', mktime(0, 0, 0, 1, 1, $year))==1);
    }
}
