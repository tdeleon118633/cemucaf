<?php
session_start();
include_once('php_conexion.php');   
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
    $can = mysql_query($strQuery);
    if($dato = mysql_fetch_array($can)){
     
        if($dato['bloqueado'] == 'N'){
            $_SESSION['username'] = $dato['usuario'];
            $_SESSION['tipo_usu'] = $dato['tipo'];
            $_SESSION['bloqueado'] = $dato['bloqueado'];
            if($_SESSION['tipo_usu'] == 'admin' or $_SESSION['tipo_usu'] == 'normal'){ 
                    
                header('location:Administrador.php');
             
            }
        }
    }

}
?>