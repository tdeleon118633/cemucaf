<?php
include_once('core/php_conexion.php');
class configuracion_etnias_model{
    
    public function getEtnia(){
        $arrData = array();
        $strQuery = "SELECT etnia,
                            nombre,
                            activo
                     FROM   etnia";
        $sql = mysql_query($strQuery);
        while($arrTMP = mysql_fetch_array($sql)){
            
            $arrData[$arrTMP['etnia']]["etnia"] = $arrTMP['etnia'];
            $arrData[$arrTMP['etnia']]["nombre"] = $arrTMP['nombre'];
        }
        
        return $arrData;
    }
    
    public function getEtniaId($strEtnia = ""){
        $arrData = array();
        $strQuery = "SELECT etnia,
                            nombre,
                            descripcion,
                            activo
                     FROM   etnia
                     WHERE MD5(etnia.etnia) = '{$strEtnia}'";
        $sql = mysql_query($strQuery);
        while($arrTMP = mysql_fetch_array($sql)){ 
            $arrData["etnia"] = $arrTMP['etnia'];
            $arrData["nombre"] = $arrTMP['nombre'];
            $arrData["descripcion"] = $arrTMP['descripcion'];
            $arrData["activo"] = $arrTMP['activo'];
        }
        
        return $arrData;
    }
    
    public function fntInsertEtnia( $strNombre,$strDescripcion, $strActivo){
        $intPersona = $_SESSION["persona"];
        $intId = 0;
        if( !empty($strNombre)  ){
            
            $strQuery = " INSERT INTO etnia(nombre,descripcion,activo,add_user,add_fecha)
                          VALUES('{$strNombre}','{$strDescripcion}','{$strActivo}',{$intPersona},now())";
           mysql_query($strQuery);
           $intId = mysql_insert_id();
           return $intId;
        }
    }
    
    public function fntUpdateEtnia( $intEtnia, $strNombre, $strDescripcion, $chkActivo ){
        
        $intPersona = $_SESSION["persona"];
        
         $strQuery = "  UPDATE  etnia
                        SET     nombre = '{$strNombre}',
                                descripcion = '{$strDescripcion}',
                                activo = '{$chkActivo}',
                                mod_user = {$intPersona},
                                mod_fecha = now()
                        WHERE   etnia = {$intEtnia}";
           mysql_query($strQuery);
        
    }
    
    public function fntDeleteEtnia($intEtnia){
        
        $strQuery = "DELETE FROM etnia WHERE etnia = {$intEtnia}";
        mysql_query($strQuery);
        
    }
    
    
}
  
?>
 