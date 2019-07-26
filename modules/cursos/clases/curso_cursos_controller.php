<?php
/*************************************************************
    Developer: Tito De León
    Tel:        5430-6466
    Correo:     compuaserv@gmail.com, tito_de_leon@hotmail.com
*************************************************************/

require_once("modules/cursos/clases/curso_cursos_view.php");

class curso_cursos_controller{
    
    private $objView;
    private $strPersona;
    public function __construct(){
        $this->objModel = new curso_cursos_model();
        $this->objView = new curso_cursos_view();
    }
    
    public function setPersona(){
        $strPersona = isset($_GET["curso"]) ? $_GET["curso"] : "";
        $this->strPersona = $strPersona;
    }

    public function getPersona(){
        return $this->strPersona;
    }
    
    public function drawContent(){
        if( isset($_GET["curso"]) ){

            $this->objView->drawContentPersona( $this->getPersona() );
        }
        else{
            $this->objView->drawContent();
        }
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
            $strFechaInicio = isset($_POST["txtDatepickerInicio"]) ? $_POST["txtDatepickerInicio"] : "";
            $strFechaFin = isset($_POST["txtDatepickerFin"]) ? $_POST["txtDatepickerFin"] : "";
            $strTecnicoDocente = isset($_POST["txtTecnicoDocente"]) ? $_POST["txtTecnicoDocente"] : "";
            $chkActivo = isset($_POST["chkActivo"]) ? "Y" : "N";
            if( $intCurso > 0 ){
                
                 $this->objModel->fntUpdateCurso( $intCurso, $strNombre, $strFechaInicio , $strFechaFin, $strTecnicoDocente, $chkActivo);
            
            }
            else{
               $intCurso  =  $this->objModel->fntInsertCurso( $strNombre, $strFechaInicio , $strFechaFin, $strTecnicoDocente, $chkActivo );
                
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
 