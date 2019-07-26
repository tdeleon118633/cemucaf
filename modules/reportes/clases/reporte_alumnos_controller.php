<?php
/*************************************************************
    Developer: Tito De León
    Tel:        5430-6466
    Correo:     compuaserv@gmail.com, tito_de_leon@hotmail.com
*************************************************************/

require_once("modules/reportes/clases/reporte_alumnos_view.php");

class reporte_alumnos_controller{
    
    private $objView;
    private $strPersona;
    public function __construct(){
        $this->objModel = new reporte_alumnos_model();
        $this->objView = new reporte_alumnos_view();
    }
    
    public function setPersona(){
        $strPersona = isset($_GET["curso"]) ? $_GET["curso"] : "";
        $this->strPersona = $strPersona;
    }

    public function getPersona(){
        return $this->strPersona;
    }
    
    public function drawContent(){
        /*if( isset($_GET["curso"]) ){

            $this->objView->drawContentPersona( $this->getPersona() );
        }
        else{*/
            $this->objView->drawContent();
       // }
    }
    
    public function drawButtom(){
        if( isset($_GET["curso"]) ){

           $this->objView->drawContentPersonaButtom( $this->getPersona() );
        }
        else{
            $this->objView->drawContentButtom($this->getPersona());
        }
    }
    
    public function setPrincipal(){
        $this->objView->getPrincipal();
    }
    
    public function fntPost(){
        
        $boolInsert = true;
        if( isset($_POST['hdnCurso'])){
            $intCurso = isset($_POST["hdnCurso"]) ? $_POST["hdnCurso"]: 0;
            $strNombre = isset($_POST["txtNombreCurso"]) ? $_POST["txtNombreCurso"] : "";
            $strFechaInicio = isset($_POST["hdnDatepickerInicio"]) ? $_POST["hdnDatepickerInicio"] : "";
            $strFechaFin = isset($_POST["hdnDatepickerFin"]) ? $_POST["hdnDatepickerFin"] : "";
            $chkActivo = isset($_POST["chkActivo"]) ? "Y" : "N";
            if( $intCurso > 0 ){
                
                 $this->objModel->fntUpdateCurso( $intCurso, $strNombre, $strFechaInicio , $strFechaFin, $chkActivo);
            
            }
            else{
               $intCurso  =  $this->objModel->fntInsertCurso( $strNombre, $strFechaInicio , $strFechaFin, $chkActivo );
                
            }
            
            
            reset($_POST);
            while( $qTMP = each($_POST) ){
                $arrExplode = explode("-",$qTMP["key"]);
                if( $arrExplode[0] == "slcHoraInicio" && isset($arrExplode[1])){
                    if($_POST["slcHoraInicio-".$arrExplode[1]] != -1 && $_POST["slcMinutoInicio-".$arrExplode[1]] != -1 && $_POST["slcHoraFin-".$arrExplode[1]] != -1 && $_POST["slcMinutoFin-".$arrExplode[1]] != -1){
                            
                            $intHorario = isset($_POST["hdnHorario-".$arrExplode[1]]) ? $_POST["hdnHorario-".$arrExplode[1]] : "";
                            //$intCurso = isset($_POST["hdnCurso-".$arrExplode[1]]) ? $_POST["hdnCurso-".$arrExplode[1]] : "";
                            $strDia = isset($_POST["slcDia-".$arrExplode[1]]) ? $_POST["slcDia-".$arrExplode[1]] : "";
                            
                            $strHoraInicio =  $_POST["slcHoraInicio-".$arrExplode[1]] >= 0 && $_POST["slcHoraInicio-".$arrExplode[1]] < 10 ? "0".$_POST["slcHoraInicio-".$arrExplode[1]] : $_POST["slcHoraInicio-".$arrExplode[1]];
                            $strMinutoInicio =  $_POST["slcMinutoInicio-".$arrExplode[1]] >= 0 && $_POST["slcMinutoInicio-".$arrExplode[1]] < 10 ? "0".$_POST["slcMinutoInicio-".$arrExplode[1]] : $_POST["slcMinutoInicio-".$arrExplode[1]];
                            $strHoraFin =  $_POST["slcHoraFin-".$arrExplode[1]] >= 0 && $_POST["slcHoraFin-".$arrExplode[1]] < 10 ? "0".$_POST["slcHoraFin-".$arrExplode[1]] : $_POST["slcHoraFin-".$arrExplode[1]];
                            $strMinutoFin =  $_POST["slcMinutoFin-".$arrExplode[1]] >= 0 && $_POST["slcMinutoFin-".$arrExplode[1]] < 10 ? "0".$_POST["slcMinutoFin-".$arrExplode[1]] : $_POST["slcMinutoFin-".$arrExplode[1]];
                            $strHorarioInicio = $strHoraInicio.":".$strMinutoInicio.":"."00";
                            $strHorarioFin = $strHoraFin.":".$strMinutoFin.":"."00";
                            
                            if( isset($_POST["hdnDeleteHorario-".$arrExplode[1]]) && $_POST["hdnDeleteHorario-".$arrExplode[1]] == "Y"){
                                
                                //$this->objModel->deleteCursoHorario( $intHorario);
                                $this->objModel->deleteCursoHorario($intHorario);

                            }
                            if( isset($_POST["hdnUpdateHorario-".$arrExplode[1]]) && $_POST["hdnUpdateHorario-".$arrExplode[1]] == "Y" ){
                                $this->objModel->fntUpdateCursoHorario($intHorario, $intCurso, $strDia, $strHorarioInicio, $strHorarioFin );
                            }
                            
                            if( isset($_POST["hdnNew-".$arrExplode[1]])  && $_POST["hdnNew-".$arrExplode[1]] == 'Y' ) {
                                //print $intCurso.' - '.$strDia.' - '.$strHorarioInici.' - '.$strHorarioFin."<br>";
                                $this->objModel->insertCursoHorario($intCurso, $strDia, $strHorarioInicio, $strHorarioFin);
                            }
                    }
                }
            }
            // $intId = "********* ".$intUsuario;
            //die();
            if( $boolInsert ){
                    //$this->strAlert = 'ins';
                    //$this->strPersona = md5($intPersona);
                    ?>
                    <script>
                        document.location = "<?php echo $strAction."?curso=".(md5($intCurso))."&strAlert=ins"; ?>"; 
                    </script>
                    <?php
                    //die();
                }
         }
        
        
    }
    
