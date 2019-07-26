<?php
/*************************************************************
    Developer: Tito De León
    Tel:        5430-6466
    Correo:     compuaserv@gmail.com, tito_de_leon@hotmail.com
*************************************************************/
    
    session_start();
    include_once('core/php_conexion.php');
    include_once('Class/funciones.php'); 
    include_once('Class/class_alumnos.php');

    if($_SESSION['tipo_usu']=='admin' or $_SESSION['tipo_usu']=='normal' ){
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
    $strAction = basename(__FILE__);
    require_once("templates/default/plantilla.php");
    require_once("modules/usuarios/clases/adm_usuarios_controller.php");
    fntHeader($titulo);
    $objController = new adm_usuarios_controller();
    $objController->setPersona();
    $objController->drawButtom();
    $objController->drawContent();
    $objController->fntPost();
    
    fntBody();
?>
 