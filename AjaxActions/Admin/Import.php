<?php

    session_start();
    include("../../Includes.php");
    
    function redirect(){
        header("location: ../../index.php?info=admin/vartotojai");
    }
    
    $login = new Session(1);
    
    if(!$login->isLogedin()){
        die("You must loged in!");
    }
   
    $file = $_FILES['file'];
    
    if($file['error'] != 0){
        die("<p style='color:red;'>Ivyko klaida ikeliant faila! Error nr: ".$file['error']."</p>");
    }
    
    if($file['type'] != "application/vnd.ms-excel"){
        die("<p style='color:red;'>Blogas failo formatas!</p>");
    }
    
    $importer = new Importer($file['tmp_name']);
    $importer->import();
    
    echo "<p style='color:green;'>Importuota.</p>";

?>
