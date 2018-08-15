<?php
$conexion = mysql_connect("localhost","root","");
mysql_select_db("cemucaf_db",$conexion);
date_default_timezone_set("America/Guatemala");

function limpiar($tags){
        $tags = strip_tags($tags);
        $tags = stripslashes($tags);
        $tags = mysql_real_escape_string($tags);
        return $tags;
}
?>