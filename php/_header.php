<?php


include_once('validateSesion.php');
include_once("consultaMenu.php");

 ?>

<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
<!-- remove or comment this line if you want to use the local fonts -->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
  <meta charset="utf-8" />
  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!-- Mobile viewport optimized: h5bp.com/viewport -->
  <meta name="viewport" content="width=device-width">

  <title></title>
 
   
   
 <link rel="stylesheet" href="../jqwidgets/styles/jqx.base.css" type="text/css">
 <link rel="stylesheet" href="../jqwidgets/styles/jqx.metro.css" type="text/css">
 <link rel="stylesheet" href="../jqwidgets/styles/jqx.bootstrap.css" type="text/css">
 <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/cupertino/jquery-ui.css" >

   
   
  <link rel="stylesheet" type="text/css" href="../bootmetro-0.6.0/content/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../bootmetro-0.6.0/content/css/bootmetro.css">
  <link rel="stylesheet" type="text/css" href="../bootmetro-0.6.0/content/css/bootmetro-tiles.css">
  <link rel="stylesheet" type="text/css" href="../bootmetro-0.6.0/content/css/bootmetro-charms.css">
  <link rel="stylesheet" type="text/css" href="../bootmetro-0.6.0/content/css/metro-ui-light.css">
  <link rel="stylesheet" type="text/css" href="../bootmetro-0.6.0/content/css/icomoon.css">
  <link href="../notify/css/bootstrap-notify.css" rel="stylesheet">
  <link rel="stylesheet" href="../styles/style.css" type="text/css">

  <script src="../bootmetro-0.6.0/scripts/modernizr-2.6.1.min.js"></script>


</head>

<body data-accent="blue">

  <div id="modalCerrarSesion" class="modal warning bg-color-blu hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-body">
      <p>Ha finalizado la sesi&oacute;n.</p>
    </div>
    <div class="modal-footer">
			<button type="button" id="btnGrabarIntegrante" data-dismiss="modal" onClick="showLogin();"  class="btn btnComun" >Cerrar</button>
    </div>
  </div>
   
  <div class="navbar navbar-fixed-top">
    <div class="navbar-inner" id="headerPrincipal">
      <div class="container">
		    <a id="tituloOpcion" class="brand" href="#"></a>
		    <ul class="nav">
          <li><a href="panelOperativo.php">Panel Operativo</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Clientes<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="clientes.php">Maestro</a></li>
              <li><a href="planesDeCobertura.php">Planes de Cobertura</a></li>
		          <li><a href="rubrosClientes.php">Rubros</a></li>
            </ul>
          </li>
		      <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">M&oacute;viles <b class="caret"></b></a>
            <ul class="dropdown-menu">
        			<li><a href="basesOperativas.php">Bases Operativas</a></li>
        			<li><a href="maestroMoviles.php">Maestro</a></li>
        			<li><a href="marcasModelos.php">Marcas y Modelos</a></li>
        			<li><a href="tipoMoviles.php">Tipo de M&oacute;viles</a></li>
        			<li><a href="maestroVehiculos.php">Veh&iacute;culos</a></li>
            </ul>
          </li>	  
        </ul>

	<div id="top-info" class="pull-right">
    <a href="#" class="pull-left">
      <div id="usrTop" class="top-info-block">
        <h3>Usuario</h3>
        <h4>Maxo</h4>
      </div>
      <div class="top-info-block">
        <b class="icon-user-5"></b>
      </div>
    </a>
    <hr class="separator pull-left"/>
    <a id="home" class="pull-left" href="#">
      <b class="icon-home-5"></b>
    </a>
    <hr class="separator pull-left"/>
    <a id="close" class="pull-left" href="#">
      <b class="icon-close"></b>
    </a>
  </div>
</div>
</div>
</div>