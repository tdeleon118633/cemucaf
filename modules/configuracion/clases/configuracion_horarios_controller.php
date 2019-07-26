<?php

require_once("modules/configuracion/clases/configuracion_departamentos_view.php");

class configuracion_departamentos_controller{
    
    private $objView;
    private $strDepto;
    public function __construct(){
        $this->objModel = new configuracion_departamentos_model();
        $this->objView = new configuracion_departamentos_view();
    }
    
    public function setDepto(){
        $strDepto = isset($_GET["departamento"]) ? $_GET["departamento"] : "";
        $this->strDepto = $strDepto;
    }

    public function getDepto(){
        return $this->strDepto;
    }
    
    public function drawContent(){
        if( isset($_GET["departamento"]) ){
            $this->objView->drawContentDepto( $this->getDepto() );
        }
        else{
            $this->objView->drawContent();
        }
    }
    
    public function drawButtom(){
        if( isset($_GET["departamento"]) ){

           $this->objView->drawContentEtniaButtom( $this->getDepto() );
        }
        else{
            $this->objView->drawContentButtom();
        }
    }
    
    public function setPrincipal(){
        $this->objView->getPrincipal();
    }
    
    public function fntPost(){
        
        $boolInsert = true;
        if( isset($_POST['hdnDepartamento']) && isset($_POST["hdnEliminar"]) && $_POST["hdnEliminar"] == "N" ){
            $intDepto = isset($_POST["hdnDepartamento"]) ? $_POST["hdnDepartamento"]: 0;
            $strNombre = isset($_POST["txtNombreEtnia"]) ? $_POST["txtNombreEtnia"] : "";
            $strDescripcion = isset($_POST["txtDescripcionEtnia"]) ? $_POST["txtDescripcionEtnia"] : "";
            $chkActivo = isset($_POST["chkActivo"]) ? "Y" : "N";

            if( $intDepto > 0 ){
                
                 $this->objModel->fntUpdateEtnia( $intDepto, $strNombre, $strDescripcion ,$chkActivo);
            
            }
            else{
               $intDepto  =  $this->objModel->fntInsertEtnia($strNombre, $strDescripcion,$chkActivo );
                
            }
            
            if( $boolInsert  ){
                    //$this->strAlert = 'ins';
                    //$this->strPersona = md5($intPersona);
                    ?>
                    <script>
                        document.location = "<?php echo $strAction."?departamento=".(md5($intDepto))."&strAlert=ins"; ?>";
                    </script>
                    <?php
                    //die();
                }
                
         }
        
        
    }
    
    public function fntEliminar(){
        
        if( isset($_POST["hdnEliminar"]) && $_POST["hdnEliminar"] == "Y" ){
            $intDepto = isset($_POST["hdnDepartamento"]) ? $_POST["hdnDepartamento"]: 0;
            $this->objModel->fntDeleteDepto($intDepto);
            
            ?>
            <script>
                document.location = "<?php echo $strAction."?strAlert=eli"; ?>";
            </script>
            <?php
        }
        
        
    }
    
    
}
  
?>
 