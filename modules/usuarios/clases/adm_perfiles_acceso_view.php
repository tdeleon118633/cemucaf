<?php
/*************************************************************
    Developer: Tito De León
    Tel:        5430-6466
    Correo:     compuaserv@gmail.com, tito_de_leon@hotmail.com
*************************************************************/

require_once("modules/usuarios/clases/adm_perfiles_acceso_model.php");

class adm_perfiles_acceso_view{
    
    private $objModel;
    private $objView;
    
    public function __construct(){
        $this->objModel = new adm_perfiles_acceso_model();
    }
    
    
    public function drawContentButtom($strPersona){
        global $strAction;
       // print $strPersona;
        ?>
         <div class="row">
            <div class="col-lg-12" align="right" >
                <h1 class="page-header" id="btnHeadder" >
                    <p><button type="button" class="btn btn-outline btn-primary btn-sm" onclick="document.location.href='<?php print $strAction; ?>?persona=new'" >Nuevo</button></p>
                </h1>
            </div>
        </div>
        
        <?php
    }
    
    public function drawContentPersonaButtom($strPersona){
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
         
        
        
        $arrGetUsuario = $this->objModel->getUsuario();
        ?>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background-color: #149dee" >&nbsp;</div>
                        <!-- /.panel-heading -->
                         <div class="table-responsive">
                            <div class="panel-body">
                                <table class="table-striped table">
                                    <thead>
                                        <tr><td><strong>Nombre</strong></td>
                                            <td><strong>Usuario</strong></td>
                                            <td><strong><center>Activo</center></strong></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                           foreach (  $arrGetUsuario as $arrTMP  ){
                                               ?>
                                               <tr>
                                                   <td>
                                                       <a href="<?php echo $strAction."?persona=".md5($arrTMP["persona"]); ?>" class="link"><?php echo $arrTMP["nombre1"]; ?></a>
                                                   </td>
                                                   <td><?php echo $arrTMP['usuario']; ?></td>
                                                   <td align="center" ><?php echo $arrTMP['bloqueado'] == "Y" ? "Si" : "No"; ?></td>
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
    
    public function drawContentPersona($strPersonaId){
        
        $arrPersonaId = $this->objModel->getUsuarioId($strPersonaId);
        //print_r($arrPersonaId);
       // print $strPersonaId;
        $boolModoEdicion = $strPersonaId != "new" ? true : false;
        $strDisplay = $boolModoEdicion ? "none" : "";
        $strTipo = $this->objModel->fntTipo();
        //print "BOOLEANO ".$boolModoEdicion;
        ?>
        
        <!--<div class="col-lg-12" style="padding: 5px; border-radius: 5px;">
            <ul class="nav nav-tabs" id="tabsContainer">
                <li class="active">
                    <a href="#tabsContainerA" data-toggle="tab" onclick="fntPanel(this)"  >
                       a
                    </a>
                 </li>
                 <li class="">
                    <a href="#tabsContainerB" data-toggle="tab" onclick="fntPanel(this)"  >
                       B
                    </a>
                </li>
            </ul>
            <div class="tab-content ">
                <div class="tab-pane active" id="tabsContainerA"  >
                    A
                </div>
                <div class="tab-pane " id="tabsContainerB" >
                    B
                </div>
            </div>
        </div>-->
            
        <form id="frmUnidades" name="frmUnidades" method="POST" action="<?php print $strAction; ?>" onsubmit="" class=""  >
            <div class="col-lg-12" style="padding: 5px; border-radius: 5px;">
                <ul class="nav nav-tabs" id="tabsContainer">
                    <li class="active">
                        <a href="#tabsContainerA" data-toggle="tab" onclick="fntPanel(this)"  >
                           Informacion
                        </a>
                     </li>
                     <li class="">
                        <a href="#tabsContainerB" data-toggle="tab" onclick="fntPanel(this)"  >
                           My cuenta
                        </a>
                    </li>
                </ul>
                <div class="tab-content ">
                    <div class="tab-pane active" id="tabsContainerA"  >
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <!--<div class="panel-heading">fasdfadsf</div>-->
                                    <!-- /.panel-heading -->
                                     <div class="table-responsive">
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <div class="col-md-offset-2 col-md-6">
                                                     <div  id="divTienda" class="form-group">
                                                        <label  for="sltNombre" class="col-md-6 control-label form-control-static">
                                                            Primer Nombre
                                                        </label>
                                                        <div class="col-md-6">
                                                            <div id="divReqTienda" class="form-group ocultar">
                                                                <div class="col-md-12 form-control-static">
                                                                    <?php 
                                                                        $strPersona = isset($arrPersonaId["nombre1"]) ? $arrPersonaId["nombre1"] : "";
                                                                        $intPersonaId = isset($arrPersonaId["persona"]) ? $arrPersonaId["persona"] : 0;
                                                                       ?>
                                                                    <input type="text" style="display: <?php print $strDisplay ?>" class="form-control" id="txtNombreUsuario" name="txtNombreUsuario" placeholder="Nombre" value="<?php print $strPersona ?>" >
                                                                    <input type=hidden  id="hdnUsuario" name="hdnUsuario" value="<?php print $intPersonaId ?>" >
                                                                    <div  class="form-control-static break-text " id="divReadMode_txtNombreUsuario" name="divReadMode_txtNombreUsuario"  ><?php print $strPersona ?></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                     <div id="divTienda" class="form-group">
                                                        <label for="sltNombre" class="col-md-6 control-label form-control-static">
                                                            Segundo Nombre
                                                        </label>
                                                        <div class="col-md-6">
                                                            <div id="divReqTienda" class="form-group ocultar">
                                                                <div class="col-md-12 form-control-static">
                                                                    <?php $strPersona2 = isset($arrPersonaId["nombre2"]) ? $arrPersonaId["nombre2"] : "" ?>
                                                                    <input type="text" style="display: <?php print $strDisplay ?>" class="form-control" id="txtNombreUsuario2" name="txtNombreUsuario2" placeholder="Nombre" value="<?php print $strPersona2 ?>" >
                                                                    <div class="form-control-static break-text" id="divReadMode_txtNombreUsuario2"  name="divReadMode_txtNombreUsuario2"  ><?php print $strPersona2 ?></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                     <div id="divTienda" class="form-group">
                                                        <label for="sltNombre" class="col-md-6 control-label form-control-static">
                                                            Primer Apellido
                                                        </label>
                                                        <div class="col-md-6">
                                                            <div id="divReqTienda" class="form-group ocultar">
                                                                <div class="col-md-12 form-control-static">
                                                                    <?php $strApellido1 = isset($arrPersonaId["apellido1"]) ? $arrPersonaId["apellido1"] : "" ?>
                                                                    <input type="text" style="display: <?php print $strDisplay ?>" class="form-control" id="txtApellidoUsuario" name="txtApellidoUsuario" placeholder="Nombre" value="<?php print $strApellido1 ?>" >
                                                                    <div class="form-control-static break-text " id="divReadMode_txtApellidoUsuario" name="divReadMode_txtApellidoUsuario"  ><?php print $strApellido1 ?></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                     <div id="divTienda" class="form-group">
                                                        <label for="sltNombre" class="col-md-6 control-label form-control-static">
                                                            Segundo Apellido
                                                        </label>
                                                        <div class="col-md-6">
                                                            <div id="divReqTienda" class="form-group ocultar">
                                                                <div class="col-md-12 form-control-static">
                                                                    <?php $strApellido2 = isset($arrPersonaId["apellido2"]) ? $arrPersonaId["apellido2"] : "" ?>
                                                                    <input type="text" style="display: <?php print $strDisplay ?>" class="form-control" id="txtApellidoUsuario2" name="txtApellidoUsuario2" placeholder="Nombre" value="<?php print $strApellido2 ?>" >
                                                                    <div class="form-control-static break-text " name="divReadMode_txtApellidoUsuario2" id="divReadMode_txtApellidoUsuario2"  ><?php print $strApellido2 ?></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                     <div id="divTienda" class="form-group">
                                                        <label for="sltNombre" class="col-md-6 control-label form-control-static">
                                                            Apellido Casada
                                                        </label>
                                                        <div class="col-md-6">
                                                            <div id="divReqTienda" class="form-group ocultar">
                                                                <div class="col-md-12 form-control-static">
                                                                    <?php $strApellidoCasada = isset($arrPersonaId["apellido_casada"]) ? $arrPersonaId["apellido_casada"] : "" ?>
                                                                    <input type="text" style="display: <?php print $strDisplay ?>" class="form-control" id="txtApellidoCasada" name="txtApellidoCasada" placeholder="Nombre" value="<?php print $strApellidoCasada ?>" >
                                                                    <div class="form-control-static break-text " name="divReadMode_txtApellidoCasada" id="divReadMode_txtApellidoCasada"  ><?php print $strApellidoCasada ?></div>
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
                    </div>
                    <div class="tab-pane " id="tabsContainerB" >
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <!--<div class="panel-heading">fasdfadsf</div>-->
                                    <!-- /.panel-heading -->
                                     <div class="table-responsive">
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <div class="col-md-offset-2 col-md-6">
                                                     <div  id="divUsuario" class="form-group">
                                                        <label  for="sltUsuario" class="col-md-6 control-label form-control-static">
                                                            Usuario
                                                        </label>
                                                        <div class="col-md-6">
                                                            <div id="divReqTienda" class="form-group ocultar">
                                                                <div class="col-md-12 form-control-static">
                                                                    <?php 
                                                                        $strUsuario = isset($arrPersonaId["usuario"]) ? $arrPersonaId["usuario"] : "";
                                                                       ?>
                                                                    <input type="text" style="display: <?php print $strDisplay ?>" class="form-control" id="txtUsuario" name="txtUsuario" placeholder="Nombre" value="<?php print $strUsuario ?>" >
                                                                    <div  class="form-control-static break-text " id="divReadMode_txtUsuario" name="divReadMode_txtUsuario"  ><?php print $strUsuario ?></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div  id="divContrasena" class="form-group" style="display:none">
                                                        <label  for="sltContrasena" class="col-md-6 control-label form-control-static">
                                                            Contrase&ntilde;a
                                                        </label>
                                                        <div class="col-md-6">
                                                            <div id="divReqTienda" class="form-group ocultar">
                                                                <div class="col-md-12 form-control-static">
                                                                    <input type="password" style="display: <?php print $strDisplay ?>" class="form-control" id="txtPassword" name="txtPassword" placeholder="Contrase&ntilde;a" value="" >
                                                                    <div  class="form-control-static break-text " id="divReadMode_txtPassword" name="divReadMode_txtPassword"  ><?php print "" ?></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div  id="divConfirmeContrasena" class="form-group" style="display:none">
                                                        <label  for="sltNombre" class="col-md-6 control-label form-control-static">
                                                            Confirmar Contrase&ntilde;a
                                                        </label>
                                                        <div class="col-md-6">
                                                            <div id="diConfirmeContrasena" class="form-group ocultar">
                                                                <div class="col-md-12 form-control-static">
                                                                   
                                                                    <input type="password" style="display: <?php print $strDisplay ?>" class="form-control" id="txtConfirmarPassword" name="txtConfirmarPassword" placeholder="Confirme contrase&ntilde;a" value="" >
                                                                    <div  class="form-control-static break-text " id="divReadMode_txtConfirmarPassword" name="divReadMode_txtConfirmarPassword"  ><?php print "" ?></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div  id="divCambiarContrasena" class="form-group" style="display:none">
                                                        <div class="col-md-12 text-center" style="background-color: aliceblue" >
                                                            <a id="MostraCambioContrasena" >Cambiar contrasena</a>
                                                        </div>
                                                    </div>
                                                    
                                                    <div  id="divUsuario" class="form-group">
                                                        <label  for="sltUsuario" class="col-md-6 control-label form-control-static">
                                                            Tipo de cuenta
                                                        </label>
                                                        <div class="col-md-6">
                                                            <div id="divReqTienda" class="form-group ocultar">
                                                                <div class="col-md-12 form-control-static">
                                                                    <select style="display: <?php print $strDisplay ?>"   class="form-control slcTipo" name="slcTipo" id="slcTipo" >
                                                                    <option value="0" >Seleccione un opcion</option>
                                                                     <?php 
                                                                        
                                                                        $strUsuario = isset($arrPersonaId["tipo"]) && $arrPersonaId["tipo"] == "admin" ? "Administrador" : "Normal";
                                                                        
                                                                         for ($i=0;$i<count($strTipo);$i++){ 
                                                                            $strTipo2 = $strTipo[$i] == "admin" ? "Administrador" : "Normal";
                                                                            $selected = $strTipo[$i] == $arrPersonaId["tipo"] ? "selected" : "";
                                                                            
                                                                            echo "<option value=".$strTipo[$i]." ".$selected." >".$strTipo2."</option>";
                                                                         }
                                                                       ?>
                                                                      </select>
                                                                    <div class="form-control-static break-text "  id="divReadMode_slcTipo" name="divReadMode_slcTipo"  ><?php print $strUsuario ?></div>
                                                                    <!--<select  class="form-control slcTipo" id="slcTipo">
                                                                        <option value="admin" >Administrador</option>
                                                                        <option value="normal" >Normal</option>
                                                                    </select>-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <div id="divTienda" class="form-group">
                                                        <label for="sltNombre" class="col-md-6 control-label form-control-static">
                                                            Bloquear usuario
                                                        </label>
                                                        <div class="col-md-6" >
                                                            <div id="divReqTienda" class="form-group ocultar" >
                                                                <div class="col-md-6 form-control-static text-left" >
                                                                    <?php 
                                                                        $strActivo = isset($arrPersonaId["bloqueado"]) ? $arrPersonaId["bloqueado"] : "";
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
                    </div>
                </div>
            </div>
        </form>
        <script>
            //$("#idGuardar").hide();
            <?php
            if(!$boolModoEdicion){
                ?>
                $("[id^='divReadMode']").hide();
                <?php
            }
            ?>
            
            function fntEditar(){
                
                $("#idGuardar").show();
                $("#idEditar").hide();
                
                $("[id^='divReadMode']").each(function(){
                   arrSplit = $(this).attr("id").split("_");
                   $(this).hide();
                   $("#"+arrSplit[1]).show();
                   $("#divCambiarContrasena").show();
                   
                   //ocultar contraseña
                   $("#divContrasena").hide();
                   $("#divConfirmeContrasena").hide();

                });
            }
            
            function fntGuardar(){
                var boolError = false;
                var boolRepetido = false;
                
                strNombreUsuario = $("#txtNombreUsuario").val().length;
                strNombreUsuario2 = $("#txtNombreUsuario2").val().length;
                strApellidoUsuario = $("#txtApellidoUsuario").val().length;
                strApellidoUsuario2 = $("#txtApellidoUsuario2").val().length;
                strTipo = $("#slcTipo").val();
                
                strUsuario = $("#txtUsuario").val().length;
                
                if( strNombreUsuario == 0  ){
                        //$("#tabTipoNota a[href=\"#divContentTipoNota\"]").tab("show");
                     fntValido("txtNombreUsuario","Primer nombre");
                     boolError = true;
                 }
                if( strNombreUsuario2 == 0   ){
                   fntValido("txtNombreUsuario2","Segundo nombre");
                   boolError = true;
                }
                if( strApellidoUsuario == 0  ) {
                   fntValido("txtApellidoUsuario","Primera apellido");
                   boolError = true;

                }
                if( strApellidoUsuario2 == 0 ){
                   fntValido("txtApellidoUsuario2","Segundo apellido");
                   boolError = true;
                }
                
                if( strUsuario == 0 ){
                   fntValido("txtUsuario","Usuario");
                   boolError = true;
                }
                
                if( strTipo ==  0){
                
                    $("select[name='slcTipo']").popover({

                      placement: 'bottom',
                      container: "body",
                      content: "Tipo de Cuenta",
                      animation: true,
                      trigger: "manual"
                  }).popover("show").click(function(){
                      $(this).popover("destroy");
                  });
                  boolError = true;
                }


                if( !boolError ){
                    document.frmUnidades.submit();
                }
                else{
                    /* if(boolRepetido){
                        PNotify.removeAll();
                        new PNotify({
                            title: 'Información',
                            text: 'Nombre repetido, porfavor verificar la información ingresada',
                            type: 'error',
                            buttons: {
                                closer: true,
                                closer_hover : false,
                                sticker: false
                            },
                            addclass: 'stack-modal',
                            stack: {'dir1': 'down', 'dir2': 'right', 'modal': true}
                        });    
                    }
                    else{
                        PNotify.removeAll();
                        new PNotify({
                            title: 'Información',
                            text: 'Por favor ingresa los campos que son obligatorios.',
                            type: 'error',
                            buttons: {
                                closer: true,
                                closer_hover : false,
                                sticker: false
                            },
                            addclass: 'stack-modal',
                            stack: {'dir1': 'down', 'dir2': 'right', 'modal': true}
                        });
                    }*/
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
            
            function fntPanel(obj){
                console.log(obj);
                $("idTabA").addClass("active")
            }
            
            //Muetras contraseña
            $("#MostraCambioContrasena").click(function(){
                //alert("test");
                $(this).hide();
                $("#divContrasena").show();
                $("#divConfirmeContrasena").show();
                
            })
        </script>
        
        <?php
    }
    
    
}
?>
 