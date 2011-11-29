<?php

    session_start();
    include("../../Includes.php");
    include("../../WebObjects/Panels/MainPanel.php");
    include("../../WebObjects/Panels/Left/Apmps.php");
    
    
    if(ErrorMessages::isErrors()){
        p(ErrorMessages::getErrors());
    }
    
    $login = new Session();
    
    if(!$login->isLogedin()){
        die("You must loged in!");
    }
    
    $panel = new Apmps();
    echo $panel->getHtml();

?>
