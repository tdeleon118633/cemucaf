<?php

require_once("modules/asignaciones/clases/asignacion_asignar_view.php");

class asignacion_asignar_controller{
    
    private $objView;
    private $strPersona;
    public function __construct(){
        $this->objModel = new asignacion_asignar_model();
        $this->objView = new asignacion_asignar_view();
    }
    
    public function setPersona(){
        $strPersona = isset($_GET["asignacion"]) ? $_GET["asignacion"] : "";
        $this->strPersona = $strPersona;
    }

    public function getPersona(){
        return $this->strPersona;
    }
    
    public function drawContent(){
        if( isset($_GET["asignacion_alumno"]) ){
          //  $this->objView->drawContentPersona( $this->getPersona() );
        }
        else{
            $this->objView->drawContent();
        }
    }
    
    public function drawButtom(){
        if( isset($_GET["asignacion_alumno"]) ){

           $this->objView->drawContentEtniaButtom( $this->getPersona() );
        }
        else{
            $this->objView->drawContentButtom();
        }
    }
    
    public function setPrincipal(){
        $this->objView->getPrincipal();
    }
    
    public function runAjax(){
        
        if( isset($_GET["sendAutoCompleteCarne"]) ){
            header("Content-Type: text/html; charset=iso-8859-1");
            $arrResult = array();
            
            //$strParametro = db_escape(user_input_delmagic($_GET["term"], true));
            $strParametro = $_GET["term"];
            $arrCursos = $this->objModel->getInfoBusqueda($strParametro);
            while ( $rTMP = each($arrCursos) ){
                
                $arrTMP = array();
                $arrTMP["id"] = $rTMP["value"]["curso"];                  
                $arrTMP["value"] = $rTMP["value"]["nombre"];
                array_push($arrResult, $arrTMP);
            }
            print json_encode($arrResult);
            
            die();
            
        }
        else if( isset($_GET["sendAutoCompleteAlumno"]) ){
            header("Content-Type: text/html; charset=iso-8859-1");
            $arrResult = array();
            
            //$strParametro = db_escape(user_input_delmagic($_GET["term"], true));
            $strParametro = $_GET["term"];
            $arrCursos = $this->objModel->getInfoBusquedaAlumno($strParametro);
            while ( $rTMP = each($arrCursos) ){
                
                $arrTMP = array();
                $arrTMP["id"] = $rTMP["value"]["alumno"];                  
                $arrTMP["value"] = $rTMP["value"]["nombre_alumno"];
                array_push($arrResult, $arrTMP);
            }
            print json_encode($arrResult);
            
            die();
            
        }
        else if( isset($_POST["getCursoAsignar"])){
            header("Content-Type: text/html; charset=iso-8859-1");
            
            $intCurso = isset($_POST["intCurso"]) ? intval($_POST["intCurso"]) : 0; 
                                 
            $this->objView->drawCursoAsignar( $intCurso );
            
            die();
        }
    }
    
    public function fntPost(){
        
        $boolInsert = true;
        //print_r($_POST);
        if( isset($_POST['hdnIdCurso']) && isset($_POST["hdnEliminar"]) && $_POST["hdnEliminar"] == "N" ){

            $intCurso = isset($_POST["hdnIdCurso"]) ? $_POST["hdnIdCurso"]: 0;
            //print_r($_POST);
            while( $qTMP = each($_POST) ){
                $arrExplode = explode("_",$qTMP["key"]);
               
                if( $arrExplode[0] == "hdnIdAlumno" && isset($arrExplode[1])){
                    if($_POST["hdnIdAlumno_".$arrExplode[1]] ){
                         print "------->";    
                        $intCursoAlumno = isset($_POST["hdnCursoAlumno_".$arrExplode[1]]) ? $_POST["hdnCursoAlumno_".$arrExplode[1]] : "";
                        $intAlumno = isset($_POST["hdnIdAlumno_".$arrExplode[1]]) ? $_POST["hdnIdAlumno_".$arrExplode[1]] : "";
                        $strAsignar = $_POST["hdnAsignado_".$arrExplode[1]] == "Y" ? "Y" : "N";
                        // = isset($_POST["hdnIdAlumno_".$arrExplode[1]]) ? $_POST["hdnIdAlumno_".$arrExplode[1]] : "";
                            
                          //print $intCursoAlumno." - ".$intCurso." - ".$intAlumno." - ".$strAsignar;
                          if( isset($_POST["hdnDeleteAlumno_".$arrExplode[1]]) && $_POST["hdnDeleteAlumno_".$arrExplode[1]] == "Y"){
                                
                                $this->objModel->deleteCursoAlumno( $intCursoAlumno);

                            }
                            if( isset($_POST["hdnUpdateAlumno_".$arrExplode[1]]) && $_POST["hdnUpdateAlumno_".$arrExplode[1]] == "Y" ){
                                $this->objModel->fntUpdateAlumno($intCursoAlumno,$intCurso, $intAlumno, $strAsignar);
                            }
                            
                            if( isset($_POST["hdnNew_".$arrExplode[1]])  && $_POST["hdnNew_".$arrExplode[1]] == 'Y' ) {
                                $this->objModel->insertAlumno($intCurso, $intAlumno, $strAsignar);
                            }
                    }
                }
            }
            
            if( $boolInsert  ){
                    //$this->strAlert = 'ins';
                    //$this->strPersona = md5($intPersona);
                    ?>
                    <script>
                       // document.location = "<?php echo $strAction."?etnia=".(md5($intEtnia))."&strAlert=ins"; ?>";
                    </script>
                    <?php
                    //die();
                }
                
         }
        
        
    }
    
    public function fntEliminar(){
        
        if( isset($_POST["hdnEliminar"]) && $_POST["hdnEliminar"] == "Y" ){
            $intEtnia = isset($_POST["hdnEtnia"]) ? $_POST["hdnEtnia"]: 0;
            $this->objModel->fntDeleteEtnia($intEtnia);
            
            ?>
            <script>
                document.location = "<?php echo $strAction."?strAlert=eli"; ?>";
            </script>
            <?php
        }
        
        
    }
    
    
}
  
?>
 