<?php

    session_start();
    include("../../Includes.php");
    include("../../WebObjects/Panels/MainPanel.php");
    include("../../WebObjects/Panels/Right/PadalyniuPrieDiagramosMygtukai.php");
    
    
    if(ErrorMessages::isErrors()){
        p(ErrorMessages::getErrors());
    }
    
    $login = new Session();
    
    if(!$login->isLogedin()){
        die("You must loged in!");
    }
    
    $paramosPriemones = explode(",", $_GET['param']);
    
    if(!empty($paramosPriemones[0])){
        $prog = OrganizacijosPrognozes::getPadaliniuValandos($paramosPriemones);
    }else{
        $prog = array();
    }
    
    
    
    $panel = new PadalyniuPrieDiagramosMygtukai($prog);
    echo $panel->getHtml();

?>
