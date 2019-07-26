<?php
/*************************************************************
    Developer: Tito De León
    Tel:        5430-6466
    Correo:     compuaserv@gmail.com, tito_de_leon@hotmail.com
*************************************************************/
include_once('core/php_conexion.php');
class configuracion_alumnos_model{
    
    public function getAlumnos(){
        $arrData = array();
        $strQuery = "SELECT alumno.alumno,
                            alumno.nombres,
                            alumno.apellidos,
                            alumno.identificacion
                     FROM   alumno";
        $sql = mysql_query($strQuery);
        while($arrTMP = mysql_fetch_array($sql)){
            
            $arrData[$arrTMP['alumno']]["alumno"] = $arrTMP['alumno'];
            $arrData[$arrTMP['alumno']]["nombres"] = $arrTMP['nombres'];
            $arrData[$arrTMP['alumno']]["apellidos"] = $arrTMP['apellidos'];
            $arrData[$arrTMP['alumno']]["identificacion"] = $arrTMP['identificacion'];
        }
        
        return $arrData;
    }
    
    public function getAlumnosId($strAlumno = ""){
        $arrData = array();
        if( $strAlumno != "" ){
        $strQuery = "SELECT alumno.alumno,
                            alumno.nombres,
                            alumno.apellidos,
                            alumno.identificacion,
                            alumno.edad,
                            alumno.genero,
                            alumno.grupo_etnico,
                            alumno.estado_civil,
                            alumno.profesion_oficio,
                            alumno.telefono,
                            alumno.correo_electronico,
                            alumno.departamento,
                            alumno.municipio,
                            alumno.direccion,
                            alumno.area_geografica,
                            alumno.trabaja_actualmente,
                            alumno.discapasidad,
                            alumno.imagen_alumno_path,
                            alumno.activo
                     FROM   alumno
                     WHERE MD5(alumno.alumno) = '{$strAlumno}'";
        $sql = mysql_query($strQuery);
        //print $strQuery;
        while($arrTMP = mysql_fetch_array($sql)){
            
            $arrData["alumno"] = $arrTMP['alumno'];
            $arrData["nombres"] = $arrTMP['nombres'];
            $arrData["apellidos"] = $arrTMP['apellidos'];
            $arrData["identificacion"] = $arrTMP['identificacion'];
            $arrData["edad"] = $arrTMP['edad'];
            $arrData["genero"] = $arrTMP['genero'];
            $arrData["grupo_etnico"] = $arrTMP['grupo_etnico'];
            $arrData["estado_civil"] = $arrTMP['estado_civil'];
            $arrData["profesion_oficio"] = $arrTMP['profesion_oficio'];
            $arrData["telefono"] = $arrTMP['telefono'];
            $arrData["correo_electronico"] = $arrTMP['correo_electronico'];
            $arrData["departamento"] = $arrTMP['departamento'];
            $arrData["municipio"] = $arrTMP['municipio'];
            $arrData["direccion"] = $arrTMP['direccion'];
            $arrData["area_geografica"] = $arrTMP['area_geografica'];
            $arrData["trabaja_actualmente"] = $arrTMP['trabaja_actualmente'];
            $arrData["discapasidad"] = $arrTMP['discapasidad'];
            $arrData["imagen_alumno_path"] = $arrTMP['imagen_alumno_path'];
            $arrData["activo"] = $arrTMP['activo'];
            /*$arrData["apellido1"] = $arrTMP['apellido1'];
            $arrData["apellido2"] = $arrTMP['apellido2'];
            $arrData["apellido_casada"] = $arrTMP['apellido_casada'];
            $arrData["usuario"] = $arrTMP['usuario'];
            $arrData["bloqueado"] = $arrTMP['bloqueado'];
            $arrData["tipo"] = $arrTMP['tipo'];*/
        }
        }
        
        return $arrData;
    }
    
    public function db_fetch_array($argIndex) {
        return mysql_fetch_array($argIndex);
    }
    
