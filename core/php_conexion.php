<?php
$conexion = mysql_connect("localhost","root","");
mysql_select_db("cemucaf",$conexion);
date_default_timezone_set("America/Guatemala");
//mysqli_query("SET NAMES 'utf8'");

function limpiar($tags){
        $tags = strip_tags($tags);
        $tags = stripslashes($tags);
        $tags = mysql_real_escape_string($tags);
        return $tags;
}

function quitar_tildes($cadena) {
    $no_permitidas= array ("แ","้","ํ","๓","๚","ม","ษ","อ","ำ","ฺ","๑","ภ","ร","ฬ","า","ู","ร?","ร ","รจ","รฌ","รฒ","รน","็","ว","รข","๊","รฎ","รด","รป","ร?","ร?","ร?","ร?","ร?","ü","รถ","ร?","รฏ","รค","ซ","า","ร","ร?","ร?");
    $permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
    $texto = str_replace($no_permitidas, $permitidas ,$cadena);
    return $texto;
}

function core_removeSpecialChars( $strString ){
    $strReturn = "";
    $strReturn = str_replace(array("/"," ","%",";"), "", $strString);
    $strReturn = str_replace(array("แ","้","ํ","๓","๚","๑","เ","่","์","๒","๙","ม","ษ","อ","ำ","ฺ","ั","ภ","ศ","ฬ","า","ู"),
                           array("a","e","i","o","u","n","a","e","i","o","u","A","E","I","O","U","N","A","E","I","O","U"),
                           $strReturn);
    return $strReturn;
}
?>