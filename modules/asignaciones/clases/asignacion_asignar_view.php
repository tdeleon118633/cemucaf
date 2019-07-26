<?php
//include_once("adm_usuarios_model.php");
//include_once("adm_usuarios_controller.php");

require_once("modules/asignaciones/clases/asignacion_asignar_model.php");

class asignacion_asignar_view{
    
    private $objModel;
    private $objView;
    
    public function __construct(){
        $this->objModel = new asignacion_asignar_model();
    }
    
    
    public function drawContentButtom(){
        ?>
         <div class="row">
            <div class="col-lg-12" align="right" >
                <h1 class="page-header" id="btnHeadder" >
                    <p><button type="button" class="btn btn-outline btn-primary btn-sm" onclick="document.location.href='<?php print $strAction; ?>?etnia=new'" >Nuevo</button>
                    <button id="idGuardar" style="display: <?php print $strDisplay ?>" type="button" class="btn btn-outline btn-primary btn-sm" onclick="fntGuardar();" >Guardar</button>
                    </p>
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
        global $strAction;
        ?>
            <!-- /.row --> 
            <form id="frmUnidades" name="frmUnidades" method="POST" action="<?php print $strAction; ?>" onsubmit="" class=""  >
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
                                               Curso
                                           </label>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <div class="col-md-12">
                                                        <input type="text" id="txtNombreCurso" name="txtNombreCurso" class="form-control"  placeholder="Nombre"  >
                                                        <input type="hidden" id="hdnIdCurso" name="hdnIdCurso"  value="" >
                                                        <input type="hidden" id="hdnEliminar" name="hdnEliminar"  value="N" >
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <br>
                               <br>
                               <div class="form-group">
                                    <div class="col-lg-12" id="divAsignacion" >
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
            <!-- /.row -->          
             <!--<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
             <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
             <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>-->
            <script>
                 var objAjaxCursoAsignar;
                 $("#txtNombreCurso").autocomplete({
                    source: '<?php print $strAction; ?>'+"?sendAutoCompleteCarne=true", 
                    minLength: 1,
                    select: function( event, ui ) {
                        $("#hdnIdCurso").val(ui.item.id);
                         getAjaxCursoAsignar();
                    },
                    close: function( event, ui ){
                    },
                    change: function( event, ui ) {

                    }
                });
                
                function getAjaxCursoAsignar(){
                    if( objAjaxCursoAsignar ) objAjaxCursoAsignar.abort();
                    objAjaxCursoAsignar = $.ajax({
                        url:"<?php print $strAction; ?>",
                        async: false,
                        data:{
                            "getCursoAsignar" : true,
                            "intCurso" : $("#hdnIdCurso").val()
                        },
                        type:'post',
                        dataType:'html',
                        beforeSend:function(){
                            //showImgCoreLoading();
                        },
                        success:function(data){
                           // hideImgCoreLoading();
                            $("#divAsignacion").html("");
                            $("#divAsignacion").html(data);
                        }
                    });
                }
                
            </script>
        <?php
    }
    
