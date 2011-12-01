<?php
    session_start();
    require_once("../Includes.php");
    
    $valandos = OrganizacijosPrognozes::getPadaliniuValandos(array(2));
    p($valandos);

    $is = IS_Padaliniai::getNaudojamosIs(1);
    p($is);
?>