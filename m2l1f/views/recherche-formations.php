<?php require_once"../models/model.php"; ?>
<?php session_start(); ?>
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
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
    <?php include('header.php'); ?>
</head>
<body class="size-1140">
<section>

    <div class="span7">
        <div class="widget stacked widget-table action-table">

            <div class="widget-header">
                <i class="icon-th-list"></i>
                <h3 class="titre">Formations inscrit</h3>
            </div> <!-- /widget-header -->

            <div class="widget-content">

                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>âge</th>
                        <th>email</th>
                        <th>formation demandé</th>
                        <th>formation fais</th>
                        <th>choix</th>
                    </tr>

                    <th class="td-actions"></th>
                    </tr>
                    </thead>
                    <tbody>	<tr>
                        <td></td>
                        <td></td>
                        <td class="td-actions">
                            <a href="javascript:;" class="btn btn-small btn-primary">
                                <i class="btn-icon-only icon-ok"></i>
                            </a>

                            <a href="javascript:;" class="btn btn-small">
                                <i class="btn-icon-only icon-remove"></i>
                            </a>
                        </td>
                    </tr>	<tr>
                        <td></td>
                        <td></td>
                        <td class="td-actions">
                            <a href="javascript:;" class="btn btn-small btn-primary">
                                <i class="btn-icon-only icon-ok"></i>
                            </a>

                            <a href="javascript:;" class="btn btn-small">
                                <i class="btn-icon-only icon-remove"></i>
                            </a>
                        </td>
                    </tr>
                    <?php formationRecherche($_POST['search']); ?>
                    </tbody>
                </table>

            </div> <!-- /widget-content -->

        </div> <!-- /widget -->
    </div>
    <br />
    <br />

</section>
<!-- TOP NAV WITH LOGO -->

<!-- <section>
            <div id="head">
                <div class="line">
                    <h1>Formations inscrit</h1>
                </div>
            </div>
            <div class="container">
                <div class="row col-md-6 col-md-offset-2 custyle">
                    <table class="table table-striped custab">
                        <thead>

                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>âge</th>
                                <th>email</th>
                                <th>formation demandé</th>
                                <th>formation fais</th>
                                <th>choix</th>
                            </tr>
                        </thead>
                      <tbody>
                        <?php formationRecherche($_POST['search']); ?>
                      </tbody>
                    </table>
                </div>
            </div>


        </section> -->

<!-- FOOTER -->
<footer>
    <div class="line">
        <div class="s-12 l-6">
            <p>Copyright 2015, Vision Design - graphic zoo
            </p>
        </div>
        <div class="s-12 l-6">
            <p class="right">
                <a class="right" href="http://www.myresponsee.com" title="Responsee - lightweight responsive framework">Design and coding by Responsee Team</a>
            </p>
        </div>
    </div>
</footer>
<script type="text/javascript" src="../owl-carousel/owl.carousel.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $("#owl-demo").owlCarousel({
            slideSpeed : 300,
            autoPlay : true,
            navigation : false,
            pagination : false,
            singleItem:true
        });
        $("#owl-demo2").owlCarousel({
            slideSpeed : 300,
            autoPlay : true,
            navigation : false,
            pagination : true,
            singleItem:true
        });
    });

</script>
</body>
</html>
