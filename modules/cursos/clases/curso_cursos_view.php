<?php
/*************************************************************
    Developer: Tito De León
    Tel:        5430-6466
    Correo:     compuaserv@gmail.com, tito_de_leon@hotmail.com
*************************************************************/

require_once("modules/cursos/clases/curso_cursos_model.php");

class curso_cursos_view{
    
    private $objModel;
    private $objView;
    
    public function __construct(){
        $this->objModel = new curso_cursos_model();
    }
    
    
    public function drawContentButtom($strPersona){
        global $strAction;
       // print $strPersona;
        ?>
         <div class="row">
            <div class="col-lg-12" align="right" >
                <h1 class="page-header" id="btnHeadder" >
                    <p><button type="button" class="btn btn-outline btn-primary btn-sm" onclick="document.location.href='<?php print $strAction; ?>?curso=new'" >Nuevo</button></p>
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
         
        
        
        $arrGetCursos = $this->objModel->getCursosInicio();
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
                                            <td><strong>Inicio de clases</strong></td>
                                            <td><strong>Fin de clases</strong></td>
                                            <td class="text-center" ><strong>Activo</strong></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                           foreach (  $arrGetCursos as $arrTMP  ){
                                               ?>
                                               <tr>
                                                   <td>
                                                       <a href="<?php echo $strAction."?curso=".md5($arrTMP["curso"]); ?>" class="link"><?php echo $arrTMP["nombre"]; ?></a>
                                                   </td>
                                                   <td>
                                                       <?php
                                                        $arrFechaInicio = explode("-", $arrTMP['fecha_inicio']);
                                                        $strNuevoFecha = $arrFechaInicio[2]."/".$arrFechaInicio[1]."/".$arrFechaInicio[0];
                                                         print $strNuevoFecha; 
                                                        ?>
                                                   </td>
                                                   <td>
                                                       <?php 
                                                       
                                                        //echo $arrTMP['fecha_fin'];
                                                       $arrFechaFin = explode("-", $arrTMP['fecha_fin']);
                                                       $strNuevoFin = $arrFechaFin[2]."/".$arrFechaFin[1]."/".$arrFechaFin[0];
                                                        print $strNuevoFin;
                                                       
                                                       ?>
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
    
    public function drawContentPersona($strCurso){
        
        $arrCursos = $this->objModel->getCursos($strCurso);
        
        //print_r($arrCursos);
       // print $strPersonaId;
        $boolModoEdicion = $strCurso != "new" ? true : false;
        $strDisplay = $boolModoEdicion ? "none" : "";
        $strTipo = $this->objModel->fntTipo();
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
        <form id="frmCurso" name="frmCurso" method="POST" action="<?php print $strAction; ?>" onsubmit="" class=""  >
            <div class="col-lg-12" style="padding: 5px; border-radius: 5px;">
                <ul class="nav nav-tabs" id="tabsContainer">
                    <li class="active">
                        <a href="#tabsContainerA" data-toggle="tab" onclick="fntPanel(this)"  >
                           Curso
                        </a>
                     </li>
                     <li class="">
                        <a href="#tabsContainerB" data-toggle="tab" onclick="fntPanel(this)"  >
                           Horario
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
                                                        <label  for="sltNombre" class="col-md-5 control-label form-control-static">
                                                            Nombre curso
                                                        </label>
                                                        <div class="col-md-7">
                                                            <div id="divReqTienda" class="form-group ocultar">
                                                                <div class="col-md-12 form-control-static">
                                                                    <?php 
                                                                        $strNombre = isset($arrCursos["nombre"]) ? $arrCursos["nombre"] : "";
                                                                        $intCurso = isset($arrCursos["curso"]) ? $arrCursos["curso"] : 0;
                                                                       ?>
                                                                    <input type="text" style="display: <?php print $strDisplay ?>" class="form-control" id="txtNombreCurso" name="txtNombreCurso" placeholder="Primer Nombre" value="<?php print $strNombre ?>" >
                                                                    <input type=hidden  id="hdnCurso" name="hdnCurso" value="<?php print $intCurso ?>" >
                                                                    <input type=hidden  id="hdnEditarCurso" name="hdnEditarCurso" value="N" >
                                                                    <input type=hidden  id="hdnEliminar" name="hdnEliminar" value="N" >
                                                                    <div  class="form-control-static break-text " id="divReadMode_txtNombreCurso" name="divReadMode_txtNombreCurso"  ><?php print $strNombre ?></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                     <div id="divTienda" class="form-group">
                                                        <label for="sltNombre" class="col-md-5 control-label form-control-static">
                                                            Fecha inicio
                                                        </label>
                                                        <div class="col-md-7">
                                                            <div id="divReqTienda" class="form-group ocultar">
                                                                <div class="col-md-12 form-control-static">
                                                                    
                                                                    <?php 
                                                                        $strFechaInicio = isset($arrCursos["fecha_inicio"]) ? $arrCursos["fecha_inicio"] : "";
                                                                        $intCurso = isset($arrCursos["persona"]) ? $arrCursos["persona"] : 0;
                                                                       ?>
                                                                    <input type="text" style="display: <?php print $strDisplay ?>" id="txtDatepickerInicio" name="txtDatepickerInicio" value="<?php print $strFechaInicio ?>" >
                                                                    <div  class="form-control-static break-text " id="divReadMode_txtDatepickerInicio" name="divReadMode_txtDatepickerInicio"  ><?php print $strFechaInicio ?></div>
                                                                    <input type=hidden  id="hdnDatepickerInicio" name="hdnDatepickerInicio" value="" >  
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                     <div id="divTienda" class="form-group">
                                                        <label for="sltNombre" class="col-md-5 control-label form-control-static">
                                                            Fecha fin
                                                        </label>
                                                        <div class="col-md-7">
                                                            <div id="divReqTienda" class="form-group ocultar">
                                                                <div class="col-md-12 form-control-static">
                                                                    <?php 
                                                                        $strFechaFin = isset($arrCursos["fecha_fin"]) ? $arrCursos["fecha_fin"] : "";
                                                                        $intCurso = isset($arrCursos["persona"]) ? $arrCursos["persona"] : 0;
                                                                       ?>
                                                                    <input type="text" type="text" style="display: <?php print $strDisplay ?>" id="txtDatepickerFin" name="txtDatepickerFin" value="<?php print $strFechaFin; ?>" >
                                                                    <div  class="form-control-static break-text " id="divReadMode_txtDatepickerFin" name="divReadMode_txtDatepickerFin"  ><?php print $strFechaFin ?></div>
                                                                    <input type=hidden  id="hdnDatepickerFin" name="hdnDatepickerFin" value="" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div id="divTienda" class="form-group">
                                                        <label for="sltNombre" class="col-md-5 control-label form-control-static">
                                                            Profersor/Tecnico
                                                        </label>
                                                        <div class="col-md-7">
                                                            <div id="divReqTienda" class="form-group ocultar">
                                                                <div class="col-md-12 form-control-static">
                                                                    <?php $strTecnico = isset($arrCursos["tecnico_docente"]) ? $arrCursos["tecnico_docente"] : "" ?>
                                                                    <input type="text" style="display: <?php print $strDisplay ?>" class="form-control" id="txtTecnicoDocente" name="txtTecnicoDocente" placeholder="Nombre" value="<?php print $strTecnico ?>" >
                                                                    <div class="form-control-static break-text" id="divReadMode_txtTecnicoDocente"  name="divReadMode_txtTecnicoDocente"  ><?php print $strTecnico ?></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    <div id="divActivo" class="form-group">
                                                        <label for="sltNombre" class="col-md-5 control-label form-control-static">
                                                            Activo
                                                        </label>
                                                        <div class="col-md-7 text-left">
                                                            <div id="divReqTienda" class="form-group ocultar">
                                                                <div class="col-md-12 form-control-static text-left">
                                                                    <?php 
                                                                        $strActivo = $arrCursos["activo"] == "Y" ? "Y" : "N";
                                                                        $cheket =  $arrCursos["activo"] == "Y" ? "checked" : "";
                                                                    ?>
                                                                    <input  type="checkbox" style="display: <?php print $strDisplay ?>" class="form-control" id="chkActivo" name="chkActivo" class="form-check-input " placeholder="Activo" <?php print $cheket ?> value="<?php print $strActivo ?>" >
                                                                    <div  id="divReadMode_chkActivo" name="divReadMode_chkActivo" ><?php print $strActivo ?></div>
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
                                    <div class="table-responsive">
                                        <div class="panel-body">
                                            <div class="col-lg-12">
                                                <div class="table-responsive">
                                                    <table class="table table-striped" id="tblHorarios">
                                                        <thead>                
                                                            <tr>
                                                               <td style="width: 20%;" class="text-center">Dia</td>
                                                                <td style="width: 5%;">
                                                                    &nbsp;
                                                                </td>
                                                                <td style="width: 15%;" class="text-center">Fecha Inicio</td>
                                                                <td style="width: 5%;">
                                                                    &nbsp;
                                                                </td>
                                                                <td style="width: 15%;" class="text-center">Fecha Fin</td>
                                                                <td style="width: 20%;" >&nbsp;</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                if( isset($arrCursos) && count($arrCursos)){
                                                                     reset($arrCursos["arrHorarios"]);
                                                                     $intCorrelativo = 1;
                                                                    foreach( $arrCursos["arrHorarios"] as $arrTMPH  ){
                                                                         $arrExplodeInicio= explode(":",$arrTMPH["hora_inicio"]);
                                                                         $arrExplodeFin= explode(":",$arrTMPH["hora_fin"]);
                                                                         $intDia = $arrTMPH["dia"];
                                                                         
                                                                         $arrGetDias = $this->objModel->getDias($intDia);
                                               
                                                                         
                                                                         $strHoraInicio = isset($arrExplodeInicio[0]) ? $arrExplodeInicio[0] : "";
                                                                         $strMinutoInicio = isset($arrExplodeInicio[1]) ? $arrExplodeInicio[1] : "";
                                                                         
                                                                         $strHoraFin = isset($arrExplodeFin[0]) ? $arrExplodeFin[0] : "";
                                                                         $strMinutoFin = isset($arrExplodeFin[1]) ? $arrExplodeFin[1] : "";
                                                                        ?>
                                                                         <tr>
                                                                             <td>
                                                                                 <select style="display: <?php print $strDisplay ?>" class="form-control slcDia" name="slcDia-<?php print $intCorrelativo; ?>" id="slcDia-<?php print $intCorrelativo; ?>" >
                                                                                    <option  value="0" >Seleccione un opci&oacuten</option>
                                                                                        <?php 
                                                                                         $arrGetDias = $this->objModel->getDias($intDia);
                                                                                         foreach( $arrGetDias as $key => $arrTMP  ) {
                                                                                            $strSelected = (isset($arrTMP["selected"]) && $arrTMP["selected"]) ? "selected" : "";
                                                                                            $strTexto = isset($arrTMP["texto"]) ? $arrTMP["texto"] : $arrTMP["value"];
                                                                                            ?>
                                                                                            <option value="<?php print strtoupper($strTexto); ?>" <?php print $strSelected; ?>>
                                                                                                <?php print $strTexto; ?>
                                                                                            </option>
                                                                                            <?php
                                                                                         }
                                                                                       ?>
                                                                                </select>
                                                                                <div class="form-control-static break-text"  id="divReadMode_slcDia-<?php print $intCorrelativo; ?>" name="divReadMode_slcDia-<?php print $intCorrelativo; ?>"  ><?php print $intDia ?></div>
                                                                                <input type=hidden  id="hdnHorario-<?php print $intCorrelativo; ?>" name="hdnHorario-<?php print $intCorrelativo; ?>" value="<?php print $arrTMPH["horario"] ?>" >
                                                                                <input type=hidden  id="hdnCurso-<?php print $intCorrelativo; ?>" name="hdnCurso-<?php print $intCorrelativo; ?>" value="<?php print $arrTMPH["curso"] ?>" >
                                                                                <input type=hidden  id="hdnNew-<?php print $intCorrelativo; ?>" name="hdnNew-<?php print $intCorrelativo; ?>" value="N" >
                                                                                <input type=hidden  id="hdnUpdateHorario-<?php print $intCorrelativo; ?>" name="hdnUpdateHorario-<?php print $intCorrelativo; ?>" value="Y" >
                                                                                <input type=hidden  id="hdnDeleteHorario-<?php print $intCorrelativo; ?>" name="hdnDeleteHorario-<?php print $intCorrelativo; ?>" value="N" >
                                                                             </td> 
                                                                             <td>
                                                                                &nbsp;
                                                                            </td>
                                                                            <td>
                                                                                <div style="width: 100%;">
                                                                                    <div class="text-right" style="width: 45%; float: left;">
                                                                                        <select style="display: <?php print $strDisplay ?>" class="form-control slcHoraInicio" name="slcHoraInicio-<?php print $intCorrelativo; ?>" id="slcHoraInicio-<?php print $intCorrelativo; ?>" >
                                                                                            <option  value="0" >Seleccione un opci&oacuten</option>
                                                                                                <?php 
                                                                                                 $arrGetHoras = $this->objModel->getHoras($arrExplodeInicio[0]);
                                                                                                 foreach( $arrGetHoras as $key => $arrTMP  ) {
                                                                                                    $strSelected = (isset($arrTMP["selected"]) && $arrTMP["selected"]) ? "selected" : "";
                                                                                                    $strTexto = isset($arrTMP["texto"]) ? $arrTMP["texto"] : $arrTMP["value"];
                                                                                                    ?>
                                                                                                    <option value="<?php print $strTexto; ?>" <?php print $strSelected; ?>>
                                                                                                        <?php print $strTexto; ?>
                                                                                                    </option>
                                                                                                    <?php
                                                                                                 }
                                                                                               ?>
                                                                                        </select>
                                                                                        <div class="form-control-static break-text"  id="divReadMode_slcHoraInicio-<?php print $intCorrelativo; ?>" name="divReadMode_slcHoraInicio-<?php print $intCorrelativo; ?>"  ><?php print $strHoraInicio ?></div>
                                                                                    </div>
                                                                                    <div class="<?php print "";?> text-center" style="width: 10%; float: left; padding-top: 6px;">
                                                                                        :
                                                                                    </div>
                                                                                    <div class="<?php print "";?>" style="width: 45%; float: left;">
                                                                                        <select style="display: <?php print $strDisplay ?>" class="form-control slcMinutoInicio" name="slcMinutoInicio-<?php print $intCorrelativo; ?>" id="slcMinutoInicio-<?php print $intCorrelativo; ?>" >
                                                                                            <option  value="0" >Seleccione un opci&oacuten</option>
                                                                                                <?php 
                                                                                                 $arrGetMinutos = $this->objModel->getMinutos($arrExplodeInicio[1]);
                                                                                                 foreach( $arrGetMinutos as $key => $arrTMP  ) {
                                                                                                    $strSelected = (isset($arrTMP["selected"]) && $arrTMP["selected"]) ? "selected" : "";
                                                                                                    $strTexto = isset($arrTMP["texto"]) ? $arrTMP["texto"] : $arrTMP["value"];
                                                                                                    ?>
                                                                                                    <option value="<?php print $strTexto; ?>" <?php print $strSelected; ?>>
                                                                                                        <?php print $strTexto; ?>
                                                                                                    </option>
                                                                                                    <?php
                                                                                                 }
                                                                                               ?>
                                                                                        </select>
                                                                                        <div class="form-control-static break-text"  id="divReadMode_slcMinutoInicio-<?php print $intCorrelativo; ?>" name="divReadMode_slcMinutoInicio-<?php print $intCorrelativo; ?>"  ><?php print $strMinutoInicio ?></div>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                &nbsp;
                                                                            </td>
                                                                            <td>
                                                                                <div style="width: 100%;">
                                                                                    <?php
                                                                                    
                                                                                    ?>
                                                                                    <div class="text-right" style="width: 45%; float: left;">
                                                                                        <select style="display: <?php print $strDisplay ?>" class="form-control slcHoraFin" name="slcHoraFin-<?php print $intCorrelativo; ?>" id="slcHoraFin-<?php print $intCorrelativo; ?>" >
                                                                                            <option  value="0" >Seleccione un opci&oacuten</option>
                                                                                                <?php 
                                                                                                 $arrGetHorasFin = $this->objModel->getHoras($arrExplodeFin[0]);
                                                                                                 foreach( $arrGetHorasFin as $key => $arrTMP  ) {
                                                                                                    $strSelected = (isset($arrTMP["selected"]) && $arrTMP["selected"]) ? "selected" : "";
                                                                                                    $strTexto = isset($arrTMP["texto"]) ? $arrTMP["texto"] : $arrTMP["value"];
                                                                                                    ?>
                                                                                                    <option value="<?php print $strTexto; ?>" <?php print $strSelected; ?>>
                                                                                                        <?php print $strTexto; ?>
                                                                                                    </option>
                                                                                                    <?php
                                                                                                 }
                                                                                               ?>
                                                                                        </select>
                                                                                        <div class="form-control-static break-text"  id="divReadMode_slcHoraFin-<?php print $intCorrelativo; ?>" name="divReadMode_slcHoraFin-<?php print $intCorrelativo; ?>"  ><?php print $strHoraFin ?></div>
                                                                                    </div>
                                                                                    <div class="<?php print "";?> text-center" style="width: 10%; float: left; padding-top: 6px;">
                                                                                        :
                                                                                    </div>
                                                                                    <div class="<?php print "";?>" style="width: 45%; float: left;">
                                                                                        <select style="display: <?php print $strDisplay ?>" class="form-control slcMinutoFin" name="slcMinutoFin-<?php print $intCorrelativo; ?>" id="slcMinutoFin-<?php print $intCorrelativo; ?>" >
                                                                                            <option  value="0" >Seleccione un opci&oacuten</option>
                                                                                                <?php 
                                                                                                 $arrGetMinutosFin = $this->objModel->getMinutos($arrExplodeFin[1]);
                                                                                                 foreach( $arrGetMinutosFin as $key => $arrTMP  ) {
                                                                                                    $strSelected = (isset($arrTMP["selected"]) && $arrTMP["selected"]) ? "selected" : "";
                                                                                                    $strTexto = isset($arrTMP["texto"]) ? $arrTMP["texto"] : $arrTMP["value"];
                                                                                                    ?>
                                                                                                    <option value="<?php print $strTexto; ?>" <?php print $strSelected; ?>>
                                                                                                        <?php print $strTexto; ?>
                                                                                                    </option>
                                                                                                    <?php
                                                                                                 }
                                                                                               ?>
                                                                                        </select>
                                                                                        <div class="form-control-static break-text"  id="divReadMode_slcMinutoFin-<?php print $intCorrelativo; ?>" name="divReadMode_slcMinutoFin-<?php print $intCorrelativo; ?>"  ><?php print $strMinutoFin ?></div>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <span name="imgDeleteHorario-<?php print $intCorrelativo; ?>" id="imgDeleteHorario-<?php print $intCorrelativo; ?>"  onclick="fntDeleteHorario(<?php print $intCorrelativo; ?>)" class="glyphicon glyphicon-trash glyphicon-color btn-md" ></span>
                                                                                <span name="imgRevertirHorario-<?php print $intCorrelativo; ?>" id="imgRevertirHorario-<?php print $intCorrelativo; ?>"  onclick="fntDeleteHorario(<?php print $intCorrelativo; ?>)" class="glyphicon glyphicon-undo fa-color btn-md" ></span>
                                                                            </td>
                                                                         </tr>
                                                                        <?php
                                                                        $intCorrelativo ++;
                                                                    }
                                                                }
                                                            ?>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td colspan="6" >
                                                                     <div class="col-lg-12">
                                                                      <span id="imgAddNewHorario" onclick="fntAddNewHorario(<?php print $intCurso; ?>);" class="glyphicon glyphicon-plus btn-glyphicon-sm-cursor-color"></span>  
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                       </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <script>
             var intIndex = parseInt(<?php print $intCorrelativo; ?>);
            //$("#idGuardar").hide();
            <?php
            if(!$boolModoEdicion){
                ?>
                $("[id^='divReadMode']").hide();
                <?php
            }
            ?>
            //ui-datepicker-trigger
            $("button ui-datepicker-trigger ").hide();
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
               // fntDatePickerInicio();
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
                
                
                strNombresCurso = $("#txtNombreCurso").val().length;
                destroyPops();
                if( strNombresCurso == 0  ){
                     fntValido("txtNombreCurso","Nombre curso","info");
                     boolError = true;
                 }
                 
                 
                if( !boolError ){
                    document.frmCurso.submit();
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
            
            function fntDeleteHorario(rowIndex){
                $("#hdnDeleteHorario-"+rowIndex).val("Y");

                $("#imgRevertirHorario-"+rowIndex).show();
                $("#imgDeleteHorario-"+rowIndex).hide();

                var objTr = $("#imgDeleteHorario-"+rowIndex).parent().parent();
                $(objTr).children().css("background-color","#f2dede");
            }
            
            function fntDeleteHorarioJs(rowIndex){
                $("#hdnDeleteHorario-"+rowIndex).val("Y");

                $("#imgRevertirHorario-"+rowIndex).show();
                $("#imgDeleteHorario-"+rowIndex).hide();

                objTable = getDocumentLayer("tblHorarios");
                obj = getDocumentLayer("imgDeleteHorario-"+rowIndex);
                objTr = obj.parentNode.parentNode;
                objTable.deleteRow(objTr.rowIndex);
            }
              
            $("#txtDatepickerInicio").datepicker({
                //showOn: "both",
                dateFormat: 'yy-mm-dd',
                monthNames: ['Enero', 'Febreo', 'Marzo',
                            'Abril', 'Mayo', 'Junio',
                            'Julio', 'Agosto', 'Septiembre',
                            'Octubre', 'Noviembre', 'Diciembre'],
                monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun','Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
                buttonImage: "calendar-icon.jpg"
            }).on( "change", function() {

                $("#hdnDatepickerInicio").val($(this).val());
            });
            
             $("#txtDatepickerFin").datepicker({
               // showOn: "both",
                dateFormat: 'yy-mm-dd',
                monthNames: ['Enero', 'Febreo', 'Marzo',
                            'Abril', 'Mayo', 'Junio',
                            'Julio', 'Agosto', 'Septiembre',
                            'Octubre', 'Noviembre', 'Diciembre'],
                monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun','Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
                buttonImage: "calendar-icon.jpg"
            }).on( "change", function() {
               // alert($(this).val());
                $("#hdnDatepickerFin").val($(this).val());
            });
             
             
              function fntAddNewHorario(intCurso){
                  
                var arrDias = new Array();
                arrDias[-1] = new Array();
                arrDias[-1]["texto"] = "Seleccione un opci&oacuten";
                arrDias[-1]["selected"] = true;
                <?php
                $arrGetDias = $this->objModel->getDias();    
                reset($arrGetDias);
                foreach( $arrGetDias as $key => $arrTMP  ) {
                    $strTexto = isset($arrTMP["texto"]) ? $arrTMP["texto"] : $arrTMP["value"];
                    ?>
                    arrDias["<?php print $key; ?>"] = new Array();
                    arrDias["<?php print $key; ?>"]["texto"] = "<?php print $strTexto; ?>";
                    arrDias["<?php print $key; ?>"]["selected"] = false;
                    <?php
           
                }
                ?>
                  
                var arrHorasInicio = new Array();
                arrHorasInicio[-1] = new Array();
                arrHorasInicio[-1]["texto"] = "HH";
                arrHorasInicio[-1]["selected"] = true;

                var arrHorasFinal = new Array();
                arrHorasFinal[-1] = new Array();
                arrHorasFinal[-1]["texto"] = "HH";
                arrHorasFinal[-1]["selected"] = true;
                <?php
                $intHoras = 0;

                while($intHoras < 24){
                    $strCero = "";
                    if($intHoras >= 0 && $intHoras < 10){
                        $strCero = 0;
                    }
                    ?>
                    arrHorasInicio[<?php print $intHoras; ?>] = new Array();
                    arrHorasInicio[<?php print $intHoras; ?>]["texto"] = "<?php print $strCero.$intHoras; ?>";
                    arrHorasInicio[<?php print $intHoras; ?>]["selected"] = false;

                    arrHorasFinal[<?php print $intHoras; ?>] = new Array();
                    arrHorasFinal[<?php print $intHoras; ?>]["texto"] = "<?php print $strCero.$intHoras; ?>";
                    arrHorasFinal[<?php print $intHoras; ?>]["selected"] = false;
                    <?php
                    $intHoras++;
                }
                ?>

                var arrMinutosInicio = new Array();
                arrMinutosInicio[-1] = new Array();
                arrMinutosInicio[-1]["texto"] = "MM";
                arrMinutosInicio[-1]["selected"] = true;

                var arrMinutosFinal = new Array();
                arrMinutosFinal[-1] = new Array();
                arrMinutosFinal[-1]["texto"] = "MM";
                arrMinutosFinal[-1]["selected"] = true;
                <?php
                $intMinutos = 0;

                while($intMinutos < 60){
                    $strCero = "";
                    if($intMinutos >= 0 && $intMinutos < 10){
                        $strCero = 0;
                    }
                    ?>
                    arrMinutosInicio[<?php print $intMinutos; ?>] = new Array();
                    arrMinutosInicio[<?php print $intMinutos; ?>]["texto"] = "<?php print $strCero.$intMinutos; ?>";
                    arrMinutosInicio[<?php print $intMinutos; ?>]["selected"] = false;

                    arrMinutosFinal[<?php print $intMinutos; ?>] = new Array();
                    arrMinutosFinal[<?php print $intMinutos; ?>]["texto"] = "<?php print $strCero.$intMinutos; ?>";
                    arrMinutosFinal[<?php print $intMinutos; ?>]["selected"] = false;
                    <?php
                    $intMinutos+=5;
                }
                ?>
               
                strHtml = '<tr>'+
                                '<td>'+
                                     '<select  class="form-control slcDia" name="slcDia-'+intIndex+'" id="slcDia-'+intIndex+'" >';
                                        for( dias in arrDias ){
                strHtml +=                      '<option value="'+arrDias[dias]["texto"].toUpperCase()+'" >'+
                                                   arrDias[dias]["texto"]+
                                                '</option>';
                                         }
                strHtml +=           '</select>'+
                                    '<input type=hidden  id="hdnNew-'+intIndex+'" name="hdnNew-'+intIndex+'" value="Y" >'+
                                    '<input type=hidden  id="hdnHorario-'+intIndex+'" name="hdnHorario-'+intIndex+'" value="0" >'+
                                    '<input type=hidden  id="hdnUpdateHorario-'+intIndex+'" name="hdnUpdateHorario-'+intIndex+'" value="N" >'+
                                    
                                '</td>'+
                                '<td>'+
                                    '&nbsp;'+
                                '</td>'+
                               '<td>'+
                                   '<div style="width: 100%;">'+
                                       '<div class="text-right" style="width: 45%; float: left;">'+
                                           '<select class="form-control slcHoraInicio" name="slcHoraInicio-'+intIndex+'" id="slcHoraInicio-'+intIndex+'" >';
                                                for( indice in arrHorasInicio ){
                 strHtml +=                      '<option value="'+arrHorasInicio[indice]["texto"]+'" >'+
                                                    arrHorasInicio[indice]["texto"]+
                                                 '</option>';
                                                }
                strHtml +=                  '</select>'+
                                        '</div>'+
                                       '<div class=" text-center" style="width: 10%; float: left; padding-top: 6px;">'+
                                        ":"+
                                       '</div>'+
                                       '<div  style="width: 45%; float: left;">'+
                                        '<select class="form-control slcMinutoInicio" name="slcMinutoInicio-'+intIndex+'" id="slcMinutoInicio-'+intIndex+'" >';
                                             for( indice in arrMinutosInicio ){
                 strHtml +=                      '<option value="'+arrMinutosInicio[indice]["texto"]+'" >'+
                                                    arrMinutosInicio[indice]["texto"]+
                                                 '</option>';
                                                }
                 strHtml +=               '</select>'+
                                       '</div>'+
                                   '</div>'+
                               '</td>'+
                               '<td>'+
                                   '&nbsp;'+
                               '</td>'+
                               '<td >'+
                                 '<div class="text-right" style="width: 45%; float: left;">'+
                                           '<select class="form-control slcHoraInicio" name="slcHoraFin-'+intIndex+'" id="slcHoraFin-'+intIndex+'" >';
                                                for( indice in arrHorasFinal ){
                 strHtml +=                      '<option value="'+arrHorasFinal[indice]["texto"]+'" >'+
                                                    arrHorasFinal[indice]["texto"]+
                                                 '</option>';
                                                }
                strHtml +=                  '</select>'+
                                        '</div>'+
                                       '<div class=" text-center" style="width: 10%; float: left; padding-top: 6px;">'+
                                        ":"+
                                       '</div>'+
                                       '<div  style="width: 45%; float: left;">'+
                                        '<select class="form-control slcMinutoFin" name="slcMinutoFin-'+intIndex+'" id="slcMinutoFin-'+intIndex+'" >';
                                             for( indice in arrMinutosFinal ){
                 strHtml +=                      '<option value="'+arrMinutosFinal[indice]["texto"]+'" >'+
                                                    arrMinutosFinal[indice]["texto"]+
                                                 '</option>';
                                                }
                 strHtml +=               '</select>'+
                                       '</div>'+
                                   '</div>'+
                               '</td>'+
                               '<td>'+
                                '<span id="imgDeleteHorario-'+intIndex+'" name="imgDeleteHorario-'+intIndex+'" onclick="fntDeleteHorarioJs('+intIndex+')" class="glyphicon glyphicon-trash" glyphicon-color btn-sm ></span>'+
                              '</td>'+
                          '</tr>';
               $("#tblHorarios > tbody ").append(strHtml);
               intIndex ++;
              }
              
              function fntEliminar(){
                    $("#hdnEliminar").val("Y");
                    document.frmCurso.submit();
               }

        </script>
        
        <?php
    }
    
    
}
?>
 