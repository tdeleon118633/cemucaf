<?php
function core_is_login() {
    
    $boolLogin = false;
    
    if( isset($_SESSION["hml"]["persona"]) && $_SESSION["hml"]["persona"] > 0 )
        $boolLogin = $_SESSION["hml"]["logged"];
    
    return $boolLogin;
    
}
?>