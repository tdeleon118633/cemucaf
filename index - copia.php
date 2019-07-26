<?php
/*************************************************************
    Developer: Tito De León
    Tel:        5430-6466
    Correo:     compuaserv@gmail.com, tito_de_leon@hotmail.com
*************************************************************/
require_once("core/config.php");
//require_once("template/config.php");
$boollogin = true;
//core_is_login();
if( $boollogin  ) {
    ?>
    
    <!DOCTYPE html>
     <html lang="esp">
          <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="description" content="">
            <meta name="author" content="">
            <title>-CEMUCAF-</title>
            
            <link href="libraries/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
            <link href="libraries/boostrap/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
            <link href="libraries/boostrap/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
            <link href="libraries/boostrap/dist/css/sb-admin-2.css" rel="stylesheet">
            <link href="libraries/boostrap/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
          </head>
          <body style="background-color: #149dee" >
              <div class="container" >
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <!--<h3 class="panel-title">Please</h3>-->
                            <img src="images/cemucaf.jpeg" class="img-thumbnail" alt="Responsive image">
                        </div>
                        <div class="panel-body">
                            <form name="form1" method="post" action="" class="form-signin">
                                <fieldset>
                                <!--<h2 class="form-signin-heading">
                                    CEMUCAF
                                </h2>-->
                                <!--<img src="images/cemucaf.jpeg" class="img-fluid" alt="Responsive image">-->
                                <div class="form-group">
                                    <input class="form-control" type="text" name="usuario" placeholder="Usuario" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="password" name="contra" class="input-block-level" placeholder="Contrase&ntilde;a" autocomplete="off">
                                </div>
                                <div class="checkbox">
                                    <!--<label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>-->
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <!--<a href="index.html" class="btn btn-lg btn-success btn-block">Login</a>-->
                                <button class="btn btn-large btn-primary" type="submit">Iniciar</button>
                                <p>&nbsp;</p>
                                    <?php
                                    $act = "1";
                                    if(!empty($_POST['usuario']) and !empty($_POST['contra'])){
                                        $usuario = limpiar($_POST['usuario']);
                                        $password = limpiar($_POST['contra']);
                                        $passwordMD5 = md5($password);
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
                                                     AND    usuario.password = '{$passwordMD5}'";
                                                     //print $strQuery;
                                        $conn = mysql_query($strQuery);
                                        if(!$dato=mysql_fetch_array($conn)){
                                            if( $act == "1"){
                                                echo '<div class="alert alert-error" align="center"><strong>Usuario y Contrase&ntilde;a Incorrecta</strong></div>';
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
                            </fieldset>
                        </div>
                        </div>
                    </div>
                </div>
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