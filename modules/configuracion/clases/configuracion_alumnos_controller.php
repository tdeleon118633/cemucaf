<?php
/*************************************************************
    Developer: Tito De León
    Tel:        5430-6466
    Correo:     compuaserv@gmail.com, tito_de_leon@hotmail.com
*************************************************************/

require_once("modules/configuracion/clases/configuracion_alumnos_view.php");

class configuracion_alumnos_controller{
    
    private $objView;
    private $strPersona;
    public function __construct(){
        $this->objModel = new configuracion_alumnos_model();
        $this->objView = new configuracion_alumnos_view();
    }
    
    public function setPersona(){
        $strPersona = isset($_GET["alumno"]) ? $_GET["alumno"] : "";
        $this->strPersona = $strPersona;
    }

    public function getPersona(){
        return $this->strPersona;
    }
    
    public function drawContent(){
        if( isset($_GET["alumno"]) ){

            $this->objView->drawContentAlumno( $this->getPersona() );
        }
        else{
            $this->objView->drawContent();
        }
    }
    
    public function drawButtom(){
        if( isset($_GET["alumno"]) ){

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
        global $strAction;
        $boolInsert = true;
        //print_r($_POST);
        //print_r($_FILES);
        //die();
        if( isset($_POST['hdnNombreAlumno'])){
            $intAlumno = isset($_POST["hdnNombreAlumno"]) ? $_POST["hdnNombreAlumno"]: 0;
            $strNombreAlumno = isset($_POST["txtNombreAlumno"]) ? $_POST["txtNombreAlumno"] : "";
            $strApellidosAlumno = isset($_POST["txtApellidosAlumno"]) ? $_POST["txtApellidosAlumno"] : "";
            $strDPIAlumno = isset($_POST["txtDPIAlumno"]) ? $_POST["txtDPIAlumno"] : "";
            $intEdadAlumno = isset($_POST["txtEdadAlumno"]) ? $_POST["txtEdadAlumno"] : "";
            $strGeneroAlumno = isset($_POST["slcGeneroAlumno"]) ? $_POST["slcGeneroAlumno"] : "";
            $strGrupoEtnicoAlumno = isset($_POST["slcGrupoEtnico"]) ? $_POST["slcGrupoEtnico"] : "";
            $strIdiomaMaternoAlumno = isset($_POST["slcIdiomaMaterno"]) ? $_POST["slcIdiomaMaterno"] : "";
            $strEstadoCivilAlumno = isset($_POST["slcEstadoCivil"]) ? $_POST["slcEstadoCivil"] : "";
            $strProfecionAlumno = isset($_POST["txtProfecionOficio"]) ? $_POST["txtProfecionOficio"] : "";
            $strTelefonoAlumno = isset($_POST["txtTelefono"]) ? $_POST["txtTelefono"] : "";
            $strCorreoElectronico = isset($_POST["txtCorreoElectronico"]) ? $_POST["txtCorreoElectronico"] : "";
            $strDepartamentoAlumno = isset($_POST["slcDepartamento"]) ? $_POST["slcDepartamento"] : "";
            $strMunicipioAlumno = isset($_POST["slcMunicipio"]) ? $_POST["slcMunicipio"] : "";
            $strDireccionAlumno = isset($_POST["txtDireccion"]) ? $_POST["txtDireccion"] : "";
            $strAreaGeograficaAlumno = isset($_POST["slcAreaGeografica"]) ? $_POST["slcAreaGeografica"] : "";
            $strTrabajaAlumno = isset($_POST["slcTrabaja"]) ? $_POST["slcTrabaja"] : "";
            $strDiscapacidadAlumno = isset($_POST["slcDiscapacidad"]) ? $_POST["slcDiscapacidad"] : "";
            $strAdjuntoAlumno = isset($_POST["txtAdjuntoCurso"]) ? $_POST["txtAdjuntoCurso"] : "";
            $strIMG = $_FILES["txtAdjuntoCurso"]["name"];
            $strTMPIMG = $_FILES["txtAdjuntoCurso"]["tmp_name"];
            
            $strInputFileName = "";
            $strExtraPath = "programa_curso";
            $strAtelacionArchivo = "";
            $intImagenId = 0;
            
            $strExtraPath = core_removeSpecialChars($strExtraPath);
            if(!empty($strExtraPath)){
                if(substr($strExtraPath,-1,1) != "/" ){
                    $strExtraPath = $strExtraPath."/";
                }
            }
            
            $strPath = "attach/";
            $strPath = $strPath.$strExtraPath;
            $strPathAndFile = "";
            if( !file_exists($strPath) ){
                mkdir($strPath,777,true);
            }
            
          //  if( !file_exists($strExtraPath."_1.jpg") ){
               // @chmod("attach/lib_images",0777);
                move_uploaded_file($strTMPIMG, $strPath."programa_curso_{$intAlumno}.jpg");
              //  @chmod($strExtraPath."_1.jpg",0777);
           // }
            
            //PRINT $strPath.$strExtraPath."_1.jpg";
            $strPath = $strPath."programa_curso_{$intAlumno}.jpg";
            $chkActivo = isset($_POST["chkActivo"]) ? "Y" : "N";
      
            
            if( $intAlumno > 0 ){
                
                 $this->objModel->fntUpdateAlumno( $intAlumno, $strNombreAlumno, $strApellidosAlumno , $strDPIAlumno, $intEdadAlumno, $strGeneroAlumno, $strGrupoEtnicoAlumno, $strIdiomaMaternoAlumno ,$strEstadoCivilAlumno, $strProfecionAlumno, $strTelefonoAlumno, $strCorreoElectronico, $strDepartamentoAlumno, $strMunicipioAlumno, $strDireccionAlumno, $strAreaGeograficaAlumno, $strTrabajaAlumno, $strDiscapacidadAlumno, $strPath, $chkActivo );
            
            }
            else{
               $intAlumno  =  $this->objModel->fntInsertUsuario( $strNombreAlumno, $strApellidosAlumno , $strDPIAlumno, $intEdadAlumno, $strGeneroAlumno, $strGrupoEtnicoAlumno, $strIdiomaMaternoAlumno ,$strEstadoCivilAlumno, $strProfecionAlumno, $strTelefonoAlumno, $strCorreoElectronico, $strDepartamentoAlumno, $strMunicipioAlumno, $strDireccionAlumno, $strAreaGeograficaAlumno, $strTrabajaAlumno, $strDiscapacidadAlumno, $chkActivo );
                
            }
            
            if( $boolInsert ){
                    //$this->strAlert = 'ins';
                    //$this->strPersona = md5($intPersona);
                    ?>
                    <script>
                        document.location = "<?php echo $strAction."?alumno=".(md5($intAlumno))."&strAlert=ins"; ?>";
                    </script>
                    <?php
                    die();
                }
         }
        
        
    }
    
    public function fntEliminar(){
        
        if( isset($_POST["hdnEliminar"]) && $_POST["hdnEliminar"] == "Y" ){
            $intAlumno = isset($_POST["hdnNombreAlumno"]) ? $_POST["hdnNombreAlumno"]: 0;
            $this->objModel->fntDeleteAlumno($intAlumno);
            
            ?>
            <script>
                document.location = "<?php echo $strAction."?strAlert=eli"; ?>";
            </script>
            <?php
        }
    }
    
    
}
  
?>
 