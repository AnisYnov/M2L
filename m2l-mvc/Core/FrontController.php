<?php


namespace Core;

use Controller\HomeController;

class FrontController
{
    public static function appStart()
    {
        $output = '';
        // je me connecte
//        $pdo = Database::connect();
        // gestion de l'action appelée, GEST en prio, puis POST puis chaine vide
        $page = $_GET['page'] ?? $_POST['page'] ?? '';
        switch ($page) {
//            case "loginf":
//                $controller = new HomeController();
//                $output = $controller->loginFormAction();
//                break;
            case "login":
                $controller = new HomeController();
                $output = $controller->loginAction();
                break;
            case "logout":
                $controller = new HomeController();
                $output = $controller->logoutAction();
                break;

            case "accueil":
                $controller = new HomeController();
                $output = $controller->accueilAction();
                break;
            case "abonneFormation":
                $controller = new HomeController();
                $output = $controller->abonneFormationAction();
                break;
            case "historique":
                $controller = new HomeController();
                $output = $controller->historiqueAction();
                break;
            case "listeSalarie":
                $controller = new HomeController();
                $output = $controller->listeSalarieAction();
                break;
            case "detailsSalarie":
                $controller = new HomeController();
                $output = $controller->detailsSalarieAction();
                break;
        }

        echo $output;
    }

}
