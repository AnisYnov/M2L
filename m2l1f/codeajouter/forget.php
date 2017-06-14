
<?php
require_once("../models/model.php");
// require_once("config.php");


if(isset($_POST['forgetpwd'])) {
    $mail = $_POST['email'];
    if(!empty($mail)){
        $usermail = userMail($mail);
        if($usermail != false) {
            $to      = $usermail['email'];
            $subject = 'mot de passr';
            $message = 'Bonjour<br>';
            $message .= "liens pour changer votre mot de pass<br>";
            $message .= "<a href=\"http://localhost/m2l1V5-17/m2l1/views/editpwd.php?id=".$usermail['id_s']."\">liens pour changer votre mot de passe</a><br>";

            mail($to, $subject, $message);
            echo "mail bien envoyé";
            header("refresh:2;url=../views/login.php" );
        }
    }else{
        echo "les champs doivent être remplis";
        header("refresh:2;url=../views/pwdform.php" );
    }
}