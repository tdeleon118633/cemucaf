<?php
/*************************************************************
    Developer: Tito De León
    Tel:        5430-6466
    Correo:     compuaserv@gmail.com, tito_de_leon@hotmail.com
*************************************************************/

require_once("modules/usuarios/clases/adm_usuarios_model.php");

class adm_usuarios_view{
    
    private $objModel;
    private $objView;
    
    public function __construct(){
        $this->objModel = new adm_usuarios_model();
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
       global $strAction;
        ?>
         <div class="row">
            <div class="col-lg-12" align="right" >
                <h1 class="page-header" id="btnHeadder" >
                    <p>
                        <?php 
                        $strDisplay = $strPersona != "new" ? "none" : "";
                        if( $strPersona != "new"  ){
                            ?>
                            <button id="idEditar" style="display: " type="button" class="btn btn-outline btn-primary btn-sm" onclick="document.location = '<?php print $strAction ?>'" >Regresar</button>
                            <button id="idEditar" style="display: " type="button" class="btn btn-outline btn-primary btn-sm" onclick="$('#dialogEliminar').modal();" >Eliminar</button>
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
                                            <td class="text-center" ><strong>Bloqueado</strong></td>
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
                                                                    <input type="text" style="display: <?php print $strDisplay ?>" class="form-control" id="txtNombreUsuario" name="txtNombreUsuario" placeholder="Primer Nombre" value="<?php print $strPersona ?>" >
                                                                    <input type=hidden  id="hdnUsuario" name="hdnUsuario" value="<?php print $intPersonaId ?>" >
                                                                    <input type=hidden  id="hdnEditarPassword" name="hdnEditarPassword" value="N" >
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
                                                                    <input type="text" style="display: <?php print $strDisplay ?>" class="form-control" id="txtNombreUsuario2" name="txtNombreUsuario2" placeholder="Segundo Nombre" value="<?php print $strPersona2 ?>" >
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
                                                                    <input type="text" style="display: <?php print $strDisplay ?>" class="form-control" id="txtApellidoUsuario" name="txtApellidoUsuario" placeholder="Primer Apellido" value="<?php print $strApellido1 ?>" >
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
                                                                    <input type="text" style="display: <?php print $strDisplay ?>" class="form-control" id="txtApellidoUsuario2" name="txtApellidoUsuario2" placeholder="Segundo Apellido" value="<?php print $strApellido2 ?>" >
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
                                                                    <input type="text" style="display: <?php print $strDisplay ?>" class="form-control" id="txtApellidoCasada" name="txtApellidoCasada" placeholder="Apellido Casada" value="<?php print $strApellidoCasada ?>" >
                                                                    <div class="form-control-static break-text " name="divReadMode_txtApellidoCasada" id="divReadMode_txtApellidoCasada"  ><?php print $strApellidoCasada ?></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div id="divEmail" class="form-group">
                                                        <label for="sltNombre" class="col-md-6 control-label form-control-static">
                                                            Email
                                                        </label>
                                                        <div class="col-md-6">
                                                            <div id="divReqTienda" class="form-group ocultar">
                                                                <div class="col-md-12 form-control-static">
                                                                    <?php $strEmail = isset($arrPersonaId["email"]) ? $arrPersonaId["email"] : "" ?>
                                                                    <input type="text" style="display: <?php print $strDisplay ?>" class="form-control" id="txtEmail" name="txtEmail" placeholder="Email" value="<?php print $strEmail ?>" >
                                                                    <div class="form-control-static break-text " name="divReadMode_txtEmail" id="divReadMode_txtEmail"  ><?php print $strEmail ?></div>
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
                                                    <div  id="divUsuario" class="form-group">
                                                        <label  for="sltUsuario" class="col-md-6 control-label form-control-static">
                                                            Nombre de usuario
                                                        </label>
                                                        <div class="col-md-6">
                                                            <div id="divReqTienda" class="form-group ocultar">
                                                                <div class="col-md-12 form-control-static">
                                                                    <?php 
                                                                        $strNombreUsuario = isset($arrPersonaId["nombre"]) ? $arrPersonaId["nombre"] : "";
                                                                       ?>
                                                                    <input type="text" style="display: <?php print $strDisplay ?>" class="form-control" id="txtNombreDeUsuario" name="txtNombreDeUsuario" placeholder="Nombre" value="<?php print $strNombreUsuario ?>" >
                                                                    <div  class="form-control-static break-text " id="divReadMode_txtNombreDeUsuario" name="divReadMode_txtNombreDeUsuario"  ><?php print $strNombreUsuario ?></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div style="display: <?php print $strDisplay ?>"  id="divContrasena" class="form-group">
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
                                                    <div style="display: <?php print $strDisplay ?>"  id="divConfirmeContrasena" class="form-group">
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
                                                         <label  for="sltNombre" class="col-md-6 control-label form-control-static">
                                                            Cambiar Contrase&ntilde;a
                                                        </label>
                                                        <div class="col-md-6">
                                                            <div class="form-group ocultar">
                                                                <div class="col-md-12 form-control-static" >
                                                                    <a id="MostraCambioContrasena" >Cambiar contrasena</a>
                                                                </div>
                                                            </div>
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
                                                                         // $strTipo = $this->objModel->fntTipo();
                                                                        /*$strUsuario = isset($arrPersonaId["tipo"]) && $arrPersonaId["tipo"] == "admin" ? "Administrador" : "Normal";
                                                                        
                                                                         for ($i=0;$i<count($strTipo);$i++){ 
                                                                            $strTipo2 = $strTipo[$i] == "admin" ? "Administrador" : "Normal";
                                                                            $selected = $strTipo[$i] == $arrPersonaId["tipo"] ? "selected" : "";
                                                                            
                                                                            echo "<option value=".$strTipo[$i]." ".$selected." >".$strTipo2."</option>";
                                                                         }*/
                                                                        $strTipo = isset($arrPersonaId["tipo"]) ? $arrPersonaId["tipo"]: 0;
                                                                        $arrTipos = $this->objModel->fntTipo($strTipo);
                                                                        while( $arrTMP = each($arrTipos) ){
                                                                            $selected = $arrTMP["value"]["selected"] == $arrAlumnos["tipo"] ? "selected" : "";
                                                                            echo "<option value=".$arrTMP["key"]." ".$selected." >".$arrTMP["value"]["texto"]."</option>";
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
                                                                        $strActivoTexto = $arrPersonaId["bloqueado"] == "Y" ? "Si" : "No";
                                                                        $cheket =  $strActivo == "Y" ? "checked" : "";
                                                                    ?>
                                                                    <input  type="checkbox" style="display: <?php print $strDisplay ?>" class="form-control" id="chkActivo" name="chkActivo" class="form-check-input " placeholder="Nombre" <?php print $cheket ?> value="<?php print $strActivo ?>" >
                                                                    <div class="form-control-static break-text "  id="divReadMode_chkActivo" name="divReadMode_chkActivo" id="divReadMode_chkActivo"  ><?php print $strActivoTexto ?></div>
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
               <!-- &nbsp;
              <div class="alert alert-success">
                <strong>Success!</strong> You should <a href="#" class="alert-link">read this message</a>.
              </div>
              <div class="alert alert-info">
                <strong>Info!</strong> You should <a href="#" class="alert-link">read this message</a>.
              </div>
              <div class="alert alert-warning">
                <strong>Warning!</strong> You should <a href="#" class="alert-link">read this message</a>.
              </div>
              <div class="alert alert-danger">
                <strong>Danger!</strong> You should <a href="#" class="alert-link">read this message</a>.
              </div>
            </div> -->
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
            
            function destroyPops(){
                $("input").each(function(){
                    $(this).popover("destroy");
                });
                $("select").each(function(){
                    $(this).popover("destroy");
                });
                $("a").each(function(){
                    $(this).popover("destroy");
                });
                $("div").each(function(){
                    $(this).popover("destroy");
                });
            }
            
            function fntGuardar(){
                var boolError = false;
                var boolRepetido = false;
                destroyPops();
                
                strNombreUsuario = $("#txtNombreUsuario").val().length;
                strNombreUsuario2 = $("#txtNombreUsuario2").val().length;
                strApellidoUsuario = $("#txtApellidoUsuario").val().length;
                strApellidoUsuario2 = $("#txtApellidoUsuario2").val().length;
                
                
                strUsuario = $("#txtUsuario").val().length;
                strNombreDeUsuario = $("#txtNombreDeUsuario").val().length;
                strPassword = $("#txtPassword").val().length;
                strPasswordConfirmar = $("#txtConfirmarPassword").val().length;
                strEditarPassword = $("#hdnEditarPassword").val();
                strTipo = $("#slcTipo").val();
                
                if( strNombreUsuario == 0  ){
                    fntValido("txtNombreUsuario","Primer nombre","info");
                    boolError = true;
                }
                if( strNombreUsuario2 == 0   ){
                   fntValido("txtNombreUsuario2","Segundo nombre","info");
                   boolError = true;
                }
                if( strApellidoUsuario == 0  ) {
                   fntValido("txtApellidoUsuario","Primera apellido","info");
                   boolError = true;

                }
                if( strApellidoUsuario2 == 0 ){
                   fntValido("txtApellidoUsuario2","Segundo apellido","info");
                   boolError = true;
                }
                expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
             
                $("#txtEmail").val( $.trim($("#txtEmail").val()) );
                if( $("#txtEmail").val().length > 0 ){
                    $("#tabsContainer a[href='#tabsContainerA']").tab("show");
                    if( !(expr.test( $("#txtEmail").val() )) ){
                        $("#txtEmail").popover({
                            placement: 'bottom',
                            container: 'body',
                            content: "Email invalido",
                            animation: true,
                            trigger: "manual"
                        }).popover("show").click(function(){
                            $(this).popover('destroy');
                        });
                        boolError = true;
                    }
                }
                
                
                if( !boolError ) {
                    
                    if( strUsuario == 0 ){
                       fntValido("txtUsuario","Usuario","");
                       boolError = true;
                    }
                    if( strNombreDeUsuario == 0 ){
                       fntValido("txtNombreDeUsuario","Nombre de usuario","");
                       boolError = true;
                    }
                }
                
                
                
                if(!boolError && strEditarPassword == "Y"  ){
                    //VALIDA QUE LOS CAMPOS ESTEN LLENOS EN MI CUENTA
                    if( strUsuario == 0 ){
                       fntValido("txtUsuario","Usuario");
                       boolError = true;
                    }
                    if( strPassword == 0 ){
                       fntValido("txtPassword","Password");
                       boolError = true;
                    }
                    /*if( strPasswordConfirmar == 0 ){
                       fntValido("txtConfirmarPassword","Confirmar Password");
                       boolError = true;
                    }*/
                    
                    //VALIDA QUE SEAN IGUALES
                    if( !boolError ){
                        
                       // $("input[name='txtConfirmarPassword']").popover("destroy");
                       $("#tabsContainer a[href='#tabsContainerB']").tab("show")
                        if( $("input[name='txtPassword']").val() != $("input[name='txtConfirmarPassword']").val() ){
                            $("input[name='txtConfirmarPassword']").popover({
                                placement: 'bottom',
                                container: 'body',
                                title: "Campo requerido",
                                content: "Contraseñas no coniciden",
                                animation: true,
                                trigger: "manual"
                            }).popover("show").click(function(){
                                $(this).popover('destroy');
                            });
                            
                            boolError = true;
                        }
                    }
                
                    //VALIDA NUMERO DE CARACTERES
                    if(!boolError){
                        
                        if(  $("input[name='txtPassword']").val().length < 8  ){
                            //$("input[name='txtConfirmarPassword']").popover("destroy");
                            $("#tabsContainer a[href='#tabsContainerB']").tab("show")
                            $("input[name='txtConfirmarPassword']").popover({
                                placement: 'bottom',
                                container: 'body',
                                title: "Campo requerido",
                                content: "La contraseña debe contener 8 caracteres como mínimo.",
                                animation: true,
                                trigger: "manual"
                            }).popover("show").click(function(){
                                $(this).popover('destroy');
                            });
                            
                            boolError = true; 
                        }
                        
                        
                    }
                }
                
                 if( strTipo ==  0){
                   $("#tabsContainer a[href='#tabsContainerB']").tab("show"); 
                   
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

            }
            
            function fntValido(txtObjeto, txtConten,strTab){
                
                if(strTab == "info"){
                    $("#tabsContainer a[href='#tabsContainerA']").tab("show");
                 }
                 else{
                    $("#tabsContainer a[href='#tabsContainerB']").tab("show");       
                 }
                
                $("#"+txtObjeto).popover({
                     placement: 'bottom',
                     container: "body",
                     title: "Campo requerido",
                     content: txtConten,
                     animation: true,
                     trigger: "manual"
                 }).popover("show").click(function(){
                     $(this).popover("destroy");
                 });
                 
                 
                
            }
            
            function fntPanel(obj){
                destroyPops();
                $("idTabA").addClass("active")
            }
            
            //Muetras contraseña
            $("#MostraCambioContrasena").click(function(){
                //alert("test");
                $(this).hide();
                $("#hdnEditarPassword").val("Y");
                $("#divCambiarContrasena").hide();
                $("#divContrasena").show();
                $("#divConfirmeContrasena").show();
                
            })
            
            $("#divAlert").html("fasdfkljasdflñasdjfasdlñkfjasdklñf");            
           /* var strContent = "";
            strAlert = "";
            boolAddClose = true
            strContent = '<div class="alert alert-success">';
            
            if( boolAddClose ){
                strContent += "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
            }
            
            
            strContent += "<strong> You should </strong>";
            
            
            strContent += strAlert;
            strContent += "</div>";
            
            getDocumentLayer("divAlert").innerHTML = "";
            getDocumentLayer("divAlert").innerHTML = strContent;*/
            
            function getDocumentLayer(strName, objDoc) {
                var p,i,x=false;

                if(!objDoc) objDoc=document;

                if(objDoc[strName]) {
                    x=objDoc[strName];
                    if (!x.tagName) x = false;
                }

                if (!x && objDoc.all) x=objDoc.all[strName];
                for (i=0;!x && i<objDoc.forms.length; i++) x=objDoc.forms[i][strName];
                if (!x && objDoc.getElementById) x=objDoc.getElementById(strName);
                for (i=0;!x && objDoc.layers && i<objDoc.layers.length; i++) x=getDocumentLayer(strName,objDoc.layers[i].document);
                //for(i=0;!x && i<objDoc.all.length; i++) if (objDoc.all(i).id == strName || objDoc.all(i).name == strName) x = objDoc.all(i);

                return x;
            }
        </script>
        
        <?php
    }
    
    
}
?>
 