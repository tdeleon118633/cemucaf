<?php
/*************************************************************
    Developer: Tito De León
    Tel:        5430-6466
    Correo:     compuaserv@gmail.com, tito_de_leon@hotmail.com
*************************************************************/
                                      
require_once("modules/usuarios/clases/adm_perfiles_acceso_view.php");

class adm_perfiles_acceso_controller{
    
    private $objView;
    private $strPersona;
    public function __construct(){
        $this->objModel = new adm_perfiles_acceso_model();
        $this->objView = new adm_perfiles_acceso_view();
    }
    
    public function setPersona(){
        $strPersona = isset($_GET["persona"]) ? $_GET["persona"] : "";
        $this->strPersona = $strPersona;
    }

    public function getPersona(){
        return $this->strPersona;
    }
    
    public function drawContent(){
        if( isset($_GET["persona"]) ){

            $this->objView->drawContentPersona( $this->getPersona() );
        }
        else{
            $this->objView->drawContent();
        }
    }
    
    public function drawButtom(){
        if( isset($_GET["persona"]) ){

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
        if( isset($_POST['hdnUsuario'])){
            $intUsuario = isset($_POST["hdnUsuario"]) ? $_POST["hdnUsuario"]: 0;
            $strNombre1 = isset($_POST["txtNombreUsuario"]) ? $_POST["txtNombreUsuario"] : "";
            $strNombre2 = isset($_POST["txtNombreUsuario2"]) ? $_POST["txtNombreUsuario2"] : "";
            $strApellido1 = isset($_POST["txtApellidoUsuario"]) ? $_POST["txtApellidoUsuario"] : "";
            $strApellido2 = isset($_POST["txtApellidoUsuario2"]) ? $_POST["txtApellidoUsuario2"] : "";
            $strApellidoCasada = isset($_POST["txtApellidoCasada"]) ? $_POST["txtApellidoCasada"] : "";
            $chkActivo = isset($_POST["chkActivo"]) ? "Y" : "N";
            
            $strUsuario = isset($_POST["txtUsuario"]) ? $_POST["txtUsuario"]: 0;
            $strContrasena = isset($_POST["txtConfirmarPassword"]) ? $_POST["txtConfirmarPassword"] : "";
            $slcTipo = isset($_POST["slcTipo"]) ? $_POST["slcTipo"] : "";
            //print $slcTipo;
            //die();
            
            if( $intUsuario > 0 ){
                
                 $this->objModel->fntUpdateUsuario( $intUsuario, $strNombre1, $strNombre2 , $strApellido1, $strApellido2, $strApellidoCasada, $strUsuario, $strContrasena ,$chkActivo, $slcTipo );
            
            }
            else{
               $intUsuario  =  $this->objModel->fntInsertUsuario( $intUsuario, $strNombre1, $strNombre2 , $strApellido1, $strApellido2, $strApellidoCasada, $strUsuario, $strContrasena ,$chkActivo, $slcTipo );
                
            }
            // $intId = "********* ".$intUsuario;
            //die();
            if( $boolInsert ){
                    //$this->strAlert = 'ins';
                    //$this->strPersona = md5($intPersona);
                    ?>
                    <script>
                        document.location = "<?php echo $strAction."?persona=".(md5($intUsuario))."&strAlert=ins"; ?>";
                    </script>
                    <?php
                    //die();
                }
         }
        
        
    }
    
    
}
  
?>
 