    public function fntAjax(){
        
         if( isset($_POST["ajaxDrawRegistrosBusqueda"]) ){
            header("Content-Type: text/html; charset=iso-8859-1");
            
            $intDiaInicio = isset($_POST["txtDatepickerInicio"]) ? $_POST["txtDatepickerInicio"] : 1;
            $intMesInicio = isset($_POST["txtDatepickerFin"]) ? $_POST["txtDatepickerFin"] : 1;
           /* $intAnioInicio = isset($_POST["txtFechaInicio_anio"]) ? intval($_POST["txtFechaInicio_anio"]) : 0;
            
            $strFechaInicio = date("Y-m-d",mktime(0,0,0,$intMesInicio,$intDiaInicio,$intAnioInicio));
            
            $intDiaFin = isset($_POST["txtFechaFin_dia"]) ? intval($_POST["txtFechaFin_dia"]) : 1;
            $intMesFin = isset($_POST["txtFechaFin_mes"]) ? intval($_POST["txtFechaFin_mes"]) : 1;
            $intAnioFin = isset($_POST["txtFechaFin_anio"]) ? intval($_POST["txtFechaFin_anio"]) : 0;
            
            $strFechaFin = date("Y-m-d",mktime(0,0,0,$intMesFin,$intDiaFin,$intAnioFin));
            
            $intEstudiante = isset($_POST["params"]) ? intval($_POST["params"]) : 0;*/
            
            $this->objView->drawListadoAlumnos($intDiaInicio, $intMesInicio); 
            
            die();        
        }
        if( isset($_GET["strTipoDescarga"]) && $_GET["strTipoDescarga"] == "excel" ){
             //header("Content-Type: text/html; charset=iso-8859-1");
            
            include_once("libraries/PHPExcel.php");
            
            
             
            $objPHPExcel = new PHPExcel();
            //$objPHPExcel->setActiveSheetIndex(0)->setCellValue("A1", "DdSASA");
            $strFechaInicio  = isset($_GET["fecha_inicio"]) ? $_GET["fecha_inicio"] : "";
            $strFechaFin  = isset($_GET["fecha_fin"]) ? $_GET["fecha_fin"] : "";
            $hdnUsuario  = "";
            
            $objPHPExcel = $this->objView->drawListadoAlumnosExcel($strFechaInicio, $strFechaFin, $hdnUsuario, $objPHPExcel);
            
            header( "Content-type: application/vnd.ms-excel" );
            header('Content-Disposition: attachment;filename="archivoPagos222.xls"');
            header("Pragma: no-cache");
            header("Expires: 0");
            
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            ob_end_clean();
            ob_start();
           
            $boolDescargar = false;
            
            
            if(!$boolDescargar){
                //Relativo
              
                $objWriter->save('php://output');
                
            }
            
            if($boolDescargar){
                //Absoluta
                $objWriter->save('attach/achivoPagos.xls');
            }
             
             
            exit;
            die();
        }
    }
    
    public function fntEliminar(){
        global $strAction;
        if( isset($_POST["hdnEliminar"]) && $_POST["hdnEliminar"] == "Y" ){
            $intCurso = isset($_POST["hdnCurso"]) ? $_POST["hdnCurso"] : 0;
            $this->objModel->fntDeleteCurso($intCurso);
            
            ?>
            <script>
                document.location = "<?php echo $strAction."?strAlert=eli"; ?>";
            </script>
            <?php
        }
        
        
    }
    
    
}
  
?>
 