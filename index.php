<?php

    session_start();
    include("Includes.php");
    include("ContentManager/Manager.php");
    include("ContentManager/Managers/ManageHome.php");
    
    include("WebObjects/HTMLContainer.php");
    include("WebObjects/HTMLPage.php");
    include("WebObjects/Login.php");
    include("WebObjects/Page.php");
    
    include("WebObjects/Panels/MainPanel.php");
    
    include("WebObjects/Panels/Left/DuomenuAnalizePanel.php");
    include("WebObjects/Panels/Left/Prognozes.php");
    include("WebObjects/Panels/Right/Lenteles.php");
    
    if(ErrorMessages::isErrors()){
        p(ErrorMessages::getErrors());
    }
    
    $GLOBALS['login'] = new Session();
    $pageManager = new Manager();
    
    if(!$GLOBALS['login']->isLogedin()){
        $pageManager->class = "home";
        $pageManager->method = "login";
        Message::setMessage("Neteisingi prisijungimo duomenys!");
    }
    
    $pageManager->open();
    
?>