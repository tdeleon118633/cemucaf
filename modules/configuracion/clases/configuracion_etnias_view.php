<?php
//include_once("adm_usuarios_model.php");
//include_once("adm_usuarios_controller.php");

require_once("modules/configuracion/clases/configuracion_etnias_model.php");

class configuracion_etnias_view{
    
    private $objModel;
    private $objView;
    
    public function __construct(){
        $this->objModel = new configuracion_etnias_model();
    }
    
    
    public function drawContentButtom(){
        ?>
         <div class="row">
            <div class="col-lg-12" align="right" >
                <h1 class="page-header" id="btnHeadder" >
                    <p><button type="button" class="btn btn-outline btn-primary btn-sm" onclick="document.location.href='<?php print $strAction; ?>?etnia=new'" >Nuevo</button></p>
                </h1>
            </div>
        </div>
        
        <?php
    }
    
    public function drawContentEtniaButtom($strPersona){
       // print "a ".$strPersona;
        ?>
         <div class="row">
            <div class="col-lg-12" align="right" >
                <h1 class="page-header" id="btnHeadder" >
                    <p>
                        <?php 
                        $strDisplay = $strPersona != "new" ? "none" : "";
                        if( $strPersona != "new"  ){
                            ?>
                            <button id="idRegresar" style="display: " type="button" class="btn btn-outline btn-primary btn-sm" onclick="fntRegresar()"  >Regresar</button>
                            <button id="idEliminar" style="display: " type="button" class="btn btn-outline btn-primary btn-sm"  data-toggle="modal" data-target="#exampleModal" >Eliminar</button>
                            <button id="idEditar" style="display: " type="button" class="btn btn-outline btn-primary btn-sm" onclick="fntEditar();" >Editar</button>
                            <?php 
                            }
                        ?>
                        <button id="idGuardar" style="display: <?php print $strDisplay ?>" type="button" class="btn btn-outline btn-primary btn-sm" onclick="fntGuardar();" >Guardar</button>
                    </p>
                </h1>
            </div>
        </div>
        <?php
    }
    
    public function drawContent(){
         
        
        
        $arrGetEtnia = $this->objModel->getEtnia();
        
        if( isset($arrGetEtnia) && count($arrGetEtnia)  ){
            ?>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">&nbsp;</div>
                        <!-- /.panel-heading -->
                         <div class="table-responsive">
                            <div class="panel-body">
                                <table class="table-striped table">
                                    <thead>
                                        <tr>
                                            <td><strong>Nombre</strong></td>
                                            <td><strong><center>Activo</center></strong></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                           foreach (  $arrGetEtnia as $arrTMP  ){
                                               ?>
                                               <tr>
                                                   <td>
                                                       <a href="<?php echo $strAction."?etnia=".md5($arrTMP["etnia"]); ?>" class="link"><?php echo $arrTMP["nombre"]; ?></a>
                                                   </td>
                                                   <td align="center" ><?php echo $arrTMP['activo'] == "Y" ? "Si" : "No"; ?></td>
                                               </tr>
                                           <?php
                                            }
                                          ?>      
                                    </tbody>
                                </table>
                           </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>
            <!-- /.row -->

            <?php
        }
        else{
            ?>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <i class="fa fa-info-circle" style="font-size:24px;color:red"></i>
                    Sin Informaci&oacute;n almacenada
                </div>
            </div>
            <?php
        }
    }
    
