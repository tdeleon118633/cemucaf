<?php

require_once("modules/usuarios/clases/adm_usuarios_view.php");

class adm_usuarios_controller{
    
    private $objView;
    public function __construct(){
        $this->objModel = new adm_usuarios_model();
        $this->objView = new adm_usuarios_view();
    }
    
    public function setPrincipal(){
        $this->objView->getPrincipal();
    }
    
    
}
  
?>
 