<?php
include_once('core/php_conexion.php');
class configuracion_departamentos_model{
    
    public function getDepartamento(){
        $arrData = array();
        $strQuery = "SELECT departamento,
                            nombre,
                            activo
                     FROM   departamento";
        $sql = mysql_query($strQuery);
        while($arrTMP = mysql_fetch_array($sql)){
            
            $arrData[$arrTMP['departamento']]["departamento"] = $arrTMP['departamento'];
            $arrData[$arrTMP['departamento']]["nombre"] = $arrTMP['nombre'];
            $arrData[$arrTMP['departamento']]["activo"] = $arrTMP['activo'];
        }
        
        return $arrData;
    }
    
    public function getEtniaId($strEtnia = ""){
        $arrData = array();
        $strQuery = "SELECT departamento,
                            nombre,
                            descripcion,
                            activo
                     FROM   departamento
                     WHERE MD5(departamento.departamento) = '{$strEtnia}'";
        $sql = mysql_query($strQuery);
        while($arrTMP = mysql_fetch_array($sql)){ 
            $arrData["departamento"] = $arrTMP['departamento'];
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
            
            $strQuery = " INSERT INTO departamento(nombre,descripcion,activo,add_user,add_fecha)
                          VALUES('{$strNombre}','{$strDescripcion}','{$strActivo}',{$intPersona},now())";
           mysql_query($strQuery);
           $intId = mysql_insert_id();
           return $intId;
        }
    }
    
    public function fntUpdateEtnia( $intEtnia, $strNombre, $strDescripcion, $chkActivo ){
        
        $intPersona = $_SESSION["persona"];
        
         $strQuery = "  UPDATE  departamento
                        SET     nombre = '{$strNombre}',
                                descripcion = '{$strDescripcion}',
                                activo = '{$chkActivo}',
                                mod_user = {$intPersona},
                                mod_fecha = now()
                        WHERE   departamento = {$intEtnia}";
           mysql_query($strQuery);
        
    }
    
    public function fntDeleteDepto($intDepto){
        
        $strQuery = "DELETE FROM departamento WHERE departamento = {$intDepto}";
        //print $strQuery;
        mysql_query($strQuery);
        
    }
    
    
}
  
?>
 