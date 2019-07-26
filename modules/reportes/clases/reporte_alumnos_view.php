<?php
/*************************************************************
    Developer: Tito De León
    Tel:        5430-6466
    Correo:     compuaserv@gmail.com, tito_de_leon@hotmail.com
*************************************************************/

require_once("modules/reportes/clases/reporte_alumnos_model.php");

class reporte_alumnos_view{
    
    private $objModel;
    private $objView;
    
    public function __construct(){
        $this->objModel = new reporte_alumnos_model();
    }
    
    
    public function drawContentButtom($strPersona){
        global $strAction;
       // print $strPersona;
        ?>
         <div class="row">
            <div class="col-lg-12" align="right" >
                <h1 class="page-header" id="btnHeadder" >
                    <p><button type="button" class="btn circle-arrow-down btn-primary btn-sm" onclick="fntDownloadOption('excel');" >Excel</button></p>
                </h1>
            </div>
        </div>
        
        <?php
    }
    
    public function drawContentPersonaButtom($strPersona){
       // print "a ".$strPersona;
       global $strAction;
        ?>
         <div class="row">
            <div class="col-lg-12" align="right" >
                <h1 class="page-header" id="btnHeadder" >
                    <p>
                        <?php 
                        $strDisplay = $strPersona != "new" ? "none" : "";
                        if( $strPersona != "new"  ){
                            ?>
                            <!--<button id="idEditar" style="display: " type="button" class="btn btn-outline btn-primary btn-sm" onclick="document.location = '<?php print $strAction ?>'" >Regresar</button>
                            <button id="idEliminar" style="display: " type="button" class="btn btn-outline btn-primary btn-sm"  data-toggle="modal" data-target="#exampleModal" >Eliminar</button>
                            <button id="idEditar" style="display: " type="button" class="btn btn-outline btn-primary btn-sm" onclick="fntEditar();" >Editar</button>-->
                            <?php 
                            }
                        ?>
                        <!--<button id="idGuardar" style="display: <?php print $strDisplay ?>" type="button" class="btn btn-outline btn-primary btn-sm" onclick="fntGuardar();" >Guardar</button>-->
                    </p>
                </h1>
            </div>
        </div>
        <?php
    }
    
    public function drawContent(){
        global $strAction;
        
        
        //$arrGetCursos = $this->objModel->getCursosInicio();
        ?>
         <form id="frmReporteAlumno" name="frmReporteAlumno" method="POST" action="<?php print $strAction; ?>" onsubmit="" class=""  >
         <div id="divContent" class="panel panel-primary">
             <div class="panel-body">
                 
                    <div class="form-group">
                        <label for="txtFechaInicio" class="col-lg-2 control-label">
                            <?php print "Fecha inicio" ?>
                        </label>
                        <div class="col-lg-2">
                            <?php
                            //$mes = date("m");
                            //$anio = date("Y");
                            //$strPrimeroMes = date("d-m-Y",mktime(0,0,0,$mes,1,$anio));

                            ?>
                            <input type="text" id="txtDatepickerInicio" name="txtDatepickerInicio" value="" >

                        </div>
                        <label for="txtFechaFin" class="col-lg-2 control-label" >
                            <?php print "Fecha fin" ?>
                        </label>
                        <div class="col-lg-2">
                            <input type="text" id="txtDatepickerFin" name="txtDatepickerFin" value="" >
                        </div>
                        <label for="txtEstudiante" class="col-lg-2 control-label">
                            <?php print "Nombre"; ?>
                        </label>
                        <div class="col-lg-2">
                            <?php
                                print "";
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-1 col-lg-offset-11 text-right">
                             <button type="button" class="btn btn-primary" onclick="fntBusqueda()"  >Buscar</button>
                        </div>
                    </div>
                    <div id="divEjecutarValidarFecha"></div>  
             </div>
         </div>
         </form>

        <script>
            var objAjaxBuscar;
                $("#txtDatepickerInicio").datepicker({
                //showOn: "both",
                dateFormat: 'yy-mm-dd',
                monthNames: ['Enero', 'Febreo', 'Marzo',
                            'Abril', 'Mayo', 'Junio',
                            'Julio', 'Agosto', 'Septiembre',
                            'Octubre', 'Noviembre', 'Diciembre'],
                monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun','Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
                buttonImage: "calendar-icon.jpg"
            }).on( "change", function() {

                $("#hdnDatepickerInicio").val($(this).val());
            });
            
            $("#txtDatepickerFin").datepicker({
                //showOn: "both",
                dateFormat: 'yy-mm-dd',
                monthNames: ['Enero', 'Febreo', 'Marzo',
                            'Abril', 'Mayo', 'Junio',
                            'Julio', 'Agosto', 'Septiembre',
                            'Octubre', 'Noviembre', 'Diciembre'],
                monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun','Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
                buttonImage: "calendar-icon.jpg"
            }).on( "change", function() {

                $("#hdnDatepickerFin").val($(this).val());
            });
            
            function fntBusqueda(){
                var boolError = true;
                
                if( boolError ){
               // $("#btnDescargar").show();  
                    if(objAjaxBuscar) objAjaxBuscar.abort();      
                        objAjaxBuscar =  $.ajax({
                            url:"<?php print $strAction; ?>",
                            async: false,
                            type:'post',
                            data: $("#frmReporteAlumno").serialize()+"&ajaxDrawRegistrosBusqueda=true"+"&params="+$("#hdnAlumno").val(),
                            beforeSend:function(){
                           // showImgCoreLoading();
                        },
                            success:function(data){
                           // hideImgCoreLoading();
                            $("#divEjecutarValidarFecha").html("");
                            $("#divEjecutarValidarFecha").html(data);
                            return false;
                        }
                    });

                }
            }
        </script>

        
        
        <?php
    }
    
