<?php
    session_start();
    require_once("../Includes.php");
    
    //p(OrganizacijosPrognozes::getTinkamiausiasLaikasPadalinioKvalifikacijai(7));
    p(OrganizacijosPrognozes::getTinkamiausiasLaikasPadalinioRemontui(8));
    
    $valandos = OrganizacijosPrognozes::getPadaliniuValandos(array(100));
    p($valandos);
    
    print("<br/>------------------------------------<br/>");
    
   $valandos = OrganizacijosPrognozes::getIsValandos(array(1));
    p($valandos);
?>