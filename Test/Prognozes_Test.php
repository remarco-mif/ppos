<?php
    session_start();
    require_once("../Includes.php");
    
    $valandos = OrganizacijosPrognozes::getPadaliniuValandos(array(2));
    p($valandos);

    IS_Padaliniai::
   
?>