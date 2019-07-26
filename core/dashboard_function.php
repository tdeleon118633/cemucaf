<?php
//print "hola";
function drawSliderNoticias(){
       //print "hola";
        $arrImagenesSlider = getImagenesSlider();
        $arrCursoAImpartir = getCursosActual();
        
        ?>
        
        <div class="row">&nbsp;</div>
        <?php 
        if( count($arrCursoAImpartir) ){    
        ?>
        <div class=" col-lg-12">
            <div class="row">
                <?php
                    reset($arrCursoAImpartir);
                    while( $rTMP2 = each($arrCursoAImpartir) ){
                    ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-12 text-left">
                                        <div class="" style="color: black" ><strong><?php print $rTMP2["value"]["nombre"] ?></strong></div>
                                        <div class=""><?php print $rTMP2["value"]["fecha_inicio"]."  AL  ".$rTMP2["value"]["fecha_fin"] ?></div>
                                        <div>
                                            Horarios:
                                            <?php
                                             $arrHorarioCursoAImpartir = getHorariosActual($rTMP2["value"]["curso"]);
                                             foreach( $arrHorarioCursoAImpartir as $ampHoraio  ){
                                                ?>
                                                <div><?php print $ampHoraio["dia"]." : DE ".$ampHoraio["hora_inicio"]." A ".$ampHoraio["hora_fin"] ?></div>
                                                <?php
                                             }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     <?php
                    }
                    ?>
                </div>
        </div>
        <?php
        }
        if( count($arrImagenesSlider) ){
        ?>
      
         <div class=" col-lg-12 text-center" border="1">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <div id="slider1_container" style="position: relative; top: 0px; left: -8px; rigth: -8px; width: 1750px; height: 600px; overflow: hidden;" class="col-lg-12 text-center">

                        <div u="loading" style="position: absolute; top: 5px; left: 5px;">
                            <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;background-color: #000000; top: 0px; left: 0px;width: 100%;height:100%;">
                            </div>
                            <div style="position: absolute; display: block; background: url(libraries/jssor/slider/img/loading.gif) no-repeat center center; top: 0px; left: 0px;width: 100%;height:100%;">
                            </div>
                        </div>
                        <div u="slides" class="cursor" style=" position: absolute; overflow: hidden; width: 1750px; height: 600px;">
                            <?php
                            while( $rTMP = each($arrImagenesSlider) ){
                                if(isset($rTMP["value"]["link"]) && $rTMP["value"]["link"] != ""){
                                    ?>
                                    <div class="col-lg-5"><a u="image" href="<?php echo $rTMP["value"]["link"] ?>" target="_blank"><img  src="<?php echo $rTMP["value"]["imagen"]; ?>"></a></div>
                                    <?php
                                }
                                else{
                                    ?>
                                    <div class="col-lg-5"><img u="image" src="<?php echo $rTMP["value"]["imagen"]; ?>"></div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <span u="arrowleft" class="jssora05l" style="width: 45px; height: 40px; top: 300px; left: 15px;">
                        </span>
                        <span u="arrowright" class="jssora05r" style="width: 45px; height: 40px; top: 300px; right: 15px">
                        </span>
                    </div>
                 </div>
            </div>
        </div>
        <div class="row">&nbsp;</div>
        
        
        <script>
            var _SlideshowTransitions = [
                {$Duration: 1200, $During: { $Left: [0.3, 0.7] }, $FlyDirection: 1, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }
                , { $Duration: 1200, $SlideOut: true, $FlyDirection: 2, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }
                , { $Duration: 1200, $During: { $Left: [0.3, 0.7] }, $FlyDirection: 2, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }
                , { $Duration: 1200, $SlideOut: true, $FlyDirection: 1, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }

                , { $Duration: 1200, $During: { $Top: [0.3, 0.7] }, $FlyDirection: 4, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }
                , { $Duration: 1200, $SlideOut: true, $FlyDirection: 8, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }
                , { $Duration: 1200, $During: { $Top: [0.3, 0.7] }, $FlyDirection: 8, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }
                , { $Duration: 1200, $SlideOut: true, $FlyDirection: 4, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }

                , { $Duration: 1200, $Cols: 2, $During: { $Left: [0.3, 0.7] }, $FlyDirection: 1, $ChessMode: { $Column: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }
                , { $Duration: 1200, $Cols: 2, $SlideOut: true, $FlyDirection: 1, $ChessMode: { $Column: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }
                , { $Duration: 1200, $Rows: 2, $During: { $Top: [0.3, 0.7] }, $FlyDirection: 4, $ChessMode: { $Row: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }
                , { $Duration: 1200, $Rows: 2, $SlideOut: true, $FlyDirection: 4, $ChessMode: { $Row: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }

                , { $Duration: 1200, $Cols: 2, $During: { $Top: [0.3, 0.7] }, $FlyDirection: 4, $ChessMode: { $Column: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }
                , { $Duration: 1200, $Cols: 2, $SlideOut: true, $FlyDirection: 8, $ChessMode: { $Column: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }
                , { $Duration: 1200, $Rows: 2, $During: { $Left: [0.3, 0.7] }, $FlyDirection: 1, $ChessMode: { $Row: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }
                , { $Duration: 1200, $Rows: 2, $SlideOut: true, $FlyDirection: 2, $ChessMode: { $Row: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }

                , { $Duration: 1200, $Cols: 2, $Rows: 2, $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] }, $FlyDirection: 5, $ChessMode: { $Column: 3, $Row: 12 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $ScaleVertical: 0.3, $Opacity: 2 }
                , { $Duration: 1200, $Cols: 2, $Rows: 2, $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] }, $SlideOut: true, $FlyDirection: 5, $ChessMode: { $Column: 3, $Row: 12 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $ScaleVertical: 0.3, $Opacity: 2 }

                , { $Duration: 1200, $Delay: 20, $Clip: 3, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
                , { $Duration: 1200, $Delay: 20, $Clip: 3, $SlideOut: true, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseOutCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
                , { $Duration: 1200, $Delay: 20, $Clip: 12, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
                , { $Duration: 1200, $Delay: 20, $Clip: 12, $SlideOut: true, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseOutCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
            ];
            var options = {
                $AutoPlay: true,
                $AutoPlayInterval: 1500,
                $PauseOnHover: 1,

                $DragOrientation: 3,
                $ArrowKeyNavigation: true,
                $SlideDuration: 800,

                $SlideshowOptions: {
                    $Class: $JssorSlideshowRunner$,
                    $Transitions: _SlideshowTransitions,
                    $TransitionsOrder: 1,
                    $ShowLink: false
                },

                $ArrowNavigatorOptions: {
                    $Class: $JssorArrowNavigator$,
                    $ChanceToShow: 2
                }
            };

            var jssor_slider1 = new $JssorSlider$('slider1_container', options);
            function ScaleSlider() {
                var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
                if (parentWidth)
                    jssor_slider1.$SetScaleWidth(Math.max(Math.min(parentWidth, 1750), 300));
                else
                    window.setTimeout(ScaleSlider, 30);

                $(function(){
                    $("div").each(function(){
                        if( $(this).attr("u") == "slides" && $(this).css("cursor") == "move" ){
                            var width = $(this).width();
                            $(this).width( width + 6 );
                        }
                    });
                });
            }
            ScaleSlider();

            if (!navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|IEMobile)/)) {
                $(window).bind('resize', ScaleSlider);
            }

            $(document).ready(function(){

                ScaleSlider();
            });

        </script>
       <?php
       }

}


function getCursosActual(){
    $arrData = array();
    $strQuery = "SELECT curso.curso,
                        curso.nombre,
                        curso.fecha_inicio,
                        curso.fecha_fin,
                        curso.tecnico_docente,
                        curso.activo,
                        curso_horario.horario,
                        curso_horario.hora_inicio,
                        curso_horario.hora_fin,
                        curso_horario.dia
                 FROM   curso,
                        curso_horario
                 WHERE  curso_horario.curso = curso.curso
                 AND    curso.activo = 'Y'
                 ORDER BY curso_horario.add_fecha
                 LIMIT 4";
            $qTMP = mysql_query($strQuery);
            while($rTMP = mysql_fetch_array($qTMP)){
                 $arrData[$rTMP["curso"]]["curso"] = $rTMP["curso"];
                 $arrData[$rTMP["curso"]]["nombre"] = $rTMP["nombre"];
                 $arrData[$rTMP["curso"]]["fecha_inicio"] = $rTMP["fecha_inicio"];
                 $arrData[$rTMP["curso"]]["fecha_fin"] = $rTMP["fecha_fin"];
            }
            return $arrData;
}

function getHorariosActual($intCurso){
    $arrData = array();
    $strQuery = "SELECT curso.curso,
                        curso.nombre,
                        curso.fecha_inicio,
                        curso.fecha_fin,
                        curso.tecnico_docente,
                        curso.activo,
                        curso_horario.horario,
                        curso_horario.hora_inicio,
                        curso_horario.hora_fin,
                        curso_horario.dia
                 FROM   curso,
                        curso_horario
                 WHERE  curso_horario.curso = curso.curso
                 AND    curso_horario.curso = {$intCurso}
                 ORDER BY curso_horario.add_fecha
                 LIMIT 4";
        $qTMP = mysql_query($strQuery);
        //print $strQuery;
        while($rTMP = mysql_fetch_array($qTMP)){
             $arrData[$rTMP["horario"]]["nombre"] = $rTMP["nombre"];
             $arrData[$rTMP["horario"]]["dia"] = $rTMP["dia"];
             $arrData[$rTMP["horario"]]["hora_inicio"] = $rTMP["hora_inicio"];
             $arrData[$rTMP["horario"]]["hora_fin"] = $rTMP["hora_fin"];
        }
    return $arrData;
}

function getImagenesSlider(){
        $arrData = array();
        $strQuery = "SELECT noticia.noticia,
                            noticia.imagen,
                            noticia.link
                     FROM   noticia
                     WHERE  noticia.activo = 'Y'
                     ORDER BY noticia.orden";
        $qTMP = mysql_query($strQuery);
        while($rTMP = mysql_fetch_array($qTMP)){
            $arrData[$rTMP["noticia"]]["imagen"] = $rTMP["imagen"];
            $arrData[$rTMP["noticia"]]["link"] = $rTMP["link"];
        }

        return $arrData;

    }
?>