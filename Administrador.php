<?php
/*************************************************************
    Developer: Tito De León
    Tel:        5430-6466
    Correo:     compuaserv@gmail.com, tito_de_leon@hotmail.com
*************************************************************/
session_start();
include('core/php_conexion.php'); 
              
if($_SESSION['tipo_usu'] == 'admin' or $_SESSION['tipo_usu'] == 'normal'){

}
else{
    header('location:error.php');
}
if($_SESSION['tipo_usu'] == 'admin'){
    $titulo='Administrador';
}
else{
    $titulo='Usuario';
}
//$titulo='Centros Municipales de ';
$usuario = limpiar($_SESSION['username']);
$strQuery = "SELECT * FROM usuario WHERE usuario = '$usuario'";
        
$sqll = mysql_query($strQuery);
if($dato=mysql_fetch_array($sqll)){
    $nombre = $dato['nombre'];
    $palabra = explode(" ", $nombre);
    $nomb = $palabra[0];
}

$intPersona = $_SESSION["persona"];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1;" />
        <title>-CEMUCAF-</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!--<link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-responsive.css" rel="stylesheet">
        <link href="css/docs.css" rel="stylesheet">
        <link href="js/google-code-prettify/prettify.css" rel="stylesheet">
        <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
            <script src="js/jquery.js"></script>
        <script src="js/bootstrap-transition.js"></script>
        <script src="js/bootstrap-alert.js"></script>
        <script src="js/bootstrap-modal.js"></script>
        <script src="js/bootstrap-dropdown.js"></script>
        <script src="js/bootstrap-scrollspy.js"></script>
        <script src="js/bootstrap-tab.js"></script>
        <script src="js/bootstrap-tooltip.js"></script>
        <script src="js/bootstrap-popover.js"></script>
        <script src="js/bootstrap-button.js"></script>
        <script src="js/bootstrap-collapse.js"></script>
        <script src="js/bootstrap-carousel.js"></script>
        <script src="js/bootstrap-typeahead.js"></script>
        <script src="js/bootstrap-affix.js"></script>
        <script src="js/holder/holder.js"></script>
        <script src="js/google-code-prettify/prettify.js"></script>
        <script src="js/application.js"></script>
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">-->
        
        <link href="libraries/boostrap/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="libraries/boostrap/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="libraries/boostrap/dist/css/sb-admin-2.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="libraries/boostrap/vendor/morrisjs/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="libraries/boostrap/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link rel="shortcut icon" href="ico/favicon.png">

        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1;" />
        <style type="text/css">
        body {
                background-color: #FFF;
                background-image: url(img/fondoP.png);
        }
        </style>
    </head>
    <body>
        <!-- Navigation -->
        <div id="wrapper">
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; margin-bottom: 0; background-color: #149dee ">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="Administrador.php">
                        <?php echo $titulo; ?>
                    </a>
                </div>
                
                <!-- /.navbar-header -->
                <ul class="nav navbar-top-links navbar-right">
                    
                    <!-- /.dropdown-messages
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
                        
                    </li>
                    -->
                    
                    <!-- /.dropdown -->
                    <!--<li class="dropdown">
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
                    </li>-->
                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li style="display: <?php print $titulo == "Usuario" ? "none" : ""  ?>;" ><a href="adm_usuarios.php?persona=<?php print md5($intPersona); ?>"><i class="fa fa-user fa-fw"></i> Perfil de Usuario</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="php_cerrar.php"><i class="fa fa-sign-out fa-fw"></i> Cerrar la sesi&oacute;n</a>
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
                            <!--<li class="sidebar-search">
                                <div class="input-group custom-search-form">
                                    <input type="text" class="form-control" placeholder="Buscar...">
                                    <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                                </div> 
                            </li>-->
                            <li>
                                <a href="Administrador.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                            </li>
                            <li style="display: <?php print $titulo == "Usuario" ? "none" : ""  ?>;" >
                                <a href="#" ><i class="fa fa-users fa-fw"></i>Usuarios<span class="fa arrow"></span>
                                </a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="#">Administracion <span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            <!--<li>
                                                <a href="adm_usuarios.php" ></i>Perfiles</a>
                                            </li>-->
                                            <li>
                                                <a href="adm_usuarios.php" >Usuarios</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="#" ><i class="fa fa-cogs fa-fw"></i>Configuracion<span class="fa arrow"></span>
                                </a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="#">Configuraci&oacute;n acad&eacute;mica <span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            <li>
                                                <a href="configuracion_etnias.php" >Etnia</a>
                                            </li>
                                            <li>
                                                <a href="configuracion_departamentos.php" >Departamento</a>
                                            </li>
                                            <li>
                                                <a href="configuracion_municipios.php" >Municipio</a>
                                            </li>
                                           <!--<li>
                                                <a href="configuracion_carga_masiva.php" >Carga Masiva</a>
                                            </li>-->
                                            <li>
                                                <a href="configuracion_alumnos.php" ></i>Alumno</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                             <li>
                                <a href="#" ><i class="glyphicon glyphicon-book"></i>Cursos<span class="fa arrow"></span>
                                </a>
                                <ul class="nav nav-second-level">
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="curso_cursos.php" >Cursos</a>
                                        </li>
                                    </ul>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="glyphicon glyphicon-list-alt"></i> Asignacion<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="asignacion_asignar.php">Asignar</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-line-chart"></i> Reportes<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="reporte_alumnos.php">Alumnos</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
            
            </nav>
        </div>
    </body>
     <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="libraries/boostrap/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="libraries/boostrap/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="libraries/boostrap/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="libraries/boostrap/vendor/raphael/raphael.min.js"></script>
    <script src="libraries/boostrap/vendor/morrisjs/morris.min.js"></script>
    <script src="libraries/boostrap/data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="libraries/boostrap/dist/js/sb-admin-2.js"></script>
</html>