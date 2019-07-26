<?php
/*************************************************************
    Developer: Tito De León
    Tel:        5430-6466
    Correo:     compuaserv@gmail.com, tito_de_leon@hotmail.com
*************************************************************/
include_once('core/php_conexion.php');
class adm_usuarios_model{
    
    
    public function fntInsertUsuario(  $intUsuario, $strNombre1, $strNombre2 , $strApellido1, $strApellido2, $strApellidoCasada, $strEmail, $strUsuario, $strNOmbreUsuario, $strContrasena ,$chkActivo, $slcTipo ){
        
        $intId = 0;
        $strContrasena = md5($strContrasena);
        if(   !empty($strNombre1) && !empty($strApellido1) ){
            
           $strQuery = " INSERT INTO usuario(codigo_alumno,bloqueado,nombre,usuario,password,tipo,add_user,add_fecha)
                          VALUES(' ','{$chkActivo}','{$strNOmbreUsuario}','{$strUsuario}','{$strContrasena}','{$slcTipo}',1,now())";
           mysql_query($strQuery);
           
           
           $strQuery2 = "INSERT INTO persona(nombre1,nombre2,apellido1,apellido2,apellido_casada,email,add_user,add_fecha )
                          VALUES('{$strNombre1}','{$strNombre2}','{$strApellido1}','{$strApellido2}','{$strApellidoCasada}','{$strEmail}',1,now())";
            mysql_query($strQuery2);              
           $intId = mysql_insert_id();
           return $intId;
        }
    }
    
    public function getUsuario(){
        $arrData = array();
        $strQuery = "SELECT persona.persona,
                            persona.nombre1,
                            persona.nombre2,
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
            $arrData[$arrTMP['persona']]["nombre2"] = $arrTMP['nombre2'];
            $arrData[$arrTMP['persona']]["usuario"] = $arrTMP['usuario'];
            $arrData[$arrTMP['persona']]["bloqueado"] = $arrTMP['bloqueado'];
            $arrData[$arrTMP['persona']]["tipo"] = $arrTMP['tipo'];
        }
        
        return $arrData;
    }
    
    public function getUsuarioId($strPersona = ""){
        $arrData = array();
        $strQuery = "SELECT persona.persona,
                            persona.nombre1,
                            persona.nombre2,
                            persona.apellido1,
                            persona.apellido2,
                            persona.apellido_casada,
                            persona.email,
                            usuario.bloqueado,
                            usuario.usuario,
                            usuario.nombre,
                            usuario.password,
                            usuario.tipo
                     FROM   persona
                            INNER JOIN usuario
                                ON usuario.persona = persona.persona
                     WHERE MD5(persona.persona) = '{$strPersona}'";
        $sql = mysql_query($strQuery);
        //print $strQuery;
        while($arrTMP = mysql_fetch_array($sql)){
            
            $arrData["persona"] = $arrTMP['persona'];
            $arrData["nombre1"] = $arrTMP['nombre1'];
            $arrData["nombre2"] = $arrTMP['nombre2'];
            $arrData["apellido1"] = $arrTMP['apellido1'];
            $arrData["apellido2"] = $arrTMP['apellido2'];
            $arrData["apellido_casada"] = $arrTMP['apellido_casada'];
            $arrData["email"] = $arrTMP['email'];
            $arrData["usuario"] = $arrTMP['usuario'];
            $arrData["nombre"] = $arrTMP['nombre'];
            $arrData["bloqueado"] = $arrTMP['bloqueado'];
            $arrData["tipo"] = $arrTMP['tipo'];
        }
        
        return $arrData;
    }
    
    public function fntUpdateUsuario( $intUsuario, $strNombre1, $strNombre2 , $strApellido1, $strApellido2, $strApellidoCasada, $strEmail,$strUsuario, $strNOmbreUsuario,  $strContrasena ,$chkActivo, $slcTipo ){
        
        $strContrasena = md5($strContrasena);
        
         $strQuery = "  UPDATE  persona
                        SET     nombre1 = '{$strNombre1}',
                                nombre2 = '{$strNombre2}',
                                apellido1 = '{$strApellido1}',
                                apellido2 = '{$strApellido2}',
                                apellido_casada = '{$strApellidoCasada}',
                                email = '{$strEmail}',
                                mod_user = 1,
                                mod_fecha = now()
                        WHERE   persona = {$intUsuario}";
           mysql_query($strQuery);
           
         $strQuery2 = " UPDATE  usuario
                       SET     usuario = '{$strUsuario}',
                               nombre = '{$strNOmbreUsuario}',
                               bloqueado = '{$chkActivo}',
                               password = '{$strContrasena}',
                               tipo = '{$slcTipo}',
                               mod_user = 1,
                               mod_fecha = now()
                       WHERE   persona = {$intUsuario}";
                        
           mysql_query($strQuery2);
        
    }
    
    public function db_fetch_array($argIndex) {
        return mysql_fetch_array($argIndex);
    }
    
    /*public function fntTipo(){
        $sql = "show columns from usuario like 'tipo'";

        $resultado = mysql_query($sql); 
        $fila = mysql_fetch_array($resultado); 
        
        $resultado = mysql_query($sql); 
        $fila = mysql_fetch_array($resultado);
        $cadenavalor = $fila[1];
        $cadenavalor = ereg_replace("enum", "", $cadenavalor);
        $cadenavalor = ereg_replace("\(", "", $cadenavalor);
        $cadenavalor = ereg_replace("\)", "", $cadenavalor);
        $cadenavalor = ereg_replace("\'", "", $cadenavalor);
        $valores = split(",", $cadenavalor);
        return $valores;
    }*/
    public function fntTipo($strAreaTipo){
        
        $arrData = array();
        $arrData2 = array();
        $arrData["admin"]["tipo"] = "admin";
        $arrData["admin"]["nombre"] = "Admin";
        $arrData["normal"]["tipo"] = "normal";
        $arrData["normal"]["nombre"] = "Normal";
        
        foreach( $arrData as $arrTMP ){
            $arrData2[$arrTMP["tipo"]]["texto"] = $arrTMP["nombre"];
            $arrData2[$arrTMP["tipo"]]["selected"] = $arrTMP["tipo"] == $strAreaTipo ?  true : false;
        }
        return $arrData2;
    }
}
  
?>
 