    public function fntGenero($strGenero = "M"){
        $arrData = array();
        $arrData2 = array();
        $arrData["M"]["genero"] = "M";
        $arrData["M"]["nombre"] = "Masculino";
        $arrData["F"]["genero"] = "F";
        $arrData["F"]["nombre"] = "Femenino";
        
        foreach( $arrData as $arrTMP ){
            $arrData2[$arrTMP["genero"]]["texto"] = $arrTMP["nombre"];
            $arrData2[$arrTMP["genero"]]["selected"] = $arrTMP["genero"] == $strGenero ?  true : false;
        }
        return $arrData2;
    }
    
   /* public function fntEstadoCivil(){
        $sql = "show columns from alumno like 'estado_civil'";

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
    
    public function fntEstadoCivil($strEstadoCivil = "M"){
        $arrData = array();
        $arrData2 = array();
        $arrData["soltero"]["estado_civil"] = "soltero";
        $arrData["soltero"]["nombre"] = "Soltero";
        $arrData["casado"]["estado_civil"] = "casado";
        $arrData["casado"]["nombre"] = "Casado";
        
        foreach( $arrData as $arrTMP ){
            $arrData2[$arrTMP["estado_civil"]]["texto"] = $arrTMP["nombre"];
            $arrData2[$arrTMP["estado_civil"]]["selected"] = $arrTMP["estado_civil"] == $strEstadoCivil ?  true : false;
        }
        return $arrData2;
    }
    
    public function fntEtnia( $intSelected ){
        header("Content-Type: text/html;charset=utf-8");
        $arrData = array();
        $strQuery ="SELECT  etnia,
                            nombre,
                            activo
                    FROM etnia
                    WHERE activo = 'Y'";
        $qTMP = mysql_query($strQuery);
        while( $rTMP = mysql_fetch_array($qTMP) ){
            $arrData[$rTMP["etnia"]]["etnia"] = $rTMP["etnia"];
            $arrData[$rTMP["etnia"]]["texto"] = $rTMP["nombre"];
            $arrData[$rTMP["etnia"]]["selected"] = $rTMP["etnia"] == $intSelected;
        }

        return $arrData;
    }
    
    public function fntDepartamento( $intSelected ){
        header("Content-Type: text/html;charset=utf-8");
        $arrData = array();
        $strQuery ="SELECT  departamento,
                            nombre,
                            activo
                    FROM departamento
                    WHERE activo = 'Y'";
        $qTMP = mysql_query($strQuery);
        while( $rTMP = mysql_fetch_array($qTMP) ){
            $arrData[$rTMP["departamento"]]["departamento"] = $rTMP["departamento"];
            $arrData[$rTMP["departamento"]]["texto"] = $rTMP["nombre"];
            $arrData[$rTMP["departamento"]]["selected"] = $rTMP["departamento"] == $intSelected;
        }

        return $arrData;
    }
    
    public function fntMunicipio( $intSelected ){
        header("Content-Type: text/html;charset=utf-8");
        $arrData = array();
        $strQuery ="SELECT  municipio,
                            nombre,
                            activo
                    FROM municipio
                    WHERE activo = 'Y'";
        $qTMP = mysql_query($strQuery);
        while( $rTMP = mysql_fetch_array($qTMP) ){
            $arrData[$rTMP["municipio"]]["municipio"] = $rTMP["municipio"];
            $arrData[$rTMP["municipio"]]["texto"] = $rTMP["nombre"];
            $arrData[$rTMP["municipio"]]["selected"] = $rTMP["municipio"] == $intSelected;
        }

        return $arrData;
    }
    
    public function fntAreaGeografica($strAreaGeografica){
        /*$sql = "show columns from alumno like 'area_geografica'";

        $resultado = mysql_query($sql); 
        $fila = mysql_fetch_array($resultado); 
        
        $resultado = mysql_query($sql); 
        $fila = mysql_fetch_array($resultado);
        $cadenavalor = $fila[1];
        $cadenavalor = preg_replace("enum", "", $cadenavalor);
        $cadenavalor = preg_replace("\(", "", $cadenavalor);
        $cadenavalor = preg_replace("\)", "", $cadenavalor);
        $cadenavalor = preg_replace("\'", "", $cadenavalor);
        $valores = explode(",", $cadenavalor);
        return $valores; */
        
