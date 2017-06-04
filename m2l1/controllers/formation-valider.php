<?php
require_once"../models/model.php";
session_start();
if (isset($_GET['etat']) && isset($_GET['etat']) && isset($_GET['etat'])) {

  formationAValider($_GET['etat'],$_GET['id_f'], $_GET['id_s']);

}
$id_s = $_GET['id_s'];
header("refresh:2;url=../views/detail-salarie.php?id_s=$id_s" );
?>
