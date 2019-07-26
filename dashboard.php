<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1;" />
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
        
        <script src="libraries/jssor/slider/js/jssor.core.js" type="text/javascript"></script>
        <script src="libraries/jssor/slider/js/jssor.slider.js" type="text/javascript"></script>
        <script src="libraries/jssor/slider/js/jssor.utils.js" type="text/javascript"></script>
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
                    <a class="navbar-brand" href="index.html">
                        <?php echo $titulo; ?>
                    </a>
                </div>
                
                <!-- /.navbar-header -->
                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="php_cerrar.php"><i class="fa fa-sign-out fa-fw"></i> Tengo cuenta</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
                
                <!-- /.navbar-top-links -->

               
            
            </nav>
            <div>
                <?php 
                    require_once("core/dashboard_function.php");
                    include_once('core/php_conexion.php'); 
                    drawSliderNoticias();
                ?>
            </div>
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