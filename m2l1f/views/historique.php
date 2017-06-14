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
         <link rel="stylesheet" href="../css/index.css">
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
					<h3 class="titre">historique des Formations</h3>
				</div> <!-- /widget-header -->
				
				<div class="widget-content">
					
					<table class="table table-striped table-bordered">
						<thead>
							<tr> 
                               <th>Formations</th>
                                <th>date</th>
                                <th>duree</th>
                                <th>cout</th>
                                <th>nb_place</th>
                                <th>contenu</th>
                                <th>choix</th>
								    
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
							  <?php formationHistorique($_SESSION['id_s']) ?>
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
                    <h1>historique des Formations</h1>
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
                        <?php formationHistorique($_SESSION['id_s']) ?>
                      </tbody>
                    </table>
                </div>
            </div>
-->

        </section>
