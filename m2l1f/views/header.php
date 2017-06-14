<?php  
if(!isset($_SESSION['identifiant']) && !isset($_SESSION['id_s']))
{
    header("Location:views/login.php");
}
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width" />
  <title>Responsive Design website template</title>
  <link rel="stylesheet" href="../css/components.css">
  <link rel="stylesheet" href="../css/responsee.css">
  <link rel="stylesheet" href="../owl-carousel/owl.carousel.css">
  <link rel="stylesheet" href="../owl-carousel/owl.theme.css">
  <!-- CUSTOM STYLE -->
  <link rel="stylesheet" href="../css/template-style.css">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
  <script type="text/javascript" src="../controllers/js/jquery-1.8.3.min.js"></script>
  <script type="text/javascript" src="../controllers/js/jquery-ui.min.js"></script>
  <script type="text/javascript" src="../controllers/js/modernizr.js"></script>
  <script type="text/javascript" src="../controllers/js/responsee.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/index.css">
  
  <header>
    <nav>
      <div class="line">
        <div class="top-nav">  
          <div class="top-nav s-12 l-5">
            <ul class="top-ul chevron">
              <li><a href="index.php">Accueil</a>
              </li>
              <li><a href="historique.php">Historique</a>
              </li>
              <li><a href="../controllers/logout.php">deconnexion</a>
              </li>
                <?php if ($_SESSION['status'] == "chef d’équipe"): ?>
                <li>
                  <a href="liste-salarie.php">liste des salaries</a>
                </li>
              <?php endif; ?>
            </ul>
          </div>
          <ul class="s-12 l-2">
            <li class="logo hide-s hide-m">
              <a><strong>M2L</strong></a>
            </li>
          </ul>
          <div class="top-nav s-12 l-5">
            <ul class="top-ul chevron">
            
              

      <div class="span12">
            <form id="custom-search-form" class="form-search form-horizontal " action="recherche-formations.php" method="post">
                <div class="input-append span12">
                    <input type="text" class="search-query mac-style" name="search" placeholder="Search">
                    <button type="submit" class="btn"><i class="icon-search"></i></button>
                </div>
            </form>
        </div>
              <?php $row = user($_SESSION['id_s']); ?>
              <li style="color:#ffffff;"><?= "Bienvenue ".$row['prenom']." Credit: ".$row['credit']." Jour de formation: ".$row['nbs_jour'];?></li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </header>