    public function drawListadoAlumnos($strFechaInicio, $strFechaFin){
        $arrListadoAlumnos = $this->objModel->getRegistroEstudiantes($strFechaInicio, $strFechaFin);
        
        ?>
        <div class="form-group">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped" id="tblAsignacion">
                        <thead>                
                            <tr>
                                <td width="">Nombre</td>
                                <td width="" class="text-center" >Apellidos</td>
                                <td width="">DPI</td>
                                <td width="">Edad</td>
                                <td width="">Genero</td>
                                <td width="">Grupo Etnico</td>
                                <td width="">Idioma Materno</td>
                                <td width="">Estado Civil</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if( isset($arrListadoAlumnos) && count($arrListadoAlumnos)){
                                 reset($arrListadoAlumnos);
                                 $intCorrelativo = 1;
                                 foreach ( $arrListadoAlumnos as $arrTMP  ){
                                    ?>
                                    <tr>
                                        <td width="20%"><?php print $arrTMP["nombres"]; ?></td>
                                        <td width="20%"><?php print $arrTMP["apellidos"]; ?></td>
                                        <td width="20%"><?php print $arrTMP["identificacion"]; ?></td>
                                        <td width="20%"><?php print $arrTMP["edad"]; ?></td>
                                        <td width="20%"><?php print $arrTMP["genero"]; ?></td>
                                        <td width="20%"><?php print $arrTMP["grupo_etnia_nombre"]; ?></td>
                                        <td width="20%"><?php print $arrTMP["idioma_materno_nombre"]; ?></td>
                                        <td width="20%"><?php print $arrTMP["estado_civil"]; ?></td>
                                    </tr>
                                    <?php
                                    $intCorrelativo ++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script>
             function fntDownloadOption(strOption){

                document.frmReporteAlumno.target = "_blank";
                if(strOption == "pdf"){
                    //document.frmReporteAlumno.action = "<?php echo $strAction; ?>?strTipoDescarga="+strOption+"&strTipo="+$("#sltTipoReporte").val();
                }
                else{
                    document.frmReporteAlumno.action = "<?php echo $strAction; ?>?strTipoDescarga="+strOption;     
                }
                document.frmReporteAlumno.submit();
            }
        </script>
        <?php
    }
    
    public function drawListadoAlumnosExcel($strFechaInicio, $strFechaFin, $hdnUsuario, $objPHPExcel){
        
        $arrListadoAlumnos = $this->objModel->getRegistroEstudiantes($strFechaInicio, $strFechaFin);
        
        
         $intHeader = 1;
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A".$intHeader, utf8_encode("No."));
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue("B".$intHeader, utf8_encode("CODIGO DE MINEDUC (del estudiante)"));
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue("C".$intHeader, utf8_encode("NOMBRES"));
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue("D".$intHeader, utf8_encode("APELLIDOS"));
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue("E".$intHeader, utf8_encode("DPI o Certificado de nacimiento"));
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue("F".$intHeader, utf8_encode("EDAD"));
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue("G".$intHeader, utf8_encode("GENERO"));
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue("H".$intHeader, utf8_encode("GRUPO ÉTNICO"));
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue("I".$intHeader, utf8_encode("IDIOMA MATERNO"));
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue("J".$intHeader, utf8_encode("OTROS IDIOMAS"));
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue("K".$intHeader, utf8_encode("ESTADO CIVIL"));
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue("L".$intHeader, utf8_encode("PROFESION U OFICIO"));
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue("M".$intHeader, utf8_encode("TELEFONO"));
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue("N".$intHeader, utf8_encode("Correo Electronico"));
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue("O".$intHeader, utf8_encode("DIRECCIÓN (residencia)"));
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue("P".$intHeader, utf8_encode("MUNICIPIO (residencia)"));
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue("Q".$intHeader, utf8_encode("DEPARTAMENTO (residencia)"));
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue("R".$intHeader, utf8_encode("AREA GEOGRAFICA"));
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue("S".$intHeader, utf8_encode("TRABAJA ACTUALMENTE"));
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue("T".$intHeader, utf8_encode("DISCAPACIDAD"));
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue("U".$intHeader, utf8_encode("FECHA DE INSCRIPCIÓN"));
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue("V".$intHeader, utf8_encode("NOMBRE DEL TÉCNICO/DOCENTE"));
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue("W".$intHeader, utf8_encode("PROGRAMA"));
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue("X".$intHeader, utf8_encode("No. de NUFED"));
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue("Y".$intHeader, utf8_encode("MODALIDAD"));
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue("Z".$intHeader, utf8_encode("GRADO, ETAPA O CURSO QUE RECIBE"));
         
         $intHeader ++;
         $intCorrelativo = $intHeader;
         $i = 1;
         foreach ( $arrListadoAlumnos as $arrTMP  ){
              $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A".$intCorrelativo, utf8_encode($i));
              $objPHPExcel->setActiveSheetIndex(0)->setCellValue("B".$intCorrelativo, utf8_encode($arrTMP["nombres"]));
              $objPHPExcel->setActiveSheetIndex(0)->setCellValue("C".$intCorrelativo, utf8_encode($arrTMP["nombres"]));
              $objPHPExcel->setActiveSheetIndex(0)->setCellValue("D".$intCorrelativo, utf8_encode($arrTMP["apellidos"]));
              $objPHPExcel->setActiveSheetIndex(0)->setCellValue("E".$intCorrelativo, utf8_encode($arrTMP["identificacion"]));
              $objPHPExcel->setActiveSheetIndex(0)->setCellValue("F".$intCorrelativo, utf8_encode($arrTMP["edad"]));
              $objPHPExcel->setActiveSheetIndex(0)->setCellValue("G".$intCorrelativo, utf8_encode($arrTMP["genero"]));
              
              $objPHPExcel->setActiveSheetIndex(0)->setCellValue("H".$intCorrelativo, utf8_encode($arrTMP["grupo_etnia_nombre"]));
              
              $objPHPExcel->setActiveSheetIndex(0)->setCellValue("I".$intCorrelativo, utf8_encode($arrTMP["idioma_materno_nombre"]));
              
              $objPHPExcel->setActiveSheetIndex(0)->setCellValue("J".$intCorrelativo, utf8_encode(""));
              
              $objPHPExcel->setActiveSheetIndex(0)->setCellValue("K".$intCorrelativo, utf8_encode($arrTMP["estado_civil"]));
              $objPHPExcel->setActiveSheetIndex(0)->setCellValue("L".$intCorrelativo, utf8_encode($arrTMP["profesion_oficio"]));
              $objPHPExcel->setActiveSheetIndex(0)->setCellValue("M".$intCorrelativo, utf8_encode($arrTMP["telefono"]));
              $objPHPExcel->setActiveSheetIndex(0)->setCellValue("N".$intCorrelativo, utf8_encode($arrTMP["correo_electronico"]));
              $objPHPExcel->setActiveSheetIndex(0)->setCellValue("O".$intCorrelativo, utf8_encode($arrTMP["direccion"]));
              $objPHPExcel->setActiveSheetIndex(0)->setCellValue("P".$intCorrelativo, utf8_encode($arrTMP["nombre_municipio"]));
              $objPHPExcel->setActiveSheetIndex(0)->setCellValue("Q".$intCorrelativo, utf8_encode($arrTMP["nombre_departamento"]));
              
              $objPHPExcel->setActiveSheetIndex(0)->setCellValue("R".$intCorrelativo, utf8_encode($arrTMP["area_geografica"]));
              $objPHPExcel->setActiveSheetIndex(0)->setCellValue("S".$intCorrelativo, utf8_encode($arrTMP["trabaja_actualmente"]));
              $objPHPExcel->setActiveSheetIndex(0)->setCellValue("T".$intCorrelativo, utf8_encode($arrTMP["discapasidad"]));
              
              $objPHPExcel->setActiveSheetIndex(0)->setCellValue("U".$intCorrelativo, utf8_encode($arrTMP["fecha_incripcion"]));
              $objPHPExcel->setActiveSheetIndex(0)->setCellValue("V".$intCorrelativo, utf8_encode($arrTMP["nombre_docente"]));
              $objPHPExcel->setActiveSheetIndex(0)->setCellValue("W".$intCorrelativo, utf8_encode("CEMUCAF"));
              $objPHPExcel->setActiveSheetIndex(0)->setCellValue("X".$intCorrelativo, utf8_encode(""));
              $objPHPExcel->setActiveSheetIndex(0)->setCellValue("Y".$intCorrelativo, utf8_encode($arrTMP["modalidad"]));
              $objPHPExcel->setActiveSheetIndex(0)->setCellValue("Z".$intCorrelativo, utf8_encode($arrTMP["etapa_grado_curso"]));
              
              $intCorrelativo++;
              $i++;
         }
         
         
         return $objPHPExcel;
    }
}
?>
 