<?php
/*************************************************************
    Developer: Tito De León
    Tel:        5430-6466
    Correo:     compuaserv@gmail.com, tito_de_leon@hotmail.com
*************************************************************/
include_once('core/php_conexion.php');
class curso_cursos_model{
    
    public function getCursosInicio(){
        $arrData = array();
        $strQuery = "SELECT curso,
                            nombre,
                            fecha_inicio,
                            fecha_fin,
                            tecnico_docente,
                            activo
                     FROM   curso";
        $sql = mysql_query($strQuery);
        while($arrTMP = mysql_fetch_array($sql)){
            
            $arrData[$arrTMP['curso']]["curso"] = $arrTMP['curso'];
            $arrData[$arrTMP['curso']]["nombre"] = $arrTMP['nombre'];
            $arrData[$arrTMP['curso']]["fecha_inicio"] = $arrTMP['fecha_inicio'];
            $arrData[$arrTMP['curso']]["fecha_fin"] = $arrTMP['fecha_fin'];
            $arrData[$arrTMP['curso']]["tecnico_docente"] = $arrTMP['tecnico_docente'];
            $arrData[$arrTMP['curso']]["activo"] = $arrTMP['activo'];
        }
        
        return $arrData;
    }
    
    public function getCursos($strCurso = ""){
        $arrData = array();
        $strQuery = "SELECT curso.curso,
                            curso.nombre,
                            curso.fecha_inicio,
                            curso.fecha_fin,
                            curso.tecnico_docente,
                            curso.activo
                     FROM   curso
                     WHERE MD5(curso.curso) = '{$strCurso}'";
        $sql = mysql_query($strQuery);
        while($arrTMP = mysql_fetch_array($sql)){
            
            $intCurso = $arrData["curso"] = $arrTMP['curso'];
            $arrData["nombre"] = $arrTMP['nombre'];
            $arrData["fecha_inicio"] = $arrTMP['fecha_inicio'];
            $arrData["fecha_fin"] = $arrTMP['fecha_fin'];
            $arrData["tecnico_docente"] = $arrTMP['tecnico_docente'];
            $arrData["activo"] = $arrTMP['activo'];
            
            
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
        }
        
        return $arrData;
    }
    
    public function fntUpdateCurso( $intCurso, $strNombre, $strFechaInicio , $strFechaFin, $strTecnicoDocente, $chkActivo ){
         
        
         $intPersona = $_SESSION["persona"];
         $strQuery = "  UPDATE  curso
                        SET     nombre = '{$strNombre}',
                                fecha_inicio = '{$strFechaInicio}',
                                fecha_fin = '{$strFechaFin}',
                                tecnico_docente = '{$strTecnicoDocente}',
                                activo = '{$chkActivo}',
                                mod_user = {$intPersona},
                                mod_fecha = now()
                        WHERE   curso = {$intCurso}";
           mysql_query($strQuery);
        
    }
    
    public function fntInsertCurso( $strNombre, $strFechaInicio , $strFechaFin, $strTecnicoDocente, $chkActivo ){
        
        $intId = 0;
        $intPersona = $_SESSION["persona"];
        if(   !empty($strNombre) && !empty($strFechaInicio) ){
            
           $strQuery = "INSERT INTO curso(nombre,fecha_inicio,fecha_fin,tecnico_docente,activo,add_user,add_fecha )
                          VALUES('{$strNombre}','{$strFechaInicio}','{$strFechaFin}','{$strTecnicoDocente}','{$chkActivo}',{$intPersona},now())";
            mysql_query($strQuery);              
           $intId = mysql_insert_id();
           return $intId;
        }
    }
    
    public function db_fetch_array($argIndex) {
        return mysql_fetch_array($argIndex);
    }
    
    public function fntTipo(){
        $sql = "show columns from usuario like 'tipo'";

        $resultado = mysql_query($sql); 
        $fila = mysql_fetch_array($resultado); 
        
        $resultado = mysql_query($sql); 
        $fila = mysql_fetch_array($resultado);
        $cadenavalor = $fila[1];
        $cadenavalor = preg_replace("enum", "", $cadenavalor);
        $cadenavalor = preg_replace("\)", "", $cadenavalor);
        $cadenavalor = preg_replace("\'", "", $cadenavalor);
        $valores = explode(",", $cadenavalor);
        return $valores;
    }
    
    public function getHoras($intHoraSelected = -1){
        $arrInfo = array();

        $intHora = 0;

        $arrInfo[-1]["texto"] = "HH";
        $arrInfo[-1]["selected"] = $intHoraSelected == -1 ? true : false;

        while($intHora < 24){
            $arrInfo[$intHora]["texto"] = $intHora >= 0 && $intHora < 10 ? "0".$intHora : $intHora;
            $arrInfo[$intHora]["selected"] = $intHoraSelected == $intHora ? true : false;
            $intHora++;
        }

        return $arrInfo;
    }
    
    public function getMinutos($intMinutoSelected = -1){
        $arrInfo = array();

        $intMinuto = 0;

        $arrInfo[-1]["texto"] = "MM";
        $arrInfo[-1]["selected"] = $intMinutoSelected == -1 ? true : false;

        while($intMinuto < 60){
            $arrInfo[$intMinuto]["texto"] = $intMinuto >= 0 && $intMinuto < 10 ? "0".$intMinuto : $intMinuto;
            $arrInfo[$intMinuto]["selected"] = $intMinutoSelected == $intMinuto ? true : false;
            $intMinuto+=5;
        }

        return $arrInfo;
    }
    
    public function getDias($strHoraSelected){
        $arrInfo = array();

       // $arrInfo[-1]["texto"] = "HH";
        //$arrInfo[-1]["selected"] = $intHoraSelected == -1 ? true : false;


        $arrInfo["LUNES"]["texto"] = "Lunes";
        $arrInfo["LUNES"]["selected"] = false;
        $arrInfo["MARTES"]["texto"] = "Martes";
        $arrInfo["MARTES"]["selected"] = false;
        $arrInfo["MIERCOLES"]["texto"] = "Miercoles";
        $arrInfo["MIERCOLES"]["selected"] = false;
        $arrInfo["JUEVES"]["texto"] = "Jueves";
        $arrInfo["JUEVES"]["selected"] = false;
        $arrInfo["VIERNES"]["texto"] = "Viernes";
        $arrInfo["VIERNES"]["selected"] = false;
        $arrInfo["SABADO"]["texto"] = "Sabado";
        $arrInfo["SABADO"]["selected"] = false;
        $arrInfo["DOMINGO"]["texto"] = "Domingo";
        $arrInfo["DOMINGO"]["selected"] = false;
        
        foreach( $arrInfo as $key => $value  ){
            //print $strHoraSelected."==".$key."<br>";
            if( $strHoraSelected == $key ){
                $arrInfo[$strHoraSelected]["selected"] = true;
            }
        }
        
        
        //$arrInfo["LUNES"]["selected"] = $intHoraSelected == $intHora ? true : false;


        return $arrInfo;
    }
    
    public function insertCursoHorario($intCurso, $strDia, $strHorarioInicio, $strHorarioFin){
        
        $intPersona = $_SESSION["persona"];
        $strQuery = " INSERT INTO curso_horario(curso,dia,hora_inicio,hora_fin,add_user,add_fecha)
                          VALUES({$intCurso},'{$strDia}','{$strHorarioInicio}','{$strHorarioFin}',{$intPersona},now())";
        mysql_query($strQuery);
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
    
    
}
  
?>
 