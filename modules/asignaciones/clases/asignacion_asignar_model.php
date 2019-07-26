<?php
include_once('core/php_conexion.php');
class asignacion_asignar_model{
    
    public function getInfoBusqueda($strBusqueda){
        
        $arrInfo = array();
        
       // if( !empty($strBusqueda) ){
            
           // $strFilter = getFilterQuery("persona.nombre1, persona.nombre2, persona.apellido1, persona.apellido2, persona.apellido_casada ",$strBusqueda,false,true);
            
            $strQuery = "SELECT curso.curso,
                                curso.nombre
                         FROM   curso";
            $qTMP = mysql_query($strQuery);
            while( $rTMP = mysql_fetch_array($qTMP) ) {
                $arrInfo[$rTMP["curso"]]["curso"] = $rTMP["curso"];
                $arrInfo[$rTMP["curso"]]["nombre"] = $rTMP["nombre"];
            }
            //db_free_result($qTMP);
       // }
        return $arrInfo;
    }
    
     public function getInfoBusquedaAlumno($strBusqueda){
        
        $arrInfo = array();
        
       // if( !empty($strBusqueda) ){
            
           // $strFilter = getFilterQuery("persona.nombre1, persona.nombre2, persona.apellido1, persona.apellido2, persona.apellido_casada ",$strBusqueda,false,true);
            
            $strQuery = "SELECT alumno.alumno,
                                alumno.nombres,
                                CONCAT(alumno.nombres,' ',alumno.apellidos) nombre_alumno
                         FROM   alumno";
            $qTMP = mysql_query($strQuery);
            while( $rTMP = mysql_fetch_array($qTMP) ) {
                $arrInfo[$rTMP["alumno"]]["alumno"] = $rTMP["alumno"];
                $arrInfo[$rTMP["alumno"]]["nombre_alumno"] = $rTMP["nombre_alumno"];
            }
            //db_free_result($qTMP);
       // }
        return $arrInfo;
    }
    
    public function getAsignacion($intCurso){
        $arrData = array();
        if( $intCurso > 0 ){
            $strQuery = "SELECT curso_alumno.curso_alumno,
                                curso_alumno.asignado,
                                curso_alumno.alumno,
                                alumno.nombres,
                                CONCAT(alumno.nombres,' ',alumno.apellidos) nombre_alumno,
                                alumno.apellidos
                         FROM   curso_alumno
                                INNER JOIN alumno
                                       ON alumno.alumno = curso_alumno.alumno
                                INNER JOIN curso
                                        ON curso.curso = curso_alumno.curso
                                WHERE curso_alumno.curso = {$intCurso}";
            $sql = mysql_query($strQuery);
            while($arrTMP = mysql_fetch_array($sql)){

                $arrData[$arrTMP['curso_alumno']]["curso_alumno"] = $arrTMP['curso_alumno'];
                $arrData[$arrTMP['curso_alumno']]["alumno"] = $arrTMP['alumno'];
                $arrData[$arrTMP['curso_alumno']]["nombres"] = $arrTMP['nombre_alumno'];
                $arrData[$arrTMP['curso_alumno']]["asignado"] = $arrTMP['asignado'];
            } 
        }
        return $arrData;
    }
    
    public function getAsignacionALL($strAsignacion = ""){
        $arrData = array();
        $strQuery = "SELECT asignacion_alumno.asignacion_alumno,
                            alumno.nombres,
                            alumno.apellidos
                     FROM   asignacion_alumno
                            INNER JOIN alumno
                                   ON alumno.alumno = asignacion_alumno.alumno
                     WHERE MD5(asignacion_alumno.asignacion_alumno) = '{$strAsignacion}'";
        $sql = mysql_query($strQuery);
        while($arrTMP = mysql_fetch_array($sql)){ 
            $arrData["alumno"] = $arrTMP['alumno'];
            $arrData[$arrTMP["asignacion_alumno"]]["asignacion"] = $arrTMP["asignacion"];
            $arrData[$arrTMP["asignacion_alumno"]]["nombre_docente"] = $arrTMP["nombre_docente"];
        }
        return $arrData;
    }   
    
    public function insertAlumno($intCurso, $intAlumno, $strAsignar){
        
        $intPersona = $_SESSION["persona"];
        $strQuery = " INSERT INTO curso_alumno(curso,alumno,asignado,add_user,add_fecha)
                          VALUES({$intCurso},{$intAlumno},'{$strAsignar}',{$intPersona},now())";
                        //  print $strQuery;
        mysql_query($strQuery);
    }
    
    
    public function fntUpdateAlumno($intCursoAlumno,$intCurso, $intAlumno, $strAsignar){
         
        
         $intPersona = $_SESSION["persona"];
         $strQuery = "  UPDATE  curso_alumno
                        SET     curso = {$intCurso},
                                alumno = {$intAlumno},
                                asignado = '{$strAsignar}',
                                mod_user = {$intPersona},
                                mod_fecha = now()
                        WHERE   curso_alumno = {$intCursoAlumno}";
                      //  print $strQuery;
           mysql_query($strQuery);
        
    }
    
     public function deleteCursoAlumno($intCursoAlumo){
        
        $strQuery = "DELETE FROM curso_alumno WHERE curso_alumno = {$intCursoAlumo}";
        mysql_query($strQuery);
    }
    
    
}
  
?>
 