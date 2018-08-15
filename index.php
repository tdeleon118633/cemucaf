<?php
require_once("core/config.php");
//require_once("template/config.php");
$boollogin = true;
//core_is_login();
if( $boollogin  ) {
    ?>
    
    <!DOCTYPE html>
     <html lang="esp">
          <head>
            <meta http-equiv="content-type" content="text/html; charset=iso-8859-1;" />
            <title>CEMUCAF</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="">
            <meta name="author" content="">
            <link href="css/bootstrap.css" rel="stylesheet"> 
            <link href="templates/default/styles.css" rel="stylesheet"> 
            <link href="css/bootstrap-responsive.css" rel="stylesheet">
            <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
            <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
            <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
            <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
            <link rel="shortcut icon" href="ico/favicon.png">
          </head>
          <body>
            <div class="container">
                <form name="form1" method="post" action="" class="form-signin">
                    <h2 class="form-signin-heading">CEMUCAF</h2>
                    <input type="text" name="usuario" class="input-block-level" placeholder="Usuario" autocomplete="off">
                    <input type="password" name="contra" class="input-block-level" placeholder="Contraseña" autocomplete="off">
                    <button class="btn btn-large btn-primary" type="submit">Iniciar</button>
                    <p>&nbsp;</p>
                    <?php
                            $act = "1";
                            if(!empty($_POST['usuario']) and !empty($_POST['contra'])){
                                $usuario = limpiar($_POST['usuario']);
                                $password = limpiar($_POST['contra']);
                                $password = md5($password);
                                $strQuery = "SELECT persona.persona,
                                                    usuario.bloqueado,
                                                    usuario.nombre,
                                                    usuario.usuario,
                                                    usuario.password,
                                                    usuario.tipo
                                             FROM   persona
                                                    INNER JOIN usuario
                                                        ON usuario.persona = persona.persona
                                             WHERE  usuario.usuario ='{$usuario}'  
                                             AND    usuario.password = '{$password}'";
                                $conn = mysql_query($strQuery);
                                if(!$dato=mysql_fetch_array($conn)){
                                    if( $act == "1"){
                                        echo '<div class="alert alert-error" align="center"><strong>Usuario y Contraseña Incorrecta</strong></div>';
                                    }else{
                                        $act = "0";
                                    }
                                }
                                else{
                                    if($dato['estado']=='n'){
                                        echo '<div class="alert alert-error" align="center"><strong>Consulte con el Administrador</strong></div>';
                                    }
                                }
                            }else{
                                
                            }
                        ?>
                </form>
            </div> <!-- /container -->

            <!-- Le javascript
            ================================================== -->
            <!-- Placed at the end of the document so the pages load faster -->
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

          </body>
    </html>
    <?php
    //session_destroy();
}
else{
    //Usuario no esta logeado
    print "no";
}