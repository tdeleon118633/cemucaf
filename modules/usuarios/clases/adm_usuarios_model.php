<?php
include_once('core/php_conexion.php');
class adm_usuarios_model{
    
    
    public function fntInsert(){
        
        if(!empty($_POST['ced'])){
                    $ced=limpiar($_POST['ced']);		$nom=limpiar($_POST['nom']);
                    $usu=limpiar($_POST['usu']);		$tipo=limpiar($_POST['tipo']);
                    $estado=limpiar($_POST['estado']);	$con=limpiar($_POST['usu']);

                    if($_POST['proceso']=='actualizar'){
                            mysql_query("UPDATE usuarios SET estado='$estado', nom='$nom', tipo='$tipo'	where usu='$usu'");
                            echo mensajes("El usuario ha sido Actualizado con Exito","verde");	
                    }elseif($_POST['proceso']=='guardar'){
                            if (preg_match("/\\s/", $usu)){ 
                                    echo mensajes('No se permiten espacios en la cuenta de usuario','rojo');
                            }else{
                                    mysql_query("INSERT INTO usuarios (ced,estado,nom,usu,con,tipo) 
                                    VALUES ('$ced','$estado','$nom','$usu','$con','$tipo')");
                                    echo mensajes("El usuario ha sido Registrado con Exito","verde");
                            }
                    }
            }
    }
    
    public function getUsuario(){
        $arrData = array();
        $strQuery = "SELECT persona.persona,
                            persona.nombre1,
                            usuario.codigo_alumno,
                            usuario.bloqueado,
                            usuario.usuario,
                            usuario.password,
                            usuario.tipo
                     FROM   persona
                            INNER JOIN usuario
                                ON usuario.persona = persona.persona";
        $sql = mysql_query($strQuery);
        while($arrTMP = mysql_fetch_array($sql)){
            
            $arrData[$arrTMP['persona']]["persona"] = $arrTMP['persona'];
            $arrData[$arrTMP['persona']]["nombre1"] = $arrTMP['nombre1'];
        
            /* if($row['tipo']=='a'){
                     $tipo='Administrado';
             }else{
                     $tipo='Usuario';	
             }*/
        }
        
        return $arrData;
    }
    
    
}
  
?>
 