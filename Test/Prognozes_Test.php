<?php
    session_start();
    require_once("../Includes.php");
    
    $res = explode(",", "");
    var_dump($res);
    
       $valandos = OrganizacijosPrognozes::getPadaliniuValandos(array(100));
    p($valandos);
    
    print("<br/>------------------------------------<br/>");
    
   $valandos = OrganizacijosPrognozes::getIsValandos(array(1));
    p($valandos);
?>