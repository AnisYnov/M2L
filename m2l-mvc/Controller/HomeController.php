<?php

namespace Controller;

use Core\Controller;
use Model\HomeModel;
use Websoftwares\Session;

//use Model\AdminModel;

class HomeController extends Controller
{
    public function loginAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['formconnexion'])) {
                $identifiant = htmlspecialchars($_POST['pseudo']);
                $mdpconnect = md5($_POST['password']);

                //            if (preg_match("#^[a-zA-Z0-9]{3,50}$#", $_POST['pseudo'])) {
                //                echo 'L\'identifiant ' . $_POST['pseudo'] . ' est <strong>valide</strong> !';
                //            }
                //            else
                //            {
                //                echo 'L\'identifiant ' . $_POST['pseudo'] . ' n\'est pas valide, recommencez !';
                //            }

                if (!empty($identifiant) AND !empty($mdpconnect)) {
                    $model = new HomeModel();
                    $userinfo = $model->getLogin($identifiant, $mdpconnect);
                    if ($userinfo != false) {
                        $session = new Session;
                        $session->start();
                        $session['id_s'] = $userinfo->id_s;
                        $session['identifiant'] = $userinfo->identifiant;
                        $session['status'] = $userinfo->status;
                        header("Location: index.php?page=accueil");
                        exit();
                    }
                    else {
                        $erreur = "Mauvais mail ou mot de passe !";
//                        echo $erreur;
                        return self::$twig->render('Home/homeLogin.html.twig', [
                            'erreur' => $erreur
                        ]);
                    }
                }
                else {
                    $erreur = "Tous les champs doivent être complétés !";
                    return self::$twig->render('Home/homeLogin.html.twig', [
                        'erreur' => $erreur
                    ]);

                }
            }
        }
        else {
            return self::$twig->render('Home/homeLogin.html.twig', []);
        }
    }
