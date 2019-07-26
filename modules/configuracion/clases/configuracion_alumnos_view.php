<?php
/*************************************************************
    Developer: Tito De León
    Tel:        5430-6466
    Correo:     compuaserv@gmail.com, tito_de_leon@hotmail.com
*************************************************************/

require_once("modules/configuracion/clases/configuracion_alumnos_model.php");

class configuracion_alumnos_view{
    
    private $objModel;
    private $objView;
    
    public function __construct(){
        $this->objModel = new configuracion_alumnos_model();
    }
    
    
    public function drawContentButtom($strPersona){
        global $strAction;
       // print $strPersona;
        ?>
         <div class="row">
            <div class="col-lg-12" align="right" >
                <h1 class="page-header" id="btnHeadder" >
                    <p><button type="button" class="btn btn-outline btn-primary btn-sm" onclick="document.location.href='<?php print $strAction; ?>?alumno=new'" >Nuevo</button></p>
                </h1>
            </div>
        </div>
        
        <?php
    }
    
   /* public function drawContentPersonaButtom($strPersona){
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
    }*/
    public function drawContentPersonaButtom($strDepartamento){
       // print "a ".$strPersona;
        ?>
         <div class="row">
            <div class="col-lg-12" align="right" >
                <h1 class="page-header" id="btnHeadder" >
                    <p>
                        <?php 
                        $strDisplay = $strDepartamento != "new" ? "none" : "";
                        if( $strDepartamento != "new"  ){
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
         
        
        
        $arrGetAlumnos = $this->objModel->getAlumnos();
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
                                            <td><strong>DPI o Certificado de nacimiento</strong></td>
                                            <td><strong><center>Activo</center></strong></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                           foreach (  $arrGetAlumnos as $arrTMP  ){
                                               ?>
                                               <tr>
                                                   <td>
                                                       <a href="<?php echo $strAction."?alumno=".md5($arrTMP["alumno"]); ?>" class="link"><?php echo $arrTMP["nombres"]; ?></a>
                                                   </td>
                                                   <td><?php echo $arrTMP['identificacion']; ?></td>
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
    
    public function drawContentAlumno($strAlumnosId){
        global $strAction;
       
        $arrAlumnos = $this->objModel->getAlumnosId($strAlumnosId);
        $boolModoEdicion = $strAlumnosId != "new" ? true : false;
        $strDisplay = $boolModoEdicion ? "none" : "";
        $strGenero = $this->objModel->fntGenero();
      //  print_r($strGenero);
        $arrEstadoCivil = $this->objModel->fntEstadoCivil();
        // print_r($arrEstadoCivil);
        $arrTrabaja = $this->objModel->fntTrabajaActualmente();
        $arrDiscapacidad = $this->objModel->fntDiscapacidad();
        $arrDescDiscapacidad = $this->objModel->fntDesDiscapacidad();
       
        //print_r($arrAlumnos);
        //print "BOOLEANO ".$boolModoEdicion;
        ?>
         <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #149dee" >
                <h5 class="modal-title" id="exampleModalLabel" >ELIMINAR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Esta seguro que quiere eliminar este registro?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="fntCancelar()" >Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="fntEliminar()"  >Aceptar</button>
              </div>
            </div>
          </div>
        </div>     
        <form id="frmAlumno" name="frmAlumno" method="POST" enctype="multipart/form-data" action="<?php print $strAction; ?>" onsubmit="" class=""  >
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">&nbsp;</div>
                            <!-- /.panel-heading -->
                             <div class="table-responsive">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <div class=" col-md-3"></div>
                                        <div class=" col-md-6">
                                             <div  id="divTienda" class="form-group">
                                                <label  for="sltNombre" class="col-md-6 control-label form-control-static">
                                                    Nombres
                                                </label>
                                                <div class="col-md-6">
                                                    <div id="divReqTienda" class="form-group ocultar">
                                                        <div class="col-md-12 form-control-static">
                                                            <?php 
                                                                $strNombres = isset($arrAlumnos["nombres"]) ? $arrAlumnos["nombres"] : "";
                                                                $intAlumno = isset($arrAlumnos["alumno"]) ? $arrAlumnos["alumno"] : 0;
                                                               ?>
                                                            <input type="text" style="display: <?php print $strDisplay ?>" class="form-control" id="txtNombreAlumno" name="txtNombreAlumno" placeholder="Nombre" value="<?php print $strNombres ?>" >
                                                            <input type=hidden  id="hdnNombreAlumno" name="hdnNombreAlumno" value="<?php print $intAlumno ?>" >
                                                            <input type=hidden  id="hdnEliminar" name="hdnEliminar" value="N" >
                                                            <div  class="form-control-static break-text " id="divReadMode_txtNombreAlumno" name="divReadMode_txtNombreAlumno"  ><?php print $strNombres ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                             <div id="divTienda" class="form-group">
                                                <label for="sltNombre" class="col-md-6 control-label form-control-static">
                                                    Apellidos
                                                </label>
                                                <div class="col-md-6">
                                                    <div id="divReqTienda" class="form-group ocultar">
                                                        <div class="col-md-12 form-control-static">
                                                            <?php $strApellidos = isset($arrAlumnos["apellidos"]) ? $arrAlumnos["apellidos"] : "" ?>
                                                            <input type="text" style="display: <?php print $strDisplay ?>" class="form-control" id="txtApellidosAlumno" name="txtApellidosAlumno" placeholder="Nombre" value="<?php print $strApellidos ?>" >
                                                            <div class="form-control-static break-text" id="divReadMode_txtApellidosAlumno"  name="divReadMode_txtApellidosAlumno"  ><?php print $strApellidos ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                             <div id="divTienda" class="form-group">
                                                <label for="sltNombre" class="col-md-6 control-label form-control-static">
                                                    DPI o Certificado de nac
                                                </label>
                                                <div class="col-md-6">
                                                    <div id="divReqTienda" class="form-group ocultar">
                                                        <div class="col-md-12 form-control-static">
                                                            <?php $strApellido1 = isset($arrAlumnos["identificacion"]) ? $arrAlumnos["identificacion"] : "" ?>
                                                            <input type="text" style="display: <?php print $strDisplay ?>" class="form-control" id="txtDPIAlumno" name="txtDPIAlumno" placeholder="Nombre" value="<?php print $strApellido1 ?>" >
                                                            <div class="form-control-static break-text " id="divReadMode_txtDPIAlumno" name="divReadMode_txtDPIAlumno"  ><?php print $strApellido1 ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div id="divTienda" class="form-group">
                                                <label for="sltNombre" class="col-md-6 control-label form-control-static">
                                                    Edad
                                                </label>
                                                <div class="col-md-6">
                                                    <div id="divReqTienda" class="form-group ocultar">
                                                        <div class="col-md-12 form-control-static">
                                                            <?php $intEdad = isset($arrAlumnos["edad"]) ? $arrAlumnos["edad"] : "" ?>
                                                            <input type="text" style="display: <?php print $strDisplay ?>" class="form-control" id="txtEdadAlumno" name="txtEdadAlumno" placeholder="Nombre" value="<?php print $intEdad ?>" >
                                                            <div class="form-control-static break-text " name="divReadMode_txtEdadAlumno" id="divReadMode_txtEdadAlumno"  ><?php print $intEdad ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div  id="divUsuario" class="form-group">
                                                <label  for="sltUsuario" class="col-md-6 control-label form-control-static">
                                                    Genero
                                                </label>
                                                <div class="col-md-6">
                                                    <div id="divReqTienda" class="form-group ocultar">
                                                        <div class="col-md-12 form-control-static">
                                                            <select style="display: <?php print $strDisplay ?>"   class="form-control slcGeneroAlumno" name="slcGeneroAlumno" id="slcGeneroAlumno" >
                                                            <option value="0" >Seleccione un opcion</option>
                                                             <?php 

                                                                /*$strG = isset($arrAlumnos["tipo"]) && $arrAlumnos["tipo"] == "admin" ? "Femenino" : "Masculino";

                                                                 for ($i=0;$i<count($strGenero);$i++){ 
                                                                    $strTipo2 = $strGenero[$i] == "F" ? "Femenino" : "Masculino";
                                                                    $selected = $strGenero[$i] == $arrAlumnos["genero"] ? "selected" : "";

                                                                    echo "<option value=".$strGenero[$i]." ".$selected." >".$strTipo2."</option>";
                                                                 }*/
                                                                $strG = isset($arrAlumnos["genero"]) ? $arrAlumnos["genero"]: 0;
                                                                $arrGenero = $this->objModel->fntGenero($strG);
                                                                while( $arrTMP = each($arrGenero) ){
                                                                    $selected = $arrTMP["value"]["selected"] == $arrAlumnos["genero"] ? "selected" : "";
                                                                    echo "<option value=".$arrTMP["key"]." ".$selected." >".$arrTMP["value"]["texto"]."</option>";
                                                                 }
                                                               ?>
                                                              </select>
                                                            <div class="form-control-static break-text "  id="divReadMode_slcGeneroAlumno" name="divReadMode_slcGeneroAlumno"  ><?php print $strG ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div  id="divUsuario" class="form-group">
                                                <label  for="sltUsuario" class="col-md-6 control-label form-control-static">
                                                    Grupo Etnico
                                                </label>
                                                <div class="col-md-6">
                                                    <div id="divReqTienda" class="form-group ocultar">
                                                        <div class="col-md-12 form-control-static">
                                                            <select style="display: <?php print $strDisplay ?>"   class="form-control slcGrupoEtnico" name="slcGrupoEtnico" id="slcGrupoEtnico" >
                                                            <option value="0" >Seleccione un opcion</option>
                                                             <?php 

                                                                $strG = isset($arrAlumnos["grupo_etnico"]) ? $arrAlumnos["grupo_etnico"]: 0;
                                                                $arrEtnia = $this->objModel->fntEtnia($strG);
                                                                while( $arrTMP = each($arrEtnia) ){
                                                                    $selected = $arrTMP["value"]["selected"] == $arrAlumnos["grupo_etnico"] ? "selected" : "";
                                                                    echo "<option value=".$arrTMP["key"]." ".$selected." >".$arrTMP["value"]["texto"]."</option>";
                                                                 }
                                                               ?>
                                                              </select>
                                                            <div class="form-control-static break-text "  id="divReadMode_slcGrupoEtnico" name="divReadMode_slcGrupoEtnico"  ><?php print $arrEtnia[$strG]["texto"] ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div  id="divUsuario" class="form-group">
                                                <label  for="sltUsuario" class="col-md-6 control-label form-control-static">
                                                    Idioma Materno
                                                </label>
                                                <div class="col-md-6">
                                                    <div id="divReqTienda" class="form-group ocultar">
                                                        <div class="col-md-12 form-control-static">
                                                            <select style="display: <?php print $strDisplay ?>"   class="form-control slcIdiomaMaterno" name="slcIdiomaMaterno" id="slcIdiomaMaterno" >
                                                            <option value="0" >Seleccione un opcion</option>
                                                             <?php 

                                                                $strG = isset($arrAlumnos["grupo_etnico"]) ? $arrAlumnos["grupo_etnico"]: 0;
                                                                $arrEtnia = $this->objModel->fntEtnia($strG);
                                                                while( $arrTMP = each($arrEtnia) ){
                                                                    $selected = $arrTMP["value"]["selected"] == $arrAlumnos["grupo_etnico"] ? "selected" : "";
                                                                    echo "<option value=".$arrTMP["key"]." ".$selected." >".$arrTMP["value"]["texto"]."</option>";
                                                                 }
                                                               ?>
                                                              </select>
                                                            <div class="form-control-static break-text "  id="divReadMode_slcIdiomaMaterno" name="divReadMode_slcIdiomaMaterno"  ><?php print $arrEtnia[$strG]["texto"] ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div  id="divUsuario" class="form-group">
                                                <label  for="sltUsuario" class="col-md-6 control-label form-control-static">
                                                    Estado civil
                                                </label>
                                                <div class="col-md-6">
                                                    <div id="divReqTienda" class="form-group ocultar">
                                                        <div class="col-md-12 form-control-static">
                                                            <select style="display: <?php print $strDisplay ?>"   class="form-control slcEstadoCivil" name="slcEstadoCivil" id="slcEstadoCivil" >
                                                            <option value="0" >Seleccione un opcion</option>
                                                             <?php 

                                                                /*$strEstadoCivil = isset($arrAlumnos["estado_civil"]) && $arrAlumnos["estado_civil"] == "soltero" ? "Soltero" : "Casado";

                                                                 for ($i=0;$i<count($arrEstadoCivil);$i++){ 
                                                                    $strTipo2 = $arrEstadoCivil[$i] == "soltero" ? "Soltero" : "Casado";
                                                                    $selected = $arrEstadoCivil[$i] == $arrAlumnos["estado_civil"] ? "selected" : "";

                                                                    echo "<option value=".$arrEstadoCivil[$i]." ".$selected." >".$strTipo2."</option>";
                                                                 }*/
                                                                $strEstadoCivil = isset($arrAlumnos["estado_civil"]) ? $arrAlumnos["estado_civil"]: 0;
                                                                $arrEstadoCivil = $this->objModel->fntEstadoCivil($strEstadoCivil);
                                                                while( $arrTMP = each($arrEstadoCivil) ){
                                                                    $selected = $arrTMP["value"]["selected"] == $arrAlumnos["estado_civil"] ? "selected" : "";
                                                                    echo "<option value=".$arrTMP["key"]." ".$selected." >".$arrTMP["value"]["texto"]."</option>";
                                                                 }
                                                               ?>
                                                              </select>
                                                            <div class="form-control-static break-text "  id="divReadMode_slcEstadoCivil" name="divReadMode_slcEstadoCivil"  ><?php print $strEstadoCivil ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="divTienda" class="form-group">
                                                <label for="sltNombre" class="col-md-6 control-label form-control-static">
                                                    Profesion u oficio
                                                </label>
                                                <div class="col-md-6">
                                                    <div id="divReqTienda" class="form-group ocultar">
                                                        <div class="col-md-12 form-control-static">
                                                            <?php $intProfecionOficio = isset($arrAlumnos["profesion_oficio"]) ? $arrAlumnos["profesion_oficio"] : "" ?>
                                                            <input type="text" style="display: <?php print $strDisplay ?>" class="form-control" id="txtProfecionOficio" name="txtProfecionOficio" placeholder="Nombre" value="<?php print $intProfecionOficio ?>" >
                                                            <div class="form-control-static break-text " name="divReadMode_txtProfecionOficio" id="divReadMode_txtProfecionOficio"  ><?php print $intProfecionOficio ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="divTienda" class="form-group">
                                                <label for="sltNombre" class="col-md-6 control-label form-control-static">
                                                    Telefono
                                                </label>
                                                <div class="col-md-6">
                                                    <div id="divReqTienda" class="form-group ocultar">
                                                        <div class="col-md-12 form-control-static">
                                                            <?php $strTelefono = isset($arrAlumnos["telefono"]) ? $arrAlumnos["telefono"] : "" ?>
                                                            <input type="text" style="display: <?php print $strDisplay ?>" class="form-control" id="txtTelefono" name="txtTelefono" placeholder="Nombre" value="<?php print $strTelefono ?>" >
                                                            <div class="form-control-static break-text " name="divReadMode_txtTelefono" id="divReadMode_txtTelefono"  ><?php print $strTelefono ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div id="divTienda" class="form-group">
                                                <label for="sltNombre" class="col-md-6 control-label form-control-static">
                                                    Correo
                                                </label>
                                                <div class="col-md-6">
                                                    <div id="divReqTienda" class="form-group ocultar">
                                                        <div class="col-md-12 form-control-static">
                                                            <?php $strCorreoElectronico = isset($arrAlumnos["correo_electronico"]) ? $arrAlumnos["correo_electronico"] : "" ?>
                                                            <input type="text" style="display: <?php print $strDisplay ?>" class="form-control" id="txtCorreoElectronico" name="txtCorreoElectronico" placeholder="Nombre" value="<?php print $strCorreoElectronico ?>" >
                                                            <div class="form-control-static break-text " id="divReadMode_txtCorreoElectronico" name="divReadMode_txtCorreoElectronico"  ><?php print $strCorreoElectronico ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div  id="divUsuario" class="form-group">
                                                <label  for="sltUsuario" class="col-md-6 control-label form-control-static">
                                                    Departamento
                                                </label>
                                                <div class="col-md-6">
                                                    <div id="divReqTienda" class="form-group ocultar">
                                                        <div class="col-md-12 form-control-static">
                                                            <select style="display: <?php print $strDisplay ?>"   class="form-control slcDepartamento" name="slcDepartamento" id="slcDepartamento" >
                                                            <option value="0" >Seleccione un opcion</option>
                                                             <?php 

                                                                $intDepartamento = isset($arrAlumnos["departamento"]) ? $arrAlumnos["departamento"]: 0;
                                                                $arrEtnia = $this->objModel->fntDepartamento($intDepartamento);
                                                                while( $arrTMP = each($arrEtnia) ){
                                                                    $selected = $arrTMP["value"]["selected"] == $arrAlumnos["departamento"] ? "selected" : "";
                                                                    echo "<option value=".$arrTMP["key"]." ".$selected." >".$arrTMP["value"]["texto"]."</option>";
                                                                 }
                                                               ?>
                                                              </select>
                                                            <div class="form-control-static break-text "  id="divReadMode_slcDepartamento" name="divReadMode_slcDepartamento"  ><?php print $arrEtnia[$intDepartamento]["texto"] ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div  id="divUsuario" class="form-group">
                                                <label  for="sltUsuario" class="col-md-6 control-label form-control-static">
                                                    Municipio
                                                </label>
                                                <div class="col-md-6">
                                                    <div id="divReqTienda" class="form-group ocultar">
                                                        <div class="col-md-12 form-control-static">
                                                            <select style="display: <?php print $strDisplay ?>"   class="form-control slcMunicipio" name="slcMunicipio" id="slcMunicipio" >
                                                            <option value="0" >Seleccione un opcion</option>
                                                             <?php 

                                                                $intMunicipio = isset($arrAlumnos["municipio"]) ? $arrAlumnos["municipio"]: 0;
                                                                $arrMunicipio = $this->objModel->fntMunicipio($intMunicipio);
                                                                while( $arrTMP = each($arrMunicipio) ){
                                                                    $selected = $arrTMP["value"]["selected"] == $arrAlumnos["municipio"] ? "selected" : "";
                                                                    echo "<option value=".$arrTMP["key"]." ".$selected." >".$arrTMP["value"]["texto"]."</option>";
                                                                 }
                                                               ?>
                                                              </select>
                                                            <div class="form-control-static break-text "  id="divReadMode_slcMunicipio" name="divReadMode_slcMunicipio"  ><?php print $arrMunicipio[$intMunicipio]["texto"] ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="divTienda" class="form-group">
                                                <label for="sltNombre" class="col-md-6 control-label form-control-static">
                                                    Direccion
                                                </label>
                                                <div class="col-md-6">
                                                    <div id="divReqTienda" class="form-group ocultar">
                                                        <div class="col-md-12 form-control-static">
                                                            <?php $strDireccion = isset($arrAlumnos["direccion"]) ? $arrAlumnos["direccion"] : "" ?>
                                                            <input type="text" style="display: <?php print $strDisplay ?>" class="form-control" id="txtDireccion" name="txtDireccion" placeholder="Nombre" value="<?php print $strDireccion ?>" >
                                                            <div class="form-control-static break-text " name="divReadMode_txtDireccion" id="divReadMode_txtDireccion"  ><?php print $strDireccion ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div  id="divUsuario" class="form-group">
                                                <label  for="sltUsuario" class="col-md-6 control-label form-control-static">
                                                    Area geografica
                                                </label>
                                                <div class="col-md-6">
                                                    <div id="divReqTienda" class="form-group ocultar">
                                                        <div class="col-md-12 form-control-static">
                                                            <select style="display: <?php print $strDisplay ?>"   class="form-control slcAreaGeografica" name="slcAreaGeografica" id="slcAreaGeografica" >
                                                            <option value="0" >Seleccione un opcion</option>
                                                             <?php 

                                                               /* $intAreaGeografica = isset($arrAlumnos["area_geografica"]) ? $arrAlumnos["area_geografica"] : 0;
                                                                $strTexto1 = isset($arrAreasG[$intAreaGeografica]["texto"]) && $arrAreasG[$intAreaGeografica]["texto"] == "U" ? "Urbana" : "Rural";
                                                                $arrAreasG = $this->objModel->fntAreaGeografica($intAreaGeografica);
                                                                while( $arrTMP = each($arrAreasG) ){
                                                                    $selected = $arrTMP["value"]["selected"] == $arrAlumnos["area_geografica"] ? "selected" : "";
                                                                    $strTexto = $arrTMP["value"]["texto"] == "U" ? "Urbana" : "Rural";
                                                                    echo "<option value=".$arrTMP["value"]["texto"]." ".$selected." >".$strTexto."</option>";
                                                                 } */
                                                                $intAreaGeografica = isset($arrAlumnos["area_geografica"]) ? $arrAlumnos["area_geografica"]: 0;
                                                                $arrEstadoCivil = $this->objModel->fntAreaGeografica($intAreaGeografica);
                                                                while( $arrTMP = each($arrEstadoCivil) ){
                                                                    $selected = $arrTMP["value"]["selected"] == $arrAlumnos["area_geografica"] ? "selected" : "";
                                                                    echo "<option value=".$arrTMP["key"]." ".$selected." >".$arrTMP["value"]["texto"]."</option>";
                                                                 }
                                                               ?>
                                                              </select>
                                                            <div class="form-control-static break-text "  id="divReadMode_slcAreaGeografica" name="divReadMode_slcAreaGeografica"  ><?php print $strTexto1  ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div  id="divUsuario" class="form-group">
                                                <label  for="sltUsuario" class="col-md-6 control-label form-control-static">
                                                    Trabaja actualmente
                                                </label>
                                                <div class="col-md-6">
                                                    <div id="divReqTienda" class="form-group ocultar">
                                                        <div class="col-md-12 form-control-static">
                                                            <select style="display: <?php print $strDisplay ?>"   class="form-control slcTrabaja" name="slcTrabaja" id="slcTrabaja" >
                                                            <option value="0" >Seleccione un opcion</option>
                                                             <?php 

                                                               /* $strTrabaja = isset($arrAlumnos["trabaja_actualmente"]) && $arrAlumnos["trabaja_actualmente"] == "Y" ? "Si" : "No";

                                                                 for ($i=0;$i<count($arrTrabaja);$i++){ 
                                                                    $strTipo2 = $arrTrabaja[$i] == "Y" ? "Si" : "No";
                                                                    $selected = $arrTrabaja[$i] == $arrAlumnos["trabaja_actualmente"] ? "selected" : "";

                                                                    echo "<option value=".$arrTrabaja[$i]." ".$selected." >".$strTipo2."</option>";
                                                                 }*/
                                                                 
                                                               $strTrabaja = isset($arrAlumnos["trabaja_actualmente"]) ? $arrAlumnos["trabaja_actualmente"]: 0;
                                                                $arrTrabajaActual = $this->objModel->fntTrabajaActualmente($strTrabaja);
                                                                while( $arrTMP = each($arrTrabajaActual) ){
                                                                    $selected = $arrTMP["value"]["selected"] == $arrAlumnos["trabaja_actualmente"] ? "selected" : "";
                                                                    echo "<option value=".$arrTMP["key"]." ".$selected." >".$arrTMP["value"]["texto"]."</option>";
                                                                 }
                                                               ?>
                                                              </select>
                                                            <div class="form-control-static break-text "  id="divReadMode_slcTrabaja" name="divReadMode_slcTrabaja"  ><?php print $strTrabaja ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div  id="divUsuario" class="form-group">
                                                <label  for="sltUsuario" class="col-md-6 control-label form-control-static">
                                                    Discapacidad
                                                </label>
                                                <div class="col-md-6">
                                                    <div id="divReqTienda" class="form-group ocultar">
                                                        <div class="col-md-12 form-control-static">
                                                            <select style="display: <?php print $strDisplay ?>"   class="form-control slcDiscapacidad" name="slcDiscapacidad" id="slcDiscapacidad" >
                                                            <option value="0" >Seleccione un opcion</option>
                                                             <?php 

                                                               /* $strDiscapacidad = isset($arrAlumnos["discapasidad"]) ? $arrDescDiscapacidad[$arrAlumnos["discapasidad"]] : "";

                                                                 for ($i=0;$i<count($arrDiscapacidad);$i++){ 
                                                                    $strTipo2 = $arrDescDiscapacidad[$arrDiscapacidad[$i]];
                                                                    $selected = $arrDiscapacidad[$i] == $arrAlumnos["discapasidad"] ? "selected" : "";

                                                                    echo "<option value=".$arrDiscapacidad[$i]." ".$selected." >".$strTipo2."</option>";
                                                                 } */
                                                                 
                                                               $strDiscapacidad = isset($arrAlumnos["discapasidad"]) ? $arrAlumnos["discapasidad"]: 0;
                                                                $arrDiscapa = $this->objModel->fntDesDiscapacidad($strDiscapacidad);
                                                                while( $arrTMP = each($arrDiscapa) ){
                                                                    $selected = $arrTMP["value"]["selected"] == $arrAlumnos["discapasidad"] ? "selected" : "";
                                                                    echo "<option value=".$arrTMP["key"]." ".$selected." >".$arrTMP["value"]["texto"]."</option>";
                                                                 }
                                                               ?>
                                                              </select>
                                                            <div class="form-control-static break-text "  id="divReadMode_slcDiscapacidad" name="divReadMode_slcDiscapacidad"  ><?php print $strDiscapacidad ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div  id="divUsuario" class="form-group">
                                                <label  for="sltUsuario" class="col-md-6 control-label form-control-static">
                                                    Adjuntar Identificacion
                                                </label>
                                                <div class="col-md-6">
                                                    <div id="divReqTienda" class="form-group ocultar">
                                                        <div class="col-md-12 form-control-static">
                                                            <table>
                                                                <tr>
                                                                    <?php $strAlumnoPath = isset($arrAlumnos["imagen_alumno_path"])  ? $arrAlumnos["imagen_alumno_path"] : ""; ?>
                                                                    
                                                                    <td width="80%" style="border: 1px solid black; text-align: right;">
                                                                        <input style="display: <?php print $strDisplay ?>" type="" id="divReadMode_txtAdjuntoCurso" readonly="readonly" class="form-control" value="<?php print $strAlumnoPath; ?>" style="background-color: white; border-radius: none; border: none;height: 28px;">
                                                                        <input  type="file" id="txtAdjuntoCurso" class="form-control" name="txtAdjuntoCurso" style="display: none;" value="<?php print $strAlumnoPath; ?>">
                                                                    </td>
                                                                    <td style="display: <?php print $strDisplay ?>" id="tdNombretxtAdjuntoCurso" width="20%" style=" cursor: pointer; background: #E0E0E0; color: #808080; font-size: 14px;  padding: 1px 25px 1px 5px; border: 1px solid #E0E0E0;" >Examinar...</td>
                                                                    <div  id="divReadModetxtAdjuntoCurso" class="form-control-static ">
                                                                        <a class="fa fa-download cursor" href="<?php print $strAlumnoPath ?>" download="<?php print $strAlumnoPath; ?>" target="_blank"></a>
                                                                    </div>
                                                                </tr>
                                                            </table>
                                                            <script>
                                                                 $("#tdNombretxtAdjuntoCurso").click(function (){ $("#txtAdjuntoCurso").click();});
                                                                    $("#txtAdjuntoCurso").change(function (){
                                                                        if( getDocumentLayer("DivtexttxtAdjuntoCurso") )
                                                                            getDocumentLayer("DivtexttxtAdjuntoCurso").value = $("#txtAdjuntoCurso").val();
                                                                    });

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
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                             
                                             <div id="divTienda" class="form-group">
                                                   <label for="sltNombre" class="col-md-6 control-label form-control-static">
                                                       Activo
                                                   </label>
                                                   <div class="col-md-6">
                                                       <div id="divReqTienda" class="form-group ocultar">
                                                           <div class="col-md-6 form-control-static text-left">
                                                               <?php 
                                                                   $strActivo = isset($arrAlumnos["activo"]) ? $arrAlumnos["activo"] : "";
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
                
                strNombresAlumno = $("#txtNombreAlumno").val().length;
                strApellidosAlumno = $("#txtApellidosAlumno").val().length;
                strDPIAlumno = $("#txtDPIAlumno").val().length;
                strEdadAlumno = $("#txtEdadAlumno").val().length;
                strGeneroAlumnos = $("#slcGeneroAlumno").val();
                
                strGrupoEtnicoAlumnos = $("#slcGrupoEtnico").val();
                strIdiomaMaternoAlumnos = $("#slcIdiomaMaterno").val();
                strEstadoCivilAlumnos = $("#slcEstadoCivil").val();
                strProfecionAlumnos = $("#txtProfecionOficio").val().length;;
                strTelefonoAlumnos = $("#txtTelefono").val().length;
                strCorreoAlumnos = $("#txtCorreoElectronico").val();
                strDepartamentoAlumnos = $("#slcDepartamento").val();
                strMunicipioAlumnos = $("#slcMunicipio").val();
                strDireccionAlumnos = $("#txtDireccion").val();
                strGeografiaAlumnos = $("#slcAreaGeografica").val();
                strTrabajaAlumnos = $("#slcTrabaja").val();
                strDiscapacidadAlumnos = $("#slcDiscapacidad").val();
                //AQUI VA ADJUNTO
                
                
                if( strNombresAlumno == 0  ){
                     fntValido("txtNombreAlumno","Nombres");
                     boolError = true;
                 }
                if( strApellidosAlumno == 0   ){
                   fntValido("txtApellidosAlumno","Apellidos");
                   boolError = true;
                }
                if( strDPIAlumno == 0  ) {
                   fntValido("txtDPIAlumno","DPI");
                   boolError = true;

                }
                if( strEdadAlumno == 0 ){
                   fntValido("txtEdadAlumno","Edad");
                   boolError = true;
                }
                
                if( strGeneroAlumnos == 0 ){
                   fntValido("slcGeneroAlumno","Genero");
                   boolError = true;
                }
                if( strGrupoEtnicoAlumnos == 0 ){
                   fntValido("slcGrupoEtnico","Grupo Etnico");
                   boolError = true;
                }
                if( strIdiomaMaternoAlumnos == 0 ){
                   fntValido("slcIdiomaMaterno","Idioma Materno ");
                   boolError = true;
                }
                if( strEstadoCivilAlumnos == 0 ){
                   fntValido("slcEstadoCivil","Estado civil");
                   boolError = true;
                }
                if( strProfecionAlumnos == 0 ){
                   fntValido("txtProfecionOficio","Profesion u oficio ");
                   boolError = true;
                }
                if( strTelefonoAlumnos == 0 ){
                   fntValido("txtTelefono","Telefono");
                   boolError = true;
                }
                if( strCorreoAlumnos == 0 ){
                   fntValido("txtCorreoElectronico","Correo");
                   boolError = true;
                }
                if( strDepartamentoAlumnos == 0 ){
                   fntValido("slcDepartamento","Departamento");
                   boolError = true;
                }
                if( strMunicipioAlumnos == 0 ){
                   fntValido("slcMunicipio","Municipio");
                   boolError = true;
                }
                if( strDireccionAlumnos == 0 ){
                   fntValido("txtDireccion","Direcci&oacute;n");
                   boolError = true;
                }
                if( strGeografiaAlumnos == 0 ){
                   fntValido("slcAreaGeografica","Area geografica");
                   boolError = true;
                }
                if( strTrabajaAlumnos == 0 ){
                   fntValido("slcTrabaja","Trabaja actualmente");
                   boolError = true;
                }
                if( strDiscapacidadAlumnos == 0 ){
                   fntValido("slcDiscapacidad","Discapacidad");
                   boolError = true;
                }
                

                if( !boolError ){
                    document.frmAlumno.submit();
                }

            }
            
            function fntValido(txtObjeto, txtConten){
                
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
                console.log(obj);
                $("idTabA").addClass("active")
            }
            
             function fntRegresar(){
                document.location = "<?php echo $strAction; ?>";
            }
            
            function fntEliminar(){
                $("#hdnEliminar").val("Y");
                document.frmAlumno.submit();
            }
            
            function fntCancelar(){
                 $("#hdnEliminar").val("N");
            }
        </script>
        
        <?php
    }
    
    
}
?>
 