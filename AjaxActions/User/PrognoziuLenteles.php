<?php

    session_start();
    include("../../Includes.php");
    include("../../WebObjects/Panels/MainPanel.php");
    include("../../WebObjects/Panels/Right/ParamosPriemoniuPrognoziuLentele.php");
    
    
    if(ErrorMessages::isErrors()){
        p(ErrorMessages::getErrors());
    }
    
    $login = new Session();
    
    if(!$login->isLogedin()){
        die("You must loged in!");
    }
    
    $paramosPriemones = explode(",", $_GET['param']);
    
    
    if(!empty($paramosPriemones[0])){
        $prog = OrganizacijosPrognozes::getParamosPriemoniuPrognozes($paramosPriemones);
    }else{
        $prog = array();
    }
    
    $panel = new ParamosPriemoniuPrognoziuLentele($prog);
    echo $panel->getHtml();

?>
