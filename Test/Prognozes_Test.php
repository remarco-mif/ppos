<?php
    session_start();
    require_once("../Includes.php");
    
       $valandos = OrganizacijosPrognozes::getPadaliniuValandos(array(1,2));
    p($valandos);
    
    print("<br/>------------------------------------<br/>");
    
   $valandos = OrganizacijosPrognozes::getIsValandos(array(1));
    p($valandos);
?>