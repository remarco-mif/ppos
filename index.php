<?php

    session_start();
    include("Includes.php");
    include("ContentManager/Manager.php");
    include("ContentManager/Managers/ManageHome.php");
    
    if(ErrorMessages::isErrors()){
        p(ErrorMessages::getErrors());
    }
    
    $pageManager = new Manager();
    $pageManager->open();
    
?>