    public function drawContentPersona($strEtnia){
        global $strAction;
        //print $strEtnia;
        $arrInfoEtnia = $this->objModel->getEtniaId($strEtnia);
        
        $boolModoEdicion = $strEtnia != "new" ? true : false;
        $strDisplay = $boolModoEdicion ? "none" : "";
        ?>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar Etnia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Esta seguro que quiere eliminar este registro?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="fntCancelar()" >Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="fntEliminar()"  >Eliminar</button>
              </div>
            </div>
          </div>
        </div>    
            
        <form id="frmEtnia" name="frmEtnia" method="POST" action="<?php print $strAction; ?>" onsubmit="" class=""  >
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">&nbsp;</div>
                        <!-- /.panel-heading -->
                         <div class="table-responsive">
                            <div class="panel-body">
                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-6">
                                         <div id="divTienda" class="form-group">
                                            <label for="sltNombre" class="col-md-6 control-label">
                                                Nombre
                                            </label>
                                            <div class="col-md-6">
                                                <div id="divReqTienda" class="form-group ocultar">
                                                    <div class="col-md-12">
                                                        <?php 
                                                            $strNombre = isset($arrInfoEtnia["nombre"]) ? $arrInfoEtnia["nombre"] : "";
                                                            $intEtnia = isset($arrInfoEtnia["etnia"]) ? $arrInfoEtnia["etnia"] : 0;
                                                            
                                                         ?>
                                                         <input type="text" style="display: <?php print $strDisplay ?>" class="form-control" id="txtNombreEtnia" name="txtNombreEtnia" placeholder="Nombre" value="<?php print $strNombre ?>" >
                                                         <input type=hidden  id="hdnEtnia" name="hdnEtnia" value="<?php print $intEtnia ?>" >
                                                         <input type=hidden  id="hdnEliminar" name="hdnEliminar" value="N" >
                                                         
                                                        <div id="divReadMode_txtNombreEtnia" name="divReadMode_txtNombreEtnia"  ><?php print $strNombre ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-offset-2 col-md-6">
                                         <div id="divTienda" class="form-group">
                                            <label for="sltDescripcion" class="col-md-6 control-label">
                                                Descripci&oacuten
                                            </label>
                                            <div class="col-md-6">
                                                <div id="divReqTienda" class="form-group ocultar">
                                                    <div class="col-md-12">
                                                        <?php 
                                                            $strDescripcion = isset($arrInfoEtnia["descripcion"]) ? $arrInfoEtnia["descripcion"] : "";
                                                            //$intEtnia = isset($arrInfoEtnia["etnia"]) ? $arrInfoEtnia["etnia"] : 0;
                                                         ?>
                                                        <textarea style="display: <?php print $strDisplay ?>" class="form-control" id="txtDescripcionEtnia" name="txtDescripcionEtnia" placeholder="Descripci&oacute;n"  ><?php print $strDescripcion ?></textarea>
                                                        <div id="divReadMode_txtDescripcionEtnia" name="divReadMode_txtDescripcionEtnia"  ><?php print $strDescripcion ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-offset-2 col-md-6">
                                         <div id="divTienda" class="form-group">
                                            <label for="sltNombre" class="col-md-6 control-label form-control-static">
                                                Activo
                                            </label>
                                            <div class="col-md-6">
                                                <div id="divReqTienda" class="form-group ocultar">
                                                    <div class="col-md-6 form-control-static text-left">
                                                        <?php 
                                                            $strActivo = isset($arrInfoEtnia["activo"]) ? $arrInfoEtnia["activo"] : "";
                                                            $cheket =  $strActivo == "Y" ? "checked" : "";
                                                        ?>
                                                        <input  type="checkbox" style="display: <?php print $strDisplay ?>" class="form-control" id="chkActivo" name="chkActivo" class="form-check-input " placeholder="Nombre" <?php print $cheket ?> value="<?php print $strActivo ?>" >
                                                        <div class="form-control-static break-text "  id="divReadMode_chkActivo" name="divReadMode_chkActivo" id="divReadMode_chkActivo"  ><?php print $strActivo ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                           </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>
        </form>
        <script>
            
            function fntEditar(){
                $("#idGuardar").show();
                $("#idEditar").hide();
                $("#idEliminar").hide();
                $("[id^='divReadMode']").each(function(){
                   arrSplit = $(this).attr("id").split("_");
                   $(this).hide();
                   $("#"+arrSplit[1]).show();
                   console.log(arrSplit[1]);

                });
            }
            
            function fntGuardar(){
                var boolError = false;
                
                strNombreUsuario = $("#txtNombreEtnia").val().length;
                
                if( strNombreUsuario == 0  ){
                        //$("#tabTipoNota a[href=\"#divContentTipoNota\"]").tab("show");
                     fntValido("txtNombreEtnia","Nombre");
                     boolError = true;
                 }
                

                if( !boolError ){
                    document.frmEtnia.submit();
                }

            }
            
            function fntValido(txtObjeto, txtConten){
                
                $("#"+txtObjeto).popover({
                     placement: 'bottom',
                     container: "body",
                     content: txtConten,
                     animation: true,
                     trigger: "manual"
                 }).popover("show").click(function(){
                     $(this).popover("destroy");
                 });
                
            }
            
            function fntEliminar(){
                $("#hdnEliminar").val("Y");
                document.frmEtnia.submit();
            }
            
            function fntCancelar(){
                 $("#hdnEliminar").val("N");
            }
            
            function fntRegresar(){
                document.location = "<?php echo $strAction; ?>";
            }
        </script>
        <?php
    }
    
    
}
?>
 