<?php  
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

$usuario = limpiar($_SESSION['username']);
$strQuery = "SELECT * FROM usuario WHERE usuario = '$usuario'";
        
$sqll = mysql_query($strQuery);
if($dato=mysql_fetch_array($sqll)){
    $nombre = $dato['nombre'];
    $palabra = explode(" ", $nombre);
    $nomb = $palabra[0];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1;" />
    <title><?php echo $titulo; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="css/bootstrap.css" rel="stylesheet">
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
    <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="ico/favicon.png">

<meta http-equiv="content-type" content="text/html; charset=iso-8859-1;" />
<style type="text/css">
body {
	background-color: #FFF;
	-- background-image: url(img/fondoP.png);
}
</style>
</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar">
<div align="center">
    <table width="98%" border="0">
      <tr>
        <td>
        <div id="navbar-example" class="navbar navbar-static">
          <div class="navbar-inner">
            <div class="container" style="width: auto;">
              <a class="brand" href="inicio.php" target="admin"><?php echo $titulo; ?></a>
              <ul class="nav" role="navigation">
                <li class="dropdown">
                  <a id="drop1" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Registros <b class="caret"></b></a>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="alumnos.php" target="admin"><i class="icon-user"></i> Alumnos</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="salones.php" target="admin"><i class="icon-folder-open"></i> Salones</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="pagos.php" target="admin"><i class="icon-list"></i> Registrar Pagos</a></li>
                    <!--<li role="presentation" class="divider"></li>-->  
                  </ul>
                </li>
                <!--
                <li class="dropdown">
                  <a href="#" id="drop2" role="button" class="dropdown-toggle" data-toggle="dropdown">Caja<b class="caret"></b></a>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="drop2">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="contable.php" target="admin">Entrada y Salida de Dinero</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="cierre_caja.php" target="admin">Cierre de Caja</a></li>
                    <li role="presentation" class="divider"></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="detalle.php?fecha=" target="admin">Detalle de Efectivo</a></li>
                    <li role="presentation" class="divider"></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="crear_usu.php" target="admin">Registrar Cajeros</a></li>
                    <li role="presentation" class="divider"></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="compras.php" target="admin">Compras</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="listado_compras.php" target="admin">Listado Compras</a></li>
                    <!-- <li role="presentation" class="divider"></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="conceptos.php" target="admin">Administrar Conceptos</a></li>
                  </ul>
                </li>
                -->
                <li class="dropdown">
                  <a href="#" id="drop2" role="button" class="dropdown-toggle" data-toggle="dropdown">Reportes <b class="caret"></b></a>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="drop2">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="r_alumnos.php" target="admin"><i class="icon-th-list"></i> 
                    Listado de Alumnos</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="reporte_pagos.php" target="admin"><i class="icon-th-list"></i> 
                    Reportes de Pago - Alumnos</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="reporte_pagos2.php" target="admin"><i class="icon-th-list"></i> 
                    Reportes de Pago - Conceptos</a></li>
                  </ul>
                </li>
              </ul>
              <ul class="nav pull-right">
                <li id="fat-menu" class="dropdown">
                  <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> Hola! <?php echo $nomb; ?> <b class="caret"></b></a>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="bd.php" target="admin"><i class="icon-refresh"></i> Iniciar BD</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="usuarios.php" target="admin"><i class="icon-user"></i> Crear Usuarios</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="cambiar_clave.php" target="admin"><i class="icon-refresh"></i> Cambiar Contraseña</a></li>
                    <li role="presentation" class="divider"></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="php_cerrar.php"><i class="icon-off"></i> Salir</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </div>
        </td>
      </tr>
      <tr>
        <td><iframe src="inicio.php" frameborder="0" scrolling="yes" name="admin" width="100%" height="500"></iframe></td>
      </tr>
    </table>
</div>
</body>
</html>