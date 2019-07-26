<?php
include_once('core/php_conexion.php');
class configuracion_municipios_model{
    
    public function getDepartamento(){
        $arrData = array();
        $strQuery = "SELECT municipio,
                            nombre,
                            activo
                     FROM   municipio";
        $sql = mysql_query($strQuery);
        while($arrTMP = mysql_fetch_array($sql)){
            
            $arrData[$arrTMP['municipio']]["municipio"] = $arrTMP['municipio'];
            $arrData[$arrTMP['municipio']]["nombre"] = $arrTMP['nombre'];
            $arrData[$arrTMP['municipio']]["activo"] = $arrTMP['activo'];
        }
        
        return $arrData;
    }
    
    public function getEtniaId($strEtnia = ""){
        $arrData = array();
        $strQuery = "SELECT municipio,
                            nombre,
                            descripcion,
                            activo
                     FROM   municipio
                     WHERE MD5(municipio.municipio) = '{$strEtnia}'";
        $sql = mysql_query($strQuery);
        while($arrTMP = mysql_fetch_array($sql)){ 
            $arrData["municipio"] = $arrTMP['municipio'];
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
            
            $strQuery = " INSERT INTO municipio(nombre,descripcion,activo,add_user,add_fecha)
                          VALUES('{$strNombre}','{$strDescripcion}','{$strActivo}',{$intPersona},now())";
           mysql_query($strQuery);
           $intId = mysql_insert_id();
           return $intId;
        }
    }
    
    public function fntUpdateEtnia( $intEtnia, $strNombre, $strDescripcion, $chkActivo ){
        
        $intPersona = $_SESSION["persona"];
        
         $strQuery = "  UPDATE  municipio
                        SET     nombre = '{$strNombre}',
                                descripcion = '{$strDescripcion}',
                                activo = '{$chkActivo}',
                                mod_user = {$intPersona},
                                mod_fecha = now()
                        WHERE   municipio = {$intEtnia}";
           mysql_query($strQuery);
        
    }
    
    public function fntDeleteDepto($intDepto){
        
        $strQuery = "DELETE FROM municipio WHERE municipio = {$intDepto}";
        //print $strQuery;
        mysql_query($strQuery);
        
    }
    
    
}
  
?>
 