        $arrData = array();
        $arrData2 = array();
        $arrData["U"]["area_geografica"] = "U";
        $arrData["U"]["nombre"] = "Urbana";
        $arrData["R"]["area_geografica"] = "R";
        $arrData["R"]["nombre"] = "Rural";
        
        foreach( $arrData as $arrTMP ){
            $arrData2[$arrTMP["area_geografica"]]["texto"] = $arrTMP["nombre"];
            $arrData2[$arrTMP["area_geografica"]]["selected"] = $arrTMP["area_geografica"] == $strAreaGeografica ?  true : false;
        }
        return $arrData2;
    }
    
    public function fntTrabajaActualmente($strTrabaja){
        /*$sql = "show columns from alumno like 'trabaja_actualmente'";

        $resultado = mysql_query($sql); 
        $fila = mysql_fetch_array($resultado); 
        
        $resultado = mysql_query($sql); 
        $fila = mysql_fetch_array($resultado);
        $cadenavalor = $fila[1];
        $cadenavalor = preg_replace("enum", "", $cadenavalor);
        $cadenavalor = preg_replace("\(", "", $cadenavalor);
        $cadenavalor = preg_replace("\)", "", $cadenavalor);
        $cadenavalor = preg_replace("\'", "", $cadenavalor);
        $valores = explode(",", $cadenavalor);
        return $valores;  */
        
        $arrData = array();
        $arrData2 = array();
        $arrData["Y"]["trabaja_actualmente"] = "Y";
        $arrData["Y"]["nombre"] = "Si";
        $arrData["N"]["trabaja_actualmente"] = "N";
        $arrData["N"]["nombre"] = "No";
        
        foreach( $arrData as $arrTMP ){
            $arrData2[$arrTMP["trabaja_actualmente"]]["texto"] = $arrTMP["nombre"];
            $arrData2[$arrTMP["trabaja_actualmente"]]["selected"] = $arrTMP["trabaja_actualmente"] == $strTrabaja ?  true : false;
        }
        return $arrData2;
    }
    
    public function fntDiscapacidad(){
        $sql = "show columns from alumno like 'discapasidad'";

        $resultado = mysql_query($sql); 
        $fila = mysql_fetch_array($resultado); 
        
        $resultado = mysql_query($sql); 
        $fila = mysql_fetch_array($resultado);
        $cadenavalor = $fila[1];
        $cadenavalor = preg_replace("enum", "", $cadenavalor);
        $cadenavalor = preg_replace("\(", "", $cadenavalor);
        $cadenavalor = preg_replace("\)", "", $cadenavalor);
        $cadenavalor = preg_replace("\'", "", $cadenavalor);
        $valores = explode(",", $cadenavalor);
        return $valores;
    }
    
    public function fntDesDiscapacidad($strDiscapacidad){
        
       /* $arrData = array();
        $arrData["Y"] = "VISUAL";
        $arrData["F"] = "FISICA";
        $arrData["D"] = "DEL HABLA";
        $arrData["M"] = "MULTIPLE";
        $arrData["A"] = "AUDITIVA";
        $arrData["N"] = "NINGUNA";
        return $arrData;*/
        $arrData = array();
        $arrData2 = array();
        $arrData["V"]["discapasidad"] = "V";
        $arrData["V"]["nombre"] = "VISUAL";
        $arrData["F"]["discapasidad"] = "F";
        $arrData["F"]["nombre"] = "FISICA";
        $arrData["D"]["discapasidad"] = "D";
        $arrData["D"]["nombre"] = "DEL HABLA";
        $arrData["M"]["discapasidad"] = "M";
        $arrData["M"]["nombre"] = "MULTIPLE";
        $arrData["A"]["discapasidad"] = "A";
        $arrData["A"]["nombre"] = "AUDITIVA";
        $arrData["N"]["discapasidad"] = "N";
        $arrData["N"]["nombre"] = "NINGUNA";
        
        foreach( $arrData as $arrTMP ){
            $arrData2[$arrTMP["discapasidad"]]["texto"] = $arrTMP["nombre"];
            $arrData2[$arrTMP["discapasidad"]]["selected"] = $arrTMP["discapasidad"] == $strDiscapacidad ?  true : false;
        }
        return $arrData2;
    }
    
    public function fntUpdateAlumno( $intAlumno, $strNombreAlumno, $strApellidosAlumno , $strDPIAlumno, $intEdadAlumno, $strGeneroAlumno, $strGrupoEtnicoAlumno, $strIdiomaMaternoAlumno ,$strEstadoCivilAlumno, $strProfecionAlumno, $strTelefonoAlumno, $strCorreoElectronico, $strDepartamentoAlumno, $strMunicipioAlumno, $strDireccionAlumno, $strAreaGeograficaAlumno, $strTrabajaAlumno, $strDiscapacidadAlumno, $strPath, $chkActivo ){
        $intPersona = $_SESSION["persona"];
        $strQuery = "  UPDATE   alumno
                        SET     nombres = '{$strNombreAlumno}',
                                apellidos = '{$strApellidosAlumno}',
                                identificacion = '{$strDPIAlumno}',
                                edad = {$intEdadAlumno},
                                genero = '{$strGeneroAlumno}',
                                grupo_etnico = {$strGrupoEtnicoAlumno},
                                idioma_materno = {$strIdiomaMaternoAlumno},
                                estado_civil = '{$strEstadoCivilAlumno}',
                                profesion_oficio = '{$strProfecionAlumno}',
                                telefono = {$strTelefonoAlumno},
                                correo_electronico = '{$strCorreoElectronico}',
                                direccion = '{$strDireccionAlumno}',
                                municipio = {$strMunicipioAlumno},
                                departamento = {$strDepartamentoAlumno},
                                area_geografica = '{$strAreaGeograficaAlumno}',
                                trabaja_actualmente = '{$strTrabajaAlumno}',
                                discapasidad = '{$strDiscapacidadAlumno}',
                                imagen_alumno_path = '{$strPath}',
                                activo = '{$chkActivo}',
                                mod_user = {$intPersona},
                                mod_fecha = now()
                        WHERE   alumno = {$intAlumno}";
        mysql_query($strQuery);
        
    }
   
    public function fntInsertUsuario(  $strNombreAlumno, $strApellidosAlumno , $strDPIAlumno, $intEdadAlumno, $strGeneroAlumno, $strGrupoEtnicoAlumno, $strIdiomaMaternoAlumno ,$strEstadoCivilAlumno, $strProfecionAlumno, $strTelefonoAlumno, $strCorreoElectronico, $strDepartamentoAlumno, $strMunicipioAlumno, $strDireccionAlumno, $strAreaGeograficaAlumno, $strTrabajaAlumno, $strDiscapacidadAlumno, $chkActivo ){
        
        $intId = 0;
        $intPersona = $_SESSION["persona"];
        if(   !empty($strNombreAlumno) && !empty($strApellidosAlumno) ){
            
           $strQuery = "INSERT INTO alumno(nombres,apellidos,identificacion,edad,genero,grupo_etnico,idioma_materno,estado_civil,profesion_oficio,telefono,correo_electronico,direccion,municipio,departamento,area_geografica,trabaja_actualmente,discapasidad,activo,add_user,add_fecha )
                          VALUES('{$strNombreAlumno}','{$strApellidosAlumno}','{$strDPIAlumno}',{$intEdadAlumno},'{$strGeneroAlumno}',{$strGrupoEtnicoAlumno},{$strIdiomaMaternoAlumno},'{$strEstadoCivilAlumno}','{$strProfecionAlumno}',{$strTelefonoAlumno},'{$strCorreoElectronico}','{$strDireccionAlumno}',{$strMunicipioAlumno},{$strDepartamentoAlumno},'{$strAreaGeograficaAlumno}','{$strTrabajaAlumno}','{$strDiscapacidadAlumno}','{$chkActivo}',{$intPersona},now())";
            mysql_query($strQuery);     
           $intId = mysql_insert_id();
           return $intId;
        }
    }
    
    
    public function fntDeleteAlumno($intAlumno){
        $strQuery = "DELETE FROM alumno WHERE alumno = {$intAlumno}";
        mysql_query($strQuery);
    }
    
}
  
?>
 