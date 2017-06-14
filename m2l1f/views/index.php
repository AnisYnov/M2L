<?php /*require_once"controller/connect.php"; */?>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/index.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
    <?php include('./header.php'); ?>
</head>
<body class="size-1140">
<!-- TOP NAV WITH LOGO -->
<section>

    <div class="span7">
        <div class="widget stacked widget-table action-table">

            <div class="widget-header">
                <i class="icon-th-list"></i>
                <h3 class="titre">Formations Inscrit</h3>
            </div> <!-- /widget-header -->

            <div class="widget-content">

                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Formations</th>
                        <th>Date</th>
                        <th>Duree</th>
                        <th>Coût</th>
                        <th>Nb_place</th>
                        <th>Contenu</th>
                        <th class="td-actions"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <?= formationValider($_SESSION['id_s']) ?>
                    </tr>

                    </tbody>
                </table>

            </div> <!-- /widget-content -->

        </div> <!-- /widget -->
    </div>
    <br />
    <br />

</section>
<section>

    <div class="span7">
        <div class="widget stacked widget-table action-table">

            <div class="widget-header">
                <i class="icon-th-list"></i>
                <h3 class="titre">Liste des formations disponible</h3>
            </div> <!-- /widget-header -->

            <div class="widget-content">

                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Formations</th>
                        <th>Date</th>
                        <th>Duree</th>
                        <th>Coût</th>
                        <th>Nb_place</th>
                        <th>Contenu</th>
                        <th>Choix</th>

                        <th class="td-actions"></th>
                    </tr>
                    </thead>
                    <tbody>
                            <a href="javascript:;" class="btn btn-small">
                                <i class="btn-icon-only icon-remove"></i>
                            </a>
                        </td>
                    </tr>
                    <?= formation() ?>
                    </tbody>
                </table>

            </div> <!-- /widget-content -->

        </div> <!-- /widget -->
    </div>
    <br />
    <br />

</section>
<!--<section>
            <div id="head">
                <div class="line">
                    <h1>Liste des Formations disponible</h1>
                </div>
            </div>
            <div class="container">
                <div class="row col-md-6 col-md-offset-2 custyle">
                    <table class="table table-striped custab">
                        <thead>
                            <tr>
                                <th>Formations</th>
                                <th>date</th>
                                <th>duree</th>
                                <th>cout</th>
                                <th>nb_place</th>
                                <th>contenu</th>
                                <th>choix</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php formation() ?>
                        </tbody>
                    </table>
                </div>
            </div>


        </section> -->
<!-- FOOTER -->

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
