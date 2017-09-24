<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap Core CSS -->
  <link href="<?php echo URL; ?>views/recursos/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- MetisMenu CSS -->
  <link href="<?php echo URL; ?>views/recursos/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="<?php echo URL; ?>views/recursos/dist/css/sb-admin-2.min.css" rel="stylesheet">
  <!-- Custom Fonts -->
  <link href="<?php echo URL; ?>views/recursos/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- jQuery -->
  <script src="<?php echo URL; ?>views/recursos/vendor/jquery/jquery.min.js"></script>
  <!-- Bootstrap Core JavaScript -->
  <script src="<?php echo URL; ?>views/recursos/vendor/bootstrap/js/bootstrap.min.js"></script>


  <title>Hola</title>
</head>
<body>
  <div id="wrapper" style="height: 100vh;">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo URL; ?>">Sistema BBG</a>
      </div>
      <!-- /.navbar-header -->
      <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
          <ul class="nav" id="side-menu">
            <li>
              <a href="<?php echo URL; ?>cliente"><i class="fa fa-users fa-fw"></i> Clientes</a>
            </li>
            <li>
              <a href="#"><i class="fa fa-gears fa-fw"></i> Manejo Secundario<span class="fa arrow"></span></a>
              <ul class="nav nav-second-level">
                <li>
                  <a href="<?php echo URL; ?>help/index/Sedes"><i class="fa fa-building-o fa-fw"></i> Sedes</a>
                </li>
                <li>
                  <a href="<?php echo URL; ?>help/index/Localidades"><i class="fa fa-map fa-fw"></i> Localidades</a>
                </li>
                <li>
                  <a href="<?php echo URL; ?>help/index/Distribuidores"><i class="fa fa-truck fa-fw"></i> Distribuidores</a>
                </li>
                <li>
                  <a href="<?php echo URL; ?>help/index/Modalidades"><i class="fa fa-clock-o fa-fw"></i> Modalidades</a>
                </li>
                <li>
                  <a href="<?php echo URL; ?>help/index/FuentesDeEgresos"><i class="fa fa-sign-out fa-fw"></i> Fuentes De Egresos</a>
                </li>
                <li>
                  <a href="<?php echo URL; ?>cobro/aranceles"><i class="fa fa-usd fa-fw"></i> Aranceles</a>
                </li>
                <li>
                  <a href="<?php echo URL; ?>cobro/sueldos"><i class="fa fa-bank fa-fw"></i> Sueldos</a>
                </li>
              </ul>
              <!-- /.nav-second-level -->
            </li>
            <li>
              <a href="<?php echo URL; ?>producto/"><i class="fa fa-dropbox fa-fw"></i> Productos</a>
            </li>
            <li>
              <a href="#"><i class="fa fa-exchange fa-fw"></i> Stock<span class="fa arrow"></span></a>
              <ul class="nav nav-second-level">
                <li>
                  <a href="<?php echo URL; ?>producto/ingresostock"><i class="fa fa-arrow-down fa-fw"></i> Comprar Stock</a>
                </li>
                <li>
                  <a href="<?php echo URL; ?>producto/egresostock"><i class="fa fa-arrow-up fa-fw"></i> Vender Stock</a>
                </li>
              </ul>
              <!-- /.nav-second-level -->
            </li>
            <li>
              <a href="<?php echo URL; ?>actividad/tomarlista/"><i class="fa fa-check-square-o fa-fw"></i> Tomar Lista</a>
            </li>
            <li>
              <a href="<?php echo URL; ?>actividad/calendario/"><i class="fa fa-calendar fa-fw"></i> Calendario</a>
            </li>
            <li>
              <a href="<?php echo URL; ?>actividad/"><i class="fa fa-futbol-o fa-fw"></i> Actividades</a>
            </li>
            <li>
              <a href="<?php echo URL; ?>cobro/"><i class="fa fa-money fa-fw"></i> Cobro</a>
            </li>
            <li>
              <a href="<?php echo URL; ?>cobro/pagosueldos"><i class="fa fa-money fa-fw"></i> Pago de Sueldos</a>
            </li>
            <li>
              <a href="<?php echo URL; ?>help/index/Fondos"><i class="fa fa-line-chart fa-fw"></i> Fondos</a>
            </li>
            <li>
              <a href="<?php echo URL; ?>help/tablas/"><i class="fa fa-magic fa-fw"></i> Backoffice</a>
            </li>
            <li>
              <a href="<?php echo URL; ?>cobro/egresos/"><i class="fa fa-sign-out fa-fw"></i> Egresos</a>
            </li>
          </ul>
        </div>
        <!-- /.sidebar-collapse -->
      </div>
      <!-- /.navbar-static-side -->
    </nav>
    <div id="page-wrapper" style="height: 92vh">
