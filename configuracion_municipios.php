<?php
    
    session_start();
    include_once('core/php_conexion.php');
    include_once('Class/funciones.php'); 
    include_once('Class/class_alumnos.php');

    if($_SESSION['tipo_usu']=='admin' or $_SESSION['tipo_usu']=='normal'){
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
    require_once("modules/configuracion/clases/configuracion_municipios_controller.php");
    fntHeader($titulo);
    $objController = new configuracion_municipios_controller();
    $objController->setDepto();
    $objController->drawButtom();
    $objController->drawContent();
    $objController->fntPost();
    $objController->fntEliminar();
    
    fntBody();
?>
 