<?php
    session_start();
    require_once("../Includes.php");
    

    
    $valandos = OrganizacijosPrognozes::getPadaliniuValandos(array(2));
    p($valandos);
        $valandos = OrganizacijosPrognozes::getParamosPriemoniuPrognozes(array(1, 2, 3));
    p($valandos);
   
?>