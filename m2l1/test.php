<?php
function cnx(){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "ml2";


  try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);



    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  }
  catch(PDOException $e)
  {

    echo "Connection raté: " . $e->getMessage();
  }

  $pdo->exec('set names utf8');
  return $pdo;
}

function login($mail,$mdp){
  $pdo = cnx();
  $sql=
  "SELECT `id_s`,`email`,`status`
  FROM `salarie`
  WHERE `email` = :email AND `mot_de_passe` = :mot_de_passe";
  $requser = $pdo->prepare($sql);
  $requser->bindValue(":email", $mail);
  $requser->bindValue(":mot_de_passe",$mdp);
  $requser->execute();
  return $userinfo = $requser->fetch();
 }
 var_dump(login("ab@r","202cb962ac59075b964b07152d234b70"));
 $userinfo=login("ab@ra","202cb962ac59075b964b07152d234b70");
 if($userinfo != false) {

   session_start();
   $_SESSION['id_s'] = $userinfo['id_s'];
   $_SESSION['email'] = $userinfo['email'];
   $_SESSION['status'] = $userinfo['status'];
 }else{
   echo 'faux';
 }
echo  $_SESSION['id_s'];

 ?>
