<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
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
                <a class="navbar-brand" href="index.html">SB Admin v2.0</a>
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
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <ul class="list-group">
                                <li class="list-group-item">Nombres: </li>
                                <li class="list-group-item">Apellidos: </li>
                                <li class="list-group-item">Fecha de Nacimiento: </li>
                                <li class="list-group-item">DNI: </li>
                                <li class="list-group-item">Domicilio: </li>
                                <li class="list-group-item">Localidad: </li>
                                <li class="list-group-item">Código Postal: </li>
                                <li class="list-group-item">Domicilio: </li>
                                <li class="list-group-item">Teléfono/Celular: </li>
                                <li class="list-group-item">Ocupación: </li>
                                <li class="list-group-item">E-mail: </li>
                                <li class="list-group-item">Facebook: </li>
                                <li class="list-group-item">Autoriza su imagen en la web: </li>
                                <li class="list-group-item">Apto médico: </li>
                                <li class="list-group-item">Cobertura médica: </li>
                                <li class="list-group-item">Número de socio (Cobertura Médica): </li>
                                <li class="list-group-item">Teléfono de emergencias: </li>
                                <li class="list-group-item">Grupo y factor sanguíneo: </li>
                                <li class="list-group-item">Alergias: </li>
                                <li class="list-group-item">Patologías: </li>
                                <li class="list-group-item">Intervenciones quirúrgicas: </li>
                                <li class="list-group-item">Lesiones: </li>
                                <li class="list-group-item">Medicación: </li>
                                <li class="list-group-item">Observaciones: </li>
                                <li class="list-group-item">Padre/Madre/Tutor: </li>
                                <li class="list-group-item">Celular Padre/Madre/Tutor: </li>
                                <li class="list-group-item">Teléfono Padre/Madre/Tutor: </li>
                                <li class="list-group-item">E-mail Padre/Madre/Tutor: </li>
                                <li class="list-group-item">Se va solo: </li>
                                <li class="list-group-item">Autorizado a retirar 1: </li>
                                <li class="list-group-item">Autorizado a retirar 1 DNI: </li>
                                <li class="list-group-item">Autorizado a retirar 2: </li>
                                <li class="list-group-item">Autorizado a retirar 2 DNI: </li>
                                <li class="list-group-item">Autorizado a retirar 3: </li>
                                <li class="list-group-item">Autorizado a retirar 3 DNI: </li>
                                <li class="list-group-item">Está activo: </li>
                                <li class="list-group-item">Es instructor: </li>
                                <li class="list-group-item">Categoría: </li>
                                <li class="list-group-item">Actividades: </li>
                                <li class="list-group-item">Sede: </li>
                                <p id="demo">cc</p>

                            </ul>
                        </div>
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
            $(document).ready(function () {
                listadoclientes();
            });
            var listadoclientes = function ()
            {
                var table = $("#TablaClientes").DataTable(
                        {
                            "ajax": {
                                "method": "POST",
                                "url": "listadoclientes.php"
                            },
                            "columns": [
                                {"data": "Nombres"},
                                {"data": "Apellidos"},
                            ],

                            select: {
                                style: 'single'
                            },

//                        "language": {
//                        "url": "dataTables.spanish.lang"
//                          Hacer algo con el idioma de la tabla y de la extension select
//                        }
                        });
                table.on('select', function (e, dt, type, indexes) {
                    if (type === 'row') {
                        var id = table.row({selected: true}).index();
						alert (id);
						var url = "traercliente.php";
								$.ajax({                        
								   type: "POST",                 
								   url: url,                     
								   data: "data="+id, 
								   success: function(respuesta)             
								   {
									 $('#demo').html(respuesta);               
								   }
							   });
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						/* alert(data);
                        var dbParam, xmlhttp, myObj, x, txt = ""; 
                        xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function () {
                            if (this.readyState == 4 && this.status == 200) {
                                myObj = JSON.parse(this.responseText);
                                for (x in myObj) {
                                    txt += myObj[x].name + "<br>";
                                }
                                document.getElementById("demo").innerHTML = txt;
                            }
                        };
                        xmlhttp.open("POST", "traercliente.php", true);
                        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xmlhttp.send(data); */
                    }
                });
            }

        </script>
        <script>

        </script>

    </body>
</html>
