<?php

    session_start();
    include("../../Includes.php");
    
    function redirect(){
        header("location: ../../index.php?info=admin/vartotojai");
    }
    
    $login = new Session(1);
    
    if(!$login->isLogedin()){
        die("false:::You must loged in!");
    }  
    
    if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
    }else{
        die("false:::Nepaskirtas id!");
    }
    
    if(User::delete($id)){
        die("true:::Vartotojas ištrintas sėkmingai.");
    }else{
        die("false:::Vartotojo istrinti nepavyko! ".User::$error);
    }

?>
