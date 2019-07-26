<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<?php
//phpinfo();

$strFieldNameId = true;
draw_file($strFieldNameId);
function draw_file($strFieldNameId){
        $strFieldNameId["FileTypeOnclik"] = "https";
        $strFieldNameId["IdFileTypeOnclick"] = "";
        print "A";
        if( isset($strFieldNameId) ) {
             print "B";
            $strReadMode = ($strFieldNameId) ? "ocultar" : "";
            ?>
            <div id="ContenttxtAdjuntoCurso" class="<?php print $strReadMode; ?>">
                <?php
                if( !$strFieldNameId["FileTypeOnclik"] ){
                    print "D";
                    ?>
                    <table>
                        <tr>
                            <td width="80%" style="border: 1px solid black; text-align: right;">
                                <input type="" id="DivtexttxtAdjuntoCurso" readonly="readonly" class="form-control" value="" style="background-color: white; border-radius: none; border: none;height: 28px;">
                                <input type="file" id="txtAdjuntoCurso" class="form-control" name="txtAdjuntoCurso" style="display: none;" value="">
                            </td>
                            <td id="tdNombretxtAdjuntoCurso" width="20%" style=" cursor: pointer; background: #E0E0E0; color: #808080; font-size: 14px;  padding: 1px 25px 1px 5px; border: 1px solid #E0E0E0;" >Examinar...</td>
                        </tr>
                    </table>
                    <script>
                    console.log("D -");
                        <?php
                       
                        if ( !empty($strFieldNameId["IdFileTypeOnclick"]) ){
                            //console.log("E");
                            ?>
                            console.log("E");
                            $("#").click(function (){ $("#txtAdjuntoCurso").click();});
                            <?php
                        }
                        ?>
                        console.log("G");
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
                    <?php
                }
                else {
                   
                    ?>
                    <input type="file" id="txtAdjuntoCurso" name="txtAdjuntoCurso" style="display: none;" value="">
                    <?php
                    if ( !empty($this->arrFormFields[$strFieldNameId]["IdFileTypeOnclick"]) ){
                        ?>
                        <script>
                            $("#<?php print $this->arrFormFields[$strFieldNameId]["IdFileTypeOnclick"];?>").click(function (){ $("#txtAdjuntoCurso").click();});
                        </script>
                        <?php
                    }
                    
                }
                ?>
            </div>
            <?php
            print "Z";
           // if( $strFieldNameId ) {
                //$strReadMode = ($this->arrFormFields[$strFieldNameId]["readMode"] ) ? "" : "ocultar";
                ?>
                <div id="divReadModetxtAdjuntoCurso" class="form-control-static ">
                    <?php
                  //  if( !empty($this->arrFormFields[$strFieldNameId]["value"]) ){
                        ?>
                        <a class="fa fa-download cursor" href="<?php print "" ?>" download="" target="_blank">DA</a>
                        <?php
                    //}
                    ?>
                   
                </div>
                <?php
           // }
              
        }
                                                          
    }
?>