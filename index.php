<?php

    session_start();
    include("Includes.php");
    include("ContentManager/Manager.php");
    include("ContentManager/Managers/ManageHome.php");
    include("ContentManager/Managers/ManageAdmin.php");
    
    include("WebObjects/HTMLContainer.php");
    include("WebObjects/HTMLPage.php");
    include("WebObjects/Login.php");
    include("WebObjects/Page.php");
    include("WebObjects/AdminPage.php");
    
    include("WebObjects/Panels/MainPanel.php");
    
    include("WebObjects/Panels/Left/DuomenuAnalizePanel.php");
    include("WebObjects/Panels/Left/Prognozes.php");
    include("WebObjects/Panels/Left/Filters.php");
    include("WebObjects/Panels/Left/UserManage.php");
    include("WebObjects/Panels/Left/TvarkymoPrognozavimas.php");
    include("WebObjects/Panels/Right/Lenteles.php");
    include("WebObjects/Panels/Right/Import.php");
    include("WebObjects/Panels/Right/Users.php");
    include("WebObjects/Panels/Right/AddUser.php");
    
    if(ErrorMessages::isErrors()){
        p(ErrorMessages::getErrors());
    }
    
    $GLOBALS['login'] = new Session();
    $pageManager = new Manager();
    
    if(!$GLOBALS['login']->isLogedin()){
        if(!in_array($pageManager->method, array("login", "logout"))){
            $pageManager->class = "home";
            $pageManager->method = "login";
            Message::setMessage("Neteisingi prisijungimo duomenys!");
        }
    }
    
    $pageManager->open();
    
?>