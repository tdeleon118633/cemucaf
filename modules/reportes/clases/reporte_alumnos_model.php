<?php
/*************************************************************
    Developer: Tito De León
    Tel:        5430-6466
    Correo:     compuaserv@gmail.com, tito_de_leon@hotmail.com
*************************************************************/
include_once('core/php_conexion.php');
class reporte_alumnos_model{
    
    public function getCursosInicio(){
        $arrData = array();
        $strQuery = "SELECT curso,
                            nombre,
                            fecha_inicio,
                            fecha_fin,
                            activo
                     FROM   curso";
        $sql = mysql_query($strQuery);
        while($arrTMP = mysql_fetch_array($sql)){
            
            $arrData[$arrTMP['curso']]["curso"] = $arrTMP['curso'];
            $arrData[$arrTMP['curso']]["nombre"] = $arrTMP['nombre'];
            $arrData[$arrTMP['curso']]["fecha_inicio"] = $arrTMP['fecha_inicio'];
            $arrData[$arrTMP['curso']]["fecha_fin"] = $arrTMP['fecha_fin'];
            $arrData[$arrTMP['curso']]["activo"] = $arrTMP['activo'];
        }
        
        return $arrData;
    }
    
    public function fntListadoAlumnos($strCurso = ""){
        $arrData = array();
            
            $arrData["arrHorarios"] = array();
            $strQuery = "SELECT curso.curso,
                                curso_horario.horario,
                                curso_horario.hora_inicio,
                                curso_horario.hora_fin,
                                curso_horario.dia
                         FROM   curso,
                                curso_horario
                         WHERE  curso_horario.curso = curso.curso
                         AND    curso_horario.curso = {$intCurso}
                         ORDER BY curso_horario.add_fecha";
                        // print $strQuery;
            $qTMP = mysql_query($strQuery);
            while($rTMP = mysql_fetch_array($qTMP)){
                $arrData["arrHorarios"][$rTMP["horario"]]["curso"] = $rTMP["curso"];
                $arrData["arrHorarios"][$rTMP["horario"]]["horario"] = $rTMP["horario"];
                $arrData["arrHorarios"][$rTMP["horario"]]["hora_inicio"] = $rTMP["hora_inicio"];
                $arrData["arrHorarios"][$rTMP["horario"]]["hora_fin"] = $rTMP["hora_fin"];
                $arrData["arrHorarios"][$rTMP["horario"]]["dia"] = $rTMP["dia"];
            }

        
        return $arrData;
    }
    
    public function fntUpdateCurso( $intCurso, $strNombre, $strFechaInicio , $strFechaFin, $chkActivo ){
         
        
         $intPersona = $_SESSION["persona"];
         $strQuery = "  UPDATE  curso
                        SET     nombre = '{$strNombre}',
                                fecha_inicio = '{$strFechaInicio}',
                                fecha_fin = '{$strFechaFin}',
                                activo = '{$chkActivo}',
                                mod_user = {$intPersona},
                                mod_fecha = now()
                        WHERE   curso = {$intCurso}";
           mysql_query($strQuery);
        
    }
    
    public function fntInsertCurso( $strNombre, $strFechaInicio , $strFechaFin, $chkActivo ){
        
        $intId = 0;
        $intPersona = $_SESSION["persona"];
        if(   !empty($strNombre) && !empty($strFechaInicio) ){
            
           $strQuery = "INSERT INTO curso(nombre,fecha_inicio,fecha_fin,activo,add_user,add_fecha )
                          VALUES('{$strNombre}','{$strFechaInicio}','{$strFechaFin}','{$chkActivo}',{$intPersona},now())";
            mysql_query($strQuery);              
           $intId = mysql_insert_id();
           return $intId;
        }
    }
    
    public function db_fetch_array($argIndex) {
        return mysql_fetch_array($argIndex);
    }
    
    public function fntUpdateCursoHorario($intHorario, $intCurso, $strDia, $strHorarioInicio, $strHorarioFin){
         
        
         $intPersona = $_SESSION["persona"];
         $strQuery = "  UPDATE  curso_horario
                        SET     curso = {$intCurso},
                                dia = '{$strDia}',
                                hora_inicio = '{$strHorarioInicio}',
                                hora_fin = '{$strHorarioFin}',
                                mod_user = {$intPersona},
                                mod_fecha = now()
                        WHERE   horario = {$intHorario}";
           mysql_query($strQuery);
        
    }
    
    public function deleteCursoHorario($intHorario){
        
        $strQuery = "DELETE FROM curso_horario WHERE horario = {$intHorario}";
        mysql_query($strQuery);
    }
    
    public function fntDeleteCurso($intCurso){
        $strQuery = "DELETE FROM curso WHERE curso = {$intCurso}";
        mysql_query($strQuery);
        
        $strQuery2 = "DELETE FROM curso_horario WHERE curso = {$intCurso}";
        mysql_query($strQuery2);
    }
    