    public function drawCursoAsignar($intCurso){
        global $strAction;
        $arrAsignacion = $this->objModel->getAsignacion($intCurso);
        ?>
        <div class="form-group">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped" id="tblAsignacion">
                        <thead>                
                            <tr>
                                <td width="20%">Alumno</td>
                                <td width="20%" class="text-center" >Asignar</td>
                                <td width="20%">&nbsp;</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if( isset($arrAsignacion) && count($arrAsignacion)){
                                 reset($arrAsignacion);
                                 $intCorrelativo = 1;
                                 foreach ( $arrAsignacion as $arrTMP  ){
                                    ?>
                                    <tr>
                                        <td width="20%">
                                            <input type="text" id="txtNombreAlumno_<?php print $intCorrelativo ?>" name="txtNombreAlumno_<?php print $intCorrelativo ?>" class="form-control"  placeholder="Alumno" value="<?php print $arrTMP["nombres"] ?>"  >
                                            <input type="hidden" id="hdnCursoAlumno_<?php print $intCorrelativo ?>" name="hdnCursoAlumno_<?php print $intCorrelativo ?>"  value="<?php print $arrTMP["curso_alumno"] ?>" >
                                            <input type="hidden" id="hdnIdAlumno_<?php print $intCorrelativo ?>" name="hdnIdAlumno_<?php print $intCorrelativo ?>"  value="<?php print $arrTMP["alumno"] ?>" >
                                            <input type="hidden" id="hdnDeleteAlumno_<?php print $intCorrelativo ?>" name="hdnDeleteAlumno_<?php print $intCorrelativo ?>"  value="N" >
                                            <input type="hidden"  id="hdnUpdateAlumno_<?php print $intCorrelativo; ?>" name="hdnUpdateAlumno_<?php print $intCorrelativo; ?>" value="Y" >
                                        </td>
                                        <td width="20%" class="text-center" >
                                            
                                            <?php 
                                                if( $arrTMP["asignado"] == "Y"){
                                                    ?>
                                                    <span name="imgAsignar_<?php print $intCorrelativo; ?>" id="imgAsignar_<?php print $intCorrelativo; ?>"  onclick="fntAsignar(<?php print $intCorrelativo; ?>)" class="glyphicon glyphicon-unchecked" style="display: none; color: #149dee; cursor: pointer;" ></span>
                                                    <span name="imgDesasignar_<?php print $intCorrelativo; ?>" id="imgDesasignar_<?php print $intCorrelativo; ?>"  onclick="fntDesAsignar(<?php print $intCorrelativo; ?>)" class="glyphicon glyphicon-check" style="color: #149dee;  cursor: pointer;"  ></span>
                                                    <?php
                                                
                                                }
                                                else{
                                                    ?>
                                                    <span name="imgAsignar_<?php print $intCorrelativo; ?>" id="imgAsignar_<?php print $intCorrelativo; ?>"  onclick="fntAsignar(<?php print $intCorrelativo; ?>)" class="glyphicon glyphicon-unchecked" style="color: #149dee; cursor: pointer;" ></span>
                                                    <span name="imgDesasignar_<?php print $intCorrelativo; ?>" id="imgDesasignar_<?php print $intCorrelativo; ?>"  onclick="fntDesAsignar(<?php print $intCorrelativo; ?>)" class="glyphicon glyphicon-check" style="color: #149dee; display: none; cursor: pointer;"  ></span>
                                                    <?php
                                                }
                                            ?>
                                            
                                            
                                            <input type="hidden" id="hdnAsignado_<?php print $intCorrelativo ?>" name="hdnAsignado_<?php print $intCorrelativo ?>"  value="<?php print $arrTMP["asignado"] ?>" >
                                        </td>
                                        <td>
                                            <span name="imgDeleteAlumno_<?php print $intCorrelativo; ?>" id="imgDeleteAlumno_<?php print $intCorrelativo; ?>"  onclick="fntDeleteAlumno(<?php print $intCorrelativo; ?>,'Y')" class="glyphicon glyphicon-trash btn-md cursor" style="color: #149dee; cursor: pointer;" ></span>
                                            <span name="imgRevertAlumno_<?php print $intCorrelativo; ?>" id="imgRevertAlumno_<?php print $intCorrelativo; ?>"  onclick="fntRevertirAlumno(<?php print $intCorrelativo; ?>,'N')" class="fa fa-undo fa-md cursor fa-color btn-sm" style="color: #149dee; display: none; cursor: pointer;" ></span>
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
                                <td colspan="3" >
                                     <div class="col-lg-12">
                                      <span id="imgAddNewHorario" onclick="fntAddNewHorario();" class="glyphicon glyphicon-plus btn-glyphicon-sm-cursor-color"></span>  
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <script>
            var intIndex = parseInt(<?php print $intCorrelativo; ?>);
            function fntAddNewHorario(){
                     strHtml = '<tr>'+
                                    '<td>'+
                                        '<input type="text" id="txtNombreAlumno_'+intIndex+'" name="txtNombreAlumno_'+intIndex+'" class="form-control"  placeholder="Alumno" value=""  >'+
                                        '<input type="hidden" id="hdnIdAlumno_'+intIndex+'" name="hdnIdAlumno_'+intIndex+'"  value="" >'+
                                        '<input type=hidden  id="hdnUpdateAlumno_'+intIndex+'" name="hdnUpdateAlumno_'+intIndex+'" value="N" >'+
                                        '<input type=hidden  id="hdnNew_'+intIndex+'" name="hdnNew_'+intIndex+'" value="Y" >'+
                                        '<input type=hidden  id="hdnAsignado_'+intIndex+'" name="hdnAsignado_'+intIndex+'" value="Y" >'+
                                    '</td>'+
                                    '<td class="text-center" >'+
                                        '<span name="imgAsignar_'+intIndex+'" id="imgAsignar_'+intIndex+'"  onclick="fntAsignar('+intIndex+')" class="glyphicon glyphicon-unchecked" style="color: #149dee; cursor: pointer;" ></span>'+
                                        '<span name="imgDesasignar_'+intIndex+'" id="imgDesasignar_'+intIndex+'"  onclick="fntDesAsignar('+intIndex+')" class="glyphicon glyphicon-check" style="color: #149dee; display: none; cursor: pointer;"  ></span>'+
                                    '</td>'+
                                     '<td>'+
                                        '<span id="imgDeleteAlumno_'+intIndex+'" name="imgDeleteAlumno_'+intIndex+'" onclick="fntDeleteHorarioJs('+intIndex+')" class="glyphicon glyphicon-trash "  style="color: #149dee;" ></span>'+
                                   '</td>'+
                               '</tr>';
                    $("#tblAsignacion > tbody ").append(strHtml);
                    fntAutocomplete(intIndex);
                    console.log(intIndex);
                    
                    
                  
                        
                    intIndex++;
              }
              
            function fntAutocomplete(intIndex){
                  
                  
                    $("#txtNombreAlumno_"+intIndex).autocomplete({
                         source: '<?php print $strAction; ?>'+"?sendAutoCompleteAlumno=true",
                         minLength: 1,
                        response: function( event, ui ) {
                            //$("#hdnIdAlumno_"+intIndex).val("");
                        },
                        select: function( event, ui ) {
                            $("#hdnIdAlumno_"+intIndex).val(ui.item.id);
                            
                        },
                        change:function( event, ui ) {

                        }
                    });
                  
              }
              
            function fntDeleteHorarioJs(rowIndex){
                $("#hdnDeleteAlumno_"+rowIndex).val("Y");

                //$("#imgRevertirHorario-"+rowIndex).show();
              //  $("#imgDeleteHorario-"+rowIndex).hide();

                objTable = getDocumentLayer("tblAsignacion");
                obj = getDocumentLayer("imgDeleteAlumno_"+rowIndex);
                objTr = obj.parentNode.parentNode;
                objTable.deleteRow(objTr.rowIndex);
            }
              
            $(function(){
                    $("input[name*='txtNombreAlumno_']").each(function(){
                        
                     var arrSplit  = $(this).attr("name").split("_");
                     console.log($("#txtNombreAlumno_1").val()); 
    
                      $("#txtNombreAlumno_"+arrSplit[1]).autocomplete({
                         source: '<?php print $strAction; ?>'+"?sendAutoCompleteAlumno=true",
                         minLength: 1,
                            response: function( event, ui ) {
                                //$("#hdnIdAlumno_"+arrSplit[1]).val("");
                            },
                            select: function( event, ui ) {
                                $("#hdnIdAlumno_"+arrSplit[1]).val(ui.item.id);
                            },
                            change:function( event, ui ) {
                            
                            }
                        });

                    });
                });
            
            function fntAsignar(intCorrelativo,strAsignar){
                
                //Si esta asignado
                $("#hdnAsignado_"+intCorrelativo).val("Y");    
                $("#imgAsignar_"+intCorrelativo).hide();    
                $("#imgDesasignar_"+intCorrelativo).show();    
            } 
            
            function fntDesAsignar(intCorrelativo,strAsignar){
                //Si no esta asignado
                $("#hdnAsignado_"+intCorrelativo).val("N");
                $("#imgDesasignar_"+intCorrelativo).hide();
                $("#imgAsignar_"+intCorrelativo).show();    
                    
            }
            
            function fntDeleteAlumno(rowIndex){
                $("#hdnDeleteAlumno_"+rowIndex).val("Y");

                 $("#imgRevertAlumno_"+rowIndex).show();
                 $("#imgDeleteAlumno_"+rowIndex).hide();

                var objTr = $("#imgDeleteAlumno_"+rowIndex).parent().parent();
                $(objTr).children().css("background-color","#f2dede");
            } 
            function fntRevertirAlumno(intIndexRevertir){

                fntDestroyPopovers();

                $("#hdnDeleteAlumno_"+intIndexRevertir).val("N");

                $("#imgRevertAlumno_"+intIndexRevertir).hide();
                $("#imgDeleteAlumno_"+intIndexRevertir).show();

                var objTr = $("#imgDeleteAlumno_"+intIndexRevertir).parent().parent();
                $(objTr).children().css("background-color","");
            }
            
            function fntDestroyPopovers(){
                $("input").popover("destroy");
                $("destroy").popover("destroy");
                $("select").popover("destroy");
                $("div").popover("destroy");
                $("textarea").popover("destroy");
                $("a").popover("destroy");
                $("span").popover("destroy");
            }
            
            function fntGuardar(){
                
                document.frmUnidades.submit();
            }
               
        </script>
        <?php
    }
    
}
?>
 