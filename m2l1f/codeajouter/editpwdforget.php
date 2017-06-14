
<?php
require_once("../models/model.php");


if(isset($_POST['editpwd'])) {
    $pwd = md5($_POST['pwd']);
    if(!empty($pwd)){
        $usermail = editpwd($_POST['id_s'], $pwd);
        if($usermail != false) {

            echo "mot de passe a été modifé";
            header("refresh:2;url=../views/login.php" );
        }
    }else{
        echo "les champs doivent être remplis";
        header("refresh:2;url=../views/pwdform.php" );
    }
}