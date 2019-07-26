<?php

require_once("modules/configuracion/clases/configuracion_etnias_view.php");

class configuracion_etnias_controller{
    
    private $objView;
    private $strPersona;
    public function __construct(){
        $this->objModel = new configuracion_etnias_model();
        $this->objView = new configuracion_etnias_view();
    }
    
    public function setPersona(){
        $strPersona = isset($_GET["etnia"]) ? $_GET["etnia"] : "";
        $this->strPersona = $strPersona;
    }

    public function getPersona(){
        return $this->strPersona;
    }
    
    public function drawContent(){
        if( isset($_GET["etnia"]) ){
            $this->objView->drawContentPersona( $this->getPersona() );
        }
        else{
            $this->objView->drawContent();
        }
    }
    
    public function drawButtom(){
        if( isset($_GET["etnia"]) ){

           $this->objView->drawContentEtniaButtom( $this->getPersona() );
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
        if( isset($_POST['hdnEtnia']) && isset($_POST["hdnEliminar"]) && $_POST["hdnEliminar"] == "N" ){
            $intEtnia = isset($_POST["hdnEtnia"]) ? $_POST["hdnEtnia"]: 0;
            $strNombre = isset($_POST["txtNombreEtnia"]) ? $_POST["txtNombreEtnia"] : "";
            $strDescripcion = isset($_POST["txtDescripcionEtnia"]) ? $_POST["txtDescripcionEtnia"] : "";
            $chkActivo = isset($_POST["chkActivo"]) ? "Y" : "N";

            if( $intEtnia > 0 ){
                
                 $this->objModel->fntUpdateEtnia( $intEtnia, $strNombre, $strDescripcion ,$chkActivo);
            
            }
            else{
               $intEtnia  =  $this->objModel->fntInsertEtnia($strNombre, $strDescripcion,$chkActivo );
                
            }
            
            if( $boolInsert  ){
                    //$this->strAlert = 'ins';
                    //$this->strPersona = md5($intPersona);
                    ?>
                    <script>
                        document.location = "<?php echo $strAction."?etnia=".(md5($intEtnia))."&strAlert=ins"; ?>";
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
 