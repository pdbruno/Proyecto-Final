<!DOCTYPE html>
<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap Core CSS -->
        <link href="./vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="./vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- DataTables CSS -->
        <link href="./vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="./vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
        <link href="select.dataTables.min.css" rel="stylesheet">
        <link href="scroller.dataTables.min.css" rel="stylesheet">


        <!-- Custom CSS -->
        <link href="./dist/css/sb-admin-2.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="./vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <title>Hola</title>

        <script>

            function AgregarUsuario()
            {
                var x = document.getElementsByClassName("form-control-static");
                var y = document.getElementsByClassName("form-control");

                for (var i = 0; i < x.length; i++) {
                    x[i].style.display = 'none';

                }
                for (var i = 0; i < y.length; i++) {
                    y[i].style.display = 'block';
                    y[i].value="";


                }
                var z = document.getElementsByClassName("checkbox");
                for (var i = 0; i < z.length; i++) {
                    z[i].disabled = false;
                    z[i].style.display = 'block';
                }

                document.getElementById("BtnAgregar").style.display = 'none';
                document.getElementById("BtnModificar").style.display = 'none';
                document.getElementById("BtnEliminar").style.display = 'none';
            }
            function ModificarUsuario()
            {
                var x = document.getElementsByClassName("form-control-static");
                var y = document.getElementsByClassName("form-control");
                for (var i = 0; i < x.length; i++) {
                    x[i].style.display = 'none';

                }
                for (var i = 0; i < y.length; i++) {
                    y[i].style.display = 'block';

                }
                var z = document.getElementsByClassName("checkbox");
                for (var i = 0; i < z.length; i++) {
                    z[i].disabled = false;
                    z[i].style.display = 'block';
                }

                document.getElementById("BtnAgregar").style.display = 'none';
                document.getElementById("BtnModificar").style.display = 'none';
                document.getElementById("BtnEliminar").style.display = 'none';
            }
            function EnviarUsuario()
            {
                var x = document.getElementsByTagName("input");
                var vec = [];
                var z = document.getElementsByClassName("checkbox");
                for (var i = 0; i < z.length; i++) {
                    if (z[i].checked == true) {
                        z[i].value = 1;
                    } else {
                        z[i].value = 0;
                    }
                }
                for (var i = 0; i < x.length; i++) {
                    vec.push(x[i].value);
                }
                vec.shift();
                vec.shift();
                vec.unshift(document.getElementById("idClientes").value)
                var url = "AgregarModificarCliente.php";
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {arr: JSON.stringify(vec)},
                    success: function (respuesta)
                    {
                        var x = document.getElementsByClassName("form-control-static");
                        var y = document.getElementsByClassName("form-control");
                        for (var i = 0; i < x.length; i++) {
                            x[i].style.display = 'block';

                        }
                        for (var i = 0; i < y.length; i++) {
                            y[i].style.display = 'none';

                        }
                        var z = document.getElementsByClassName("checkbox");
                        for (var i = 0; i < z.length; i++) {
                            z[i].disabled = true;
                            z[i].style.display = 'none';
                        }

                        document.getElementById("BtnAgregar").style.display = 'inline-block';
                        document.getElementById("BtnModificar").style.display = 'none';
                        document.getElementById("BtnEliminar").style.display = 'none';
                        document.getElementById("BtnAceptar").style.display = 'none';
                        CrearTabla();
                    }
                });
            }
        </script>
    </head>
    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Sistema BBG</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 1</strong>
                                        <span class="pull-right text-muted">40% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 2</strong>
                                        <span class="pull-right text-muted">20% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            <span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 3</strong>
                                        <span class="pull-right text-muted">60% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 4</strong>
                                        <span class="pull-right text-muted">80% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="index.html"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Charts<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="flot.html">Flot Charts</a>
                                </li>
                                <li>
                                    <a href="morris.html">Morris.js Charts</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="tables.html"><i class="fa fa-table fa-fw"></i> Tables</a>
                        </li>
                        <li>
                            <a href="forms.html"><i class="fa fa-edit fa-fw"></i> Forms</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> UI Elements<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="panels-wells.html">Panels and Wells</a>
                                </li>
                                <li>
                                    <a href="buttons.html">Buttons</a>
                                </li>
                                <li>
                                    <a href="notifications.html">Notifications</a>
                                </li>
                                <li>
                                    <a href="typography.html">Typography</a>
                                </li>
                                <li>
                                    <a href="icons.html"> Icons</a>
                                </li>
                                <li>
                                    <a href="grid.html">Grid</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Second Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Second Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Third Level <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Sample Pages<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="blank.html">Blank Page</a>
                                </li>
                                <li>
                                    <a href="login.html">Login Page</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <div class="container-fluid">
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-6">				
                        <div class="panel panel-default">
                            <div class="panel-heading">Listado de Clientes
                            </div>
                            <div class="table-responsive col-sm-12">
                                <table  id="TablaClientes" class="table table-hover" cellspacing="0" width="100%"  >
                                    <thead>
                                        <tr>
                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                        </tr> 
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" >
                        <div class="panel panel-default" style="height: 850px; overflow-y: scroll;">
                            <ul class="list-group">
                                <form class="form-horizontal">
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Id:</label>
                                            <div class="col-sm-10">
                                                <p id="idClientes" class="form-control-static"></p>
                                                <input type="text" style="display: none;" class="form-control" id="idClientesForm" placeholder="Nombres" disabled>

                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-group">

                                            <label class="col-sm-2 control-label">Nombres:</label>
                                            <div class="col-sm-10">
                                                <p id="Nombres" class="form-control-static"></p>
                                                <input type="text" style="display: none;" class="form-control" id="NombresForm" placeholder="Nombres">
                                            </div>

                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Apellidos:</label>
                                            <div class="col-sm-10">
                                                <p id="Apellidos" class="form-control-static"></p>
                                                <input type="text" style="display: none;" class="form-control" id="ApellidosForm" placeholder="Apellidos">

                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Fecha de Nacimiento:</label>
                                            <div class="col-sm-10">
                                                <p id="FechaNacimiento" class="form-control-static"></p>
                                                <input type="date" style="display: none;" class="form-control" id="FechaNacimientoForm" placeholder="En formato aaaa-dd-mm">
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">DNI:</label>
                                            <div class="col-sm-10">
                                                <p id="DNI" class="form-control-static"></p>
                                                <input type="text" style="display: none;" class="form-control" id="DNIForm" placeholder="DNI">

                                            </div>
                                        </div>
                                    </li>

                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Domicilio:</label>
                                            <div class="col-sm-10">
                                                <p id="Domicilio" class="form-control-static"></p>
                                                <input type="text" style="display: none;" class="form-control" id="DomicilioForm" placeholder="Domicilio">

                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-group">

                                            <label class="col-sm-2 control-label">Localidad:</label>
                                            <div class="col-sm-10">
                                                <p id="IdLocalidades" class="form-control-static"></p>
                                                <select class="form-control"style="display: none;">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Código Postal:</label>
                                            <div class="col-sm-10">
                                                <p id="CPostal" class="form-control-static"></p>
                                                <input type="text" style="display: none;" class="form-control" id="CPostalForm" placeholder="Código Postal">
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Teléfono/</br>Celular:</label>
                                            <div class="col-sm-10">
                                                <p id="Tel-Cel" class="form-control-static"></p>
                                                <input type="tel" style="display: none;" class="form-control" id="Tel-CelForm" placeholder="Teléfono/Celular">

                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Ocupación:</label>
                                            <div class="col-sm-10">
                                                <p id="Ocupacion" class="form-control-static"></p>
                                                <input type="text" style="display: none;" class="form-control" id="OcupacionForm" placeholder="Ocupación">

                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">E-mail:</label>
                                            <div class="col-sm-10">
                                                <p id="Email" class="form-control-static"></p>
                                                <input type="text" style="display: none;" class="form-control" id="EmailForm" placeholder="E-mail">

                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Facebook:</label>
                                            <div class="col-sm-10">
                                                <p id="Facebook" class="form-control-static"></p>
                                                <input type="text" style="display: none;" class="form-control" id="FacebookForm" placeholder="Facebook">
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Autoriza su imagen en la web:</label>
                                            <div class="col-sm-10">
                                                <p class="intro" id="AutorizaWeb" hidden></p>
                                                <input type="checkbox"class="checkbox"style="display: none;" id="AutorizaWebForm" disabled>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Apto médico:</label>
                                            <div class="col-sm-10">
                                                <p class="intro" id="AptoMedico" hidden></p>
                                                <input type="checkbox" class="checkbox"style="display: none;"id="AptoMedicoForm" disabled>


                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Cobertura médica:</label>
                                            <div class="col-sm-10">
                                                <p id="CoberturaMedica" class="form-control-static"></p>
                                                <input type="text" style="display: none;" class="form-control" id="CoberturaMedicaForm" placeholder="Cobertura médica">
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Número de socio (Cobertura Médica):</label>
                                            <div class="col-sm-10">
                                                <p id="NumSocioMed" class="form-control-static"></p>
                                                <input type="text" style="display: none;" class="form-control" id="NumSocioMedForm" placeholder="Número de socio (Cobertura Médica)">
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Teléfono de emergencias:</label>
                                            <div class="col-sm-10">
                                                <p id="TelEmergencias" class="form-control-static"></p>
                                                <input type="tel" style="display: none;" class="form-control" id="TelEmergenciasForm" placeholder="Teléfono de emergencias">
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Grupo y factor sanguíneo:</label>
                                            <div class="col-sm-10">
                                                <p id="IdGrupoFactorSanguineo" class="form-control-static"></p>
                                                <select class="form-control"style="display: none;">
                                                    <option value="1">A+</option>
                                                    <option value="2">A-</option>
                                                    <option value="3">B+</option>
                                                    <option value="4">B-</option>
                                                    <option value="5">AB+</option>                                                    
                                                    <option value="6">AB-</option>
                                                    <option value="7">0+</option>
                                                    <option value="8">0-</option>

                                                </select>

                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Alergias:</label>
                                            <div class="col-sm-10">
                                                <p id="Alergia" class="form-control-static"></p>
                                                <input type="text" style="display: none;" class="form-control" id="AlergiaForm" placeholder="Alergias">
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">

                                        <div class="form-group">

                                            <label class="col-sm-2 control-label">Patologías:</label>
                                            <div class="col-sm-10">
                                                <p id="Patologia" class="form-control-static"></p>
                                                <input type="text" style="display: none;" class="form-control" id="PatologiaForm" placeholder="Patologías">
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Intervenciones quirúrgicas:</label>
                                            <div class="col-sm-10">
                                                <p id="IntQuirurgica" class="form-control-static"></p>
                                                <input type="text" style="display: none;" class="form-control" id="IntQuirurgicaForm" placeholder="Intervenciones quirúrgicas">

                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Lesiones:</label>
                                            <div class="col-sm-10">
                                                <p id="Lesion" class="form-control-static"></p>
                                                <input type="text" style="display: none;" class="form-control" id="LesionForm" placeholder="Lesiones">
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Medicación:</label>
                                            <div class="col-sm-10">
                                                <p id="Medicacion" class="form-control-static"></p>
                                                <input type="text" style="display: none;" class="form-control" id="MedicacionForm" placeholder="Medicación">
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Observaciones:</label>
                                            <div class="col-sm-10">
                                                <p id="Observaciones" class="form-control-static"></p>
                                                <input type="text" style="display: none;" class="form-control" id="ObservacionesForm" placeholder="Observaciones">
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Padre/Madre/Tutor:</label>
                                            <div class="col-sm-10">
                                                <p id="PadMadTut" class="form-control-static"></p>
                                                <input type="text" style="display: none;" class="form-control" id="PadMadTutForm" placeholder="Padre/Madre/Tutor">
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Teléfono Padre/Madre/Tutor:</label>
                                            <div class="col-sm-10">
                                                <p id="TelPadMadTut" class="form-control-static"></p>
                                                <input type="text" style="display: none;" class="form-control" id="TelPadMadTutForm" placeholder="Teléfono Padre/Madre/Tutor">
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Celular Padre/Madre/Tutor:</label>
                                            <div class="col-sm-10">
                                                <p id="CelPadMadTut" class="form-control-static"></p>
                                                <input type="text" style="display: none;" class="form-control" id="CelPadMadTutForm" placeholder="Celular Padre/Madre/Tutor">
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">E-mail Padre/Madre/Tutor:</label>
                                            <div class="col-sm-10">
                                                <p id="EmailPadMadTut" class="form-control-static"></p>
                                                <input type="email" style="display: none;" class="form-control" id="CelPadMadTutForm" placeholder="Celular Padre/Madre/Tutor">
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Se va solo:</label>
                                            <div class="col-sm-10">

                                                <p class="intro" id="SeVaSolo" hidden></p>
                                                <input type="checkbox" class="checkbox"style="display: none;"id="SeVaSoloForm" disabled>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Autorizado a retirar 1:</label>
                                            <div class="col-sm-10">
                                                <p id="Retirar1NomAp" class="form-control-static"></p>
                                                <input type="text" style="display: none;" class="form-control" id="Retirar1NomApForm" placeholder="Autorizado a retirar 1">
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Autorizado a retirar 1 DNI:</label>
                                            <div class="col-sm-10">
                                                <p id="Retirar1DNI" class="form-control-static"></p>
                                                <input type="text" style="display: none;" class="form-control" id="Retirar1DNIForm" placeholder="Autorizado a retirar 1 DNI">
                                            </div>
                                        </div>
                                    </li>

                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Autorizado a retirar 2:</label>
                                            <div class="col-sm-10">
                                                <p id="Retirar2NomAp" class="form-control-static"></p>
                                                <input type="text" style="display: none;" class="form-control" id="Retirar2NomApForm" placeholder="Autorizado a retirar 2">
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Autorizado a retirar 2 DNI:</label>
                                            <div class="col-sm-10">
                                                <p id="Retirar2DNI" class="form-control-static"></p>
                                                <input type="text" style="display: none;" class="form-control" id="Retirar2DNIForm" placeholder="Autorizado a retirar 2 DNI">
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Autorizado a retirar 3:</label>
                                            <div class="col-sm-10">
                                                <p id="Retirar3NomAp" class="form-control-static"></p>
                                                <input type="text" style="display: none;" class="form-control" id="Retirar3NomApForm" placeholder="Autorizado a retirar 3">
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Autorizado a retirar 3 DNI:</label>
                                            <div class="col-sm-10">
                                                <p id="Retirar3DNI" class="form-control-static"></p>
                                                <input type="text" style="display: none;" class="form-control" id="Retirar3DNIForm" placeholder="Autorizado a retirar 3 DNI">
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Está activo:</label>
                                            <div class="col-sm-10">
                                                <p class="intro" id="Activo" hidden></p>

                                                <input type="checkbox"class="checkbox" style="display: none;"id="ActivoForm" disabled>

                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Es instructor:</label>
                                            <div class="col-sm-10">
                                                <p class="intro" id="EsInstructor" hidden></p>
                                                <input type="checkbox"class="checkbox"style="display: none;" id="EsInstructorForm" disabled>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Categoría:</label>
                                            <div class="col-sm-10">
                                                <p id="IdCategorias" class="form-control-static"></p>
                                                <select class="form-control"style="display: none;">
                                                    <option value="1">Blanco</option>
                                                    <option value="2">Blanco punta amarilla</option>
                                                    <option value="3">Amarillo</option>
                                                    <option value="4">Amarillo punta verde</option>
                                                    <option value="5">Verde</option>                                                    
                                                    <option value="6">Verde punta azul</option>
                                                    <option value="7">Azul</option>
                                                    <option value="8">Azul punta roja</option>
                                                    <option value="9">Rojo</option>
                                                    <option value="10">Rojo punta negra</option>
                                                    <option value="11">1er Dan</option>
                                                    <option value="12">2do Dan</option>
                                                    <option value="13">3er Dan</option>
                                                    <option value="14">4to Dan</option>
                                                    <option value="15">5to Dan</option>
                                                    <option value="16">6to Dan</option>

                                                </select>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Actividades:</label>
                                            <div class="col-sm-10">
                                                <p id="IdActividades" class="form-control-static"></p>
                                                <select class="form-control" style="display: none;">
                                                    <option value="1">Taekwon-Do</option>
                                                    <option value="2">Funcional</option>
                                                    <option value="3">Personalizado</option>
                                                    <option value="4">Taekwon-Do y Funcional</option>
                                                    <option value="5">Taekwon-Do y Personalizado</option>
                                                    <option value="6">Funcional y Personalizado</option>
                                                    <option value="7">Taekwon-Do, Funcional y Personalizado</option>
                                                </select>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Sede:</label>
                                            <div class="col-sm-10">
                                                <p id="IdSedes" class="form-control-static"></p>
                                                <select class="form-control" style="display: none;">
                                                    <option value="1">Sede Central</option>
                                                    <option value="2">Sede CIPAE</option>
                                                    <option value="3">Escuela Miguel Hernández</option>
                                                    <option value="4">Sede Adrenaline</option>
                                                    <option value="5">Colegio Integral Caballito</option>
                                                </select>
                                            </div>
                                        </div>
                                    </li>

                                </form>
                            </ul>
                        </div>
                        <button type="button" id="BtnAgregar" onclick="AgregarUsuario()" class="btn btn-default">Agregar Usuario</button>
                        <button type="button" id="BtnModificar"onclick="ModificarUsuario()" class="btn btn-primary">Modificar Usuario</button>
                        <button type="button" id="BtnAceptar" onclick="EnviarUsuario()" class="btn btn-success">Aceptar</button>
                        <button type="button" id="BtnEliminar"id="BtnAgregar"onclick="EliminarUsuario()" class="btn btn-danger">Eliminar Usuario</button>
                    </div>

                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="./vendor/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="./vendor/metisMenu/metisMenu.min.js"></script>

        <!-- DataTables JavaScript -->
        <script src="./vendor/datatables/js/jquery.dataTables.min.js"></script>
        <script src="./vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
        <script src="./vendor/datatables-responsive/dataTables.responsive.js"></script>
        <script src="dataTables.select.min.js"></script>
        <script src="dataTables.scroller.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="./dist/js/sb-admin-2.js"></script>

        <script>
                            document.getElementById("BtnModificar").style.display = 'none';
                            document.getElementById("BtnEliminar").style.display = 'none';
                            document.getElementById("BtnAceptar").style.display = 'none';
                            var VecClientes = [];

                            $(document).ready(function CrearTabla() {
                                listadoclientes();
                            });

                            var listadoclientes = function ()
                            {
                                var table = $("#TablaClientes").DataTable(
                                        {
                                            "ajax":
                                                    {
                                                        "method": "POST",
                                                        "url": "listadoclientes.php",
                                                        "dataSrc": function (txt)
                                                        {

                                                            for (i in txt)
                                                            {

                                                                var Cliente =
                                                                        {
                                                                            idClientes: txt[i].idClientes,
                                                                            Nombres: txt[i].Nombres,
                                                                            Apellidos: txt[i].Apellidos,
                                                                        };


                                                                VecClientes.push(Cliente);
                                                            }
                                                            return VecClientes;
                                                        }
                                                    },
                                            "columns": [
                                                {data: "Nombres"},
                                                {data: "Apellidos"}
                                            ],
                                            select: {
                                                style: 'single'
                                            }
//                        "language": {
//                        "url": "dataTables.spanish.lang"
//                          Hacer algo con el idioma de la tabla y de la extension select

                                        });
                                table.on('select', function (e, dt, type, indexes) {
                                    if (type === 'row') {
                                        var id = VecClientes[indexes].idClientes;
                                        var url = "traercliente.php";
                                        $.ajax({
                                            type: "POST",
                                            url: url,
                                            data: "data=" + id,
                                            success: function (respuesta)
                                            {
                                                var obj = JSON.parse(respuesta)[0];
                                                for (x in obj) {
                                                    document.getElementById(x).innerHTML = obj[x];
                                                    document.getElementById(x + 'Form').value = ''+obj[x];

                                                }
                                                var y = document.getElementsByClassName("checkbox");
                                                var z = document.getElementsByClassName("intro");
                                                for (i = 0; i < y.length; i++) {
                                                    y[i].style.display = 'block';
                                                    if (z[i].innerHTML == 1) {
                                                        y[i].checked = true;

                                                    } else {
                                                        y[i].checked = false;
                                                    }
                                                }

                                                document.getElementById("BtnModificar").style.display = 'inline-block';
                                                document.getElementById("BtnEliminar").style.display = 'inline-block';


                                            }
                                        });
                                    }
                                });
                            }

        </script>
        <script>

        </script>

    </body>
</html>
