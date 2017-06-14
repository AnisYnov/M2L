<?php
require_once"../models/model.php";
session_start();


if (isset($_GET['id_f']) ) {
formationAboner($_GET['id_f'],$_SESSION['id_s']);

}
header("refresh:2;url=../views/index.php" );

 ?>
