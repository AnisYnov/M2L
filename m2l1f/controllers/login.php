<?php
require_once("../models/model.php");
// require_once("config.php");


if(isset($_POST['formconnexion'])) {
    $identifiant = htmlspecialchars($_POST['pseudo']);
    $mdpconnect = md5($_POST['password']);

    if (preg_match("#^[a-zA-Z0-9]{3,50}$#", $_POST['pseudo'])) {
        echo 'L\'identifiant ' . $_POST['pseudo'] . ' est <strong>valide</strong> !';
    }
    else
    {
        echo 'L\'identifiant ' . $_POST['pseudo'] . ' n\'est pas valide, recommencez !';
    }
}

    if(!empty($identifiant) AND !empty($mdpconnect)){
        $userinfo = login($identifiant,$mdpconnect);
        if($userinfo != false) {
            session_start();
            $_SESSION['id_s'] = $userinfo['id_s'];
            $_SESSION['identifiant'] = $userinfo['identifiant'];
            $_SESSION['status'] = $userinfo['status'];

            header("Location: ../views/index.php");
        }
        else
        {
            $erreur = "Mauvais mail ou mot de passe !";
            echo $erreur;
            //      header("refresh:2;url=../views/login.php" );
        }
    }
    else
    {
        $erreur = "Tous les champs doivent être complétés !";
        echo $erreur;
        //    header("refresh:2;url=../views/login.php" );

}



?>