//    public function loginAction(){
//        if(isset($_POST['formconnexion'])) {
//            $identifiant = htmlspecialchars($_POST['pseudo']);
//            $mdpconnect = md5($_POST['password']);
//
////            if (preg_match("#^[a-zA-Z0-9]{3,50}$#", $_POST['pseudo'])) {
////                echo 'L\'identifiant ' . $_POST['pseudo'] . ' est <strong>valide</strong> !';
////            }
////            else
////            {
////                echo 'L\'identifiant ' . $_POST['pseudo'] . ' n\'est pas valide, recommencez !';
////            }
//
//            if (!empty($identifiant) AND !empty($mdpconnect)) {
//                $model = new HomeModel();
//                $userinfo = $model->getLogin($identifiant, $mdpconnect);
//                if ($userinfo != false) {
//                    $session = new Session;
//                    $session->start();
//                    $session['id_s'] = $userinfo->id_s;
//                    $session['identifiant'] = $userinfo->identifiant;
//                    $session['status'] = $userinfo->status;
//                    header("Location: index.php?page=accueil");
//                    exit();
//                }
//                else {
//                    $erreur = "Mauvais mail ou mot de passe !";
//                    echo $erreur;
//                    return self::$twig->render('Home/homeLogin.html.twig', [
//                        'erreur' => $erreur
//                    ]);
//                }
//            }
//            else {
//                $erreur = "Tous les champs doivent être complétés !";
//                return self::$twig->render('Home/homeLogin.html.twig', [
//                    'erreur' => $erreur
//                ]);
//
//            }
//        }
//    }
    public function logoutAction(){
        $session = new Session;
        $session->start();
        $session->destroy();
        header('Location:index.php?page=login');
        exit();
    }

    public function accueilAction(){
        $session = new Session();
        $session->start();
        $id_s = $_SESSION["id_s"];
        $status = $_SESSION["status"];
        if(!isset($_SESSION["identifiant"])){
            header("Location:?page=login");
            exit();
        }
        $model =  new HomeModel();
        $user = $model->getUser($id_s);
        $data = $model->getListFormationAbonnee($id_s,"valider");
        $data2 = $model->getListFormation();

        return self::$twig->render('Home/homeAccueil.html.twig',[
            "frtAbonnee" => $data,
            "frt" => $data2,
            "user"=> $user,
            "status" => $status
        ]);
    }
    public function checkCreditNbsJrAction($id_s, $id_f, $etat){
        $model = new HomeModel();
        $user = $model->getUserCreditNbsJ($id_s);
        $formation = $model->getFormationCoutDuree($id_f);
        $credit = $user->credit;
        $nbrJr = $user->nbs_jour;
        $cout = $formation->cout;
        $duree =$formation->duree;
        $data = array();
        if($etat === "abonnee") {
            if ($credit == 0) {
                $data['msg'] = "plus de credit";
            } elseif ($credit < $cout) {
                $data['msg'] = "pas asser de credit";
            } elseif ($nbrJr == 0) {
                $data['msg'] = "plus de jour de formation";
            } elseif ($nbrJr < $duree) {
                $data['msg'] = "pas asser de jour de formation";
            } else {
                $data['totalJ'] = $totalJ = $nbrJr - $duree;
                $data['totalC'] = $totalC = $credit - $cout;
            }
        }
        elseif($etat == "refuser"){
            $data['totalJ'] = $totalJ = $nbrJr + $duree;
            $data['totalC'] = $totalC = $credit + $cout;
        }
        return $data;
    }
    public function abonneFormationAction(){
        $session = new Session();
        $session->start();
        $id_s = $_SESSION["id_s"];
        $status = $_SESSION["status"];
        $data = $this->checkCreditNbsJrAction($id_s,$_GET['id'],"abonnee");

        if(isset($data['msg'])){
            header("Refresh:2;url=?page=accueil");
            return self::$twig->render('Home/homeMsg.html.twig',[
                "msg" => $data['msg']
            ]);
        }else{
            $model =  new HomeModel();
            $model->setUserCreditNbsJ($id_s,$data['totalC'],$data['totalJ']);
            $model->setAddFormationValide($id_s,$_GET['id']);
            header("Refresh:2;url=?page=accueil");
            return self::$twig->render('Home/homeMsg.html.twig',[
                "msg" => "formation ajouter",
            ]);
        }
    }

    public function historiqueAction(){
        $session = new Session();
        $session->start();
        $id_s = $_SESSION["id_s"];
        $status = $_SESSION["status"];
        $model =  new HomeModel();
        $user = $model->getUser($id_s);
        $data = $model->getListFormationAbonnee($id_s,"effectuée");
        return self::$twig->render('Home/homeHistorique.html.twig',[
            "frtEffectuée" => $data,
            "user"=> $user,
            "status" => $status
        ]);
    }

    public function listeSalarieAction(){
        $session = new Session();
        $session->start();
        $id_s = $_SESSION["id_s"];
        $status = $_SESSION["status"];

        if ($status !== "chef d’équipe"){
            header("Location: ?pâge=acceuil");
            exit;
        }
        $model = new HomeModel();
        $user = $model->getUser($id_s);
        $data = $model->getAllUserSalarie();
        return self::$twig->render('Home/homeListeSalarie.html.twig',[
            "listeSalarie" => $data,
            "user"=> $user,
            "status" => $status
        ]);

    }
    public function detailsSalarieAction()
    {
        $session = new Session();
        $session->start();
        $id_s = $_SESSION["id_s"];
        $status = $_SESSION["status"];

        if ($status !== "chef d’équipe") {
            header("Location: ?pâge=acceuil");
            exit;
        }
        $model = new HomeModel();
        $user = $model->getUser($id_s);
        $details = $model->getUserSalarie($_GET['id']);
        $data = $model->getListFormationAbonnee($id_s,"en cours de validation");
        $data2 = $model->getListFormationAbonnee($id_s,"effectuée");
        return self::$twig->render('Home/homeDetailsSalarie.html.twig',[
            "frtAtt" => $data,
            "frteff" => $data2,
            "detalse" => $details,
            "user"=> $user,
            "status" => $status,
            "test" => "ok"
        ]);
    }
    public function valideFormation(){

    }


}