    public function getRegistroEstudiantes($strFechaInicio, $strFechaFin){
        //WHERE   cuenta_corriente_recibo.add_fecha BETWEEN '{$strFechaInicio} 00:00:00' AND '{$strFechaFin} 23:59:59'
        $arrData = array();
        $strQuery = "SELECT alumno.alumno,
                            alumno.nombres,
                            alumno.apellidos,
                            alumno.identificacion,
                            alumno.edad,
                            alumno.genero,
                            alumno.grupo_etnico,
                            alumno.idioma_materno,
                            etnia_a.nombre grupo_etnia_nombre,
                            etnia_b.nombre idioma_materno_nombre,
                            alumno.estado_civil,
                            alumno.profesion_oficio,
                            alumno.telefono,
                            alumno.correo_electronico,
                            alumno.direccion,
                            alumno.departamento,
                            departamento.nombre nombre_departamento,
                            alumno.municipio,
                            municipio.nombre nombre_municipio,
                            alumno.area_geografica,
                            alumno.trabaja_actualmente,
                            alumno.discapasidad,
                            curso_alumno.curso_alumno,
                            curso.fecha_inicio,
                            curso.fecha_fin,
                            curso.fecha_inicio fecha_incripcion,
                            curso.tecnico_docente  nombre_docente,
                            alumno.programa,
                            alumno.modalidad,
                            curso.nombre etapa_grado_curso



           FROM   alumno
                            INNER JOIN etnia etnia_a
                                    ON etnia_a.etnia = grupo_etnico
                            INNER JOIN etnia etnia_b
                                   ON  etnia_b.etnia = idioma_materno
                            INNER JOIN departamento
                                   ON departamento.departamento = alumno.departamento
                            INNER JOIN municipio
                                   ON municipio.municipio = alumno.municipio
                            INNER JOIN curso_alumno
                                   ON   curso_alumno.alumno = alumno.alumno
                            INNER JOIN curso
                                   ON curso.curso = curso_alumno.curso
         ";
        // WHERE              curso.fecha_inicio >= '{$strFechaInicio} 00:00:00' 
         //AND                curso.fecha_fin <= '{$strFechaFin} 23:59:59'
         //print $strQuery;
        $qTMP = mysql_query($strQuery);
        while($arrTMP = mysql_fetch_array($qTMP)){
            $arrData[$arrTMP['alumno']]["alumno"] = $arrTMP['alumno'];
            $arrData[$arrTMP['alumno']]["nombres"] = $arrTMP['nombres'];
            $arrData[$arrTMP['alumno']]["apellidos"] = $arrTMP['apellidos'];
            $arrData[$arrTMP['alumno']]["identificacion"] = $arrTMP['identificacion'];
            $arrData[$arrTMP['alumno']]["edad"] = $arrTMP['edad'];
            $arrData[$arrTMP['alumno']]["genero"] = $arrTMP['genero'];
            $arrData[$arrTMP['alumno']]["grupo_etnico"] = $arrTMP['grupo_etnico'];
            $arrData[$arrTMP['alumno']]["idioma_materno"] = $arrTMP['idioma_materno'];
            $arrData[$arrTMP['alumno']]["grupo_etnia_nombre"] = $arrTMP['grupo_etnia_nombre'];
            $arrData[$arrTMP['alumno']]["idioma_materno_nombre"] = $arrTMP['idioma_materno_nombre'];
            $arrData[$arrTMP['alumno']]["estado_civil"] = $arrTMP['estado_civil'];
            $arrData[$arrTMP['alumno']]["profesion_oficio"] = $arrTMP['profesion_oficio'];
            $arrData[$arrTMP['alumno']]["telefono"] = $arrTMP['telefono'];
            $arrData[$arrTMP['alumno']]["correo_electronico"] = $arrTMP['correo_electronico'];
            $arrData[$arrTMP['alumno']]["direccion"] = $arrTMP['direccion'];
            $arrData[$arrTMP['alumno']]["departamento"] = $arrTMP['departamento'];
            $arrData[$arrTMP['alumno']]["nombre_departamento"] = $arrTMP['nombre_departamento'];
            $arrData[$arrTMP['alumno']]["municipio"] = $arrTMP['municipio'];
            $arrData[$arrTMP['alumno']]["nombre_municipio"] = $arrTMP['nombre_municipio'];
            $arrData[$arrTMP['alumno']]["area_geografica"] = $arrTMP['area_geografica'];
            $arrData[$arrTMP['alumno']]["trabaja_actualmente"] = $arrTMP['trabaja_actualmente'];
            $arrData[$arrTMP['alumno']]["discapasidad"] = $arrTMP['discapasidad'];
            $arrData[$arrTMP['alumno']]["curso_alumno"] = $arrTMP['curso_alumno'];
            $arrData[$arrTMP['alumno']]["fecha_incripcion"] = $arrTMP['fecha_incripcion'];
            $arrData[$arrTMP['alumno']]["nombre_docente"] = $arrTMP['nombre_docente'];
            $arrData[$arrTMP['alumno']]["programa"] = $arrTMP['programa'];
            $arrData[$arrTMP['alumno']]["modalidad"] = $arrTMP['modalidad'];
            $arrData[$arrTMP['alumno']]["etapa_grado_curso"] = $arrTMP['etapa_grado_curso'];
        }
        
        return $arrData;
    }
    
    
}
  
?>
 