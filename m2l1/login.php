<?php
require_once("../models/model.php");
// require_once("config.php");


if(isset($_POST['formconnexion'])) {
  $identifiant = htmlspecialchars($_POST['pseudo']);
  $mdpconnect = md5($_POST['password']);

  if(!empty($identifiant) AND !empty($mdpconnect)){
    echo "ok";
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
}



?>
