<?php
/*************************************************************
    Developer: Tito De León
    Tel:        5430-6466
    Correo:     compuaserv@gmail.com, tito_de_leon@hotmail.com
*************************************************************/
    
    function fntHeader($titulo){
        $titulo= $titulo;
        $intPersona = $_SESSION["persona"];
        ?>
        <html lang="en">
            <head>
                <meta http-equiv="content-type" content="text/html;" charset="ISO-8859-1" />
                <title>-CEMUCAF-</title>
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta name="description" content="">
                <meta name="author" content="">
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
                
                <!--<script src="libraries/jquery/jquery.js" type="text/javascript"></script>
                <script src="libraries/jquery/jquery.min.js" type="text/javascript"></script>-->
                <script src="libraries/boostrap/vendor/bootstrap/js/bootstrap.min.js"></script>
                <script src="libraries/boostrap/vendor/jquery/jquery.min.js"></script>
                
                
                <!--<link href="libraries/jquery/ui/jquery.ui.min.css" rel="stylesheet">
                <link href="libraries/jquery/ui/jquery.ui.multiselect.min.css" rel="stylesheet">
                <link href="libraries/jquery/ui/jquery.ui.combobox.min.css" rel="stylesheet">
                <link href="libraries/jquery/ui/jquery.ui.timepicker.min.css" rel="stylesheet">
                
                
                <script src="libraries/jquery/ui/jquery.ui.min.js" type="text/javascript"></script>
                <script src="libraries/jquery/ui/jquery.ui.multiselect.min.js" type="text/javascript"></script>
                <script src="libraries/jquery/ui/jquery.ui.combobox.min.js" type="text/javascript" ></script>
                <script src="libraries/jquery/ui/jquery.ui.timepicker.min.js" type="text/javascript"></script>-->
                
                <link href="libraries/jquery/ui/jquery-ui.css" rel="stylesheet">
                <script src="libraries/jquery/ui/jquery-ui.js" type="text/javascript"></script>
                
                
                
                <!--<script src="libraries/boostrap/vendor/jquery/jquery.min.js"></script> -->
                <script src="libraries/boostrap/vendor/bootstrap/js/bootstrap.min.js"></script>
                <script src="libraries/boostrap/vendor/metisMenu/metisMenu.min.js"></script>
                <script src="libraries/boostrap/vendor/raphael/raphael.min.js"></script>
                <script src="libraries/boostrap/vendor/morrisjs/morris.min.js"></script>
                <script src="libraries/boostrap/data/morris-data.js"></script>
                <script src="libraries/boostrap/dist/js/sb-admin-2.js"></script>
                
                 
               
                
                <script src="core/core.js" type="text/javascript"></script>
            </head>
            <body>
                <!-- Navigation -->
                <div id="wrapper">
                    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color: #149dee">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="Administrador.php"><?php echo $titulo; ?></a>
                        </div>
                        <!-- /.navbar-header -->
                        <ul class="nav navbar-top-links navbar-right">
                            
                           
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
                                    <li><a href="adm_usuarios.php?persona=<?php print md5($intPersona); ?>"><i class="fa fa-user fa-fw"></i> Perfil de Usuario</a>
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
                                            <input type="text" class="form-control" placeholder="Search...">
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
                                                        <a href="adm_pefiles_acceso.php" ></i>Perfiles</a>
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
                        <!-- /.navbar-static-side -->
                    </nav>
                    <div id="page-wrapper">
        <?php
    }   
    
    
    function fntBody(){
        ?>
                
                    </div> 
                        <nav class="navbar navbar-default navbar-fixed-bottom" role="navigation" style="margin-bottom: 0; padding-bottom: 0;">
                            <div class="row">
                                <div class="col-lg-6 col-lg-offset-3">
                                    <div id="divAlert"></div>
                                </div>
                            </div>
                        </nav>    
                </div>
                <!-- /#wrapper -->

                
            </body>
        </html>  
       <?php
    }
    

    //fntHeader();
   // fntBody();
?>
 