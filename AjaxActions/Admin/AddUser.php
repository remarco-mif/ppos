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
    
    if(isset($_POST['pass']) && !empty($_POST['pass'])){
        $pass = $_POST['pass'];
    }else{
        Message::setMessage("Nepaskirtas slaptažodis!");
        redirect();
        exit;
    }
        
    if(isset($_POST['pass1']) && !empty($_POST['pass1'])){
        $pass1 = $_POST['pass1'];
    }else{
        Message::setMessage("Nepaskirtas antras slaptažodis!");
        redirect();
        exit;
    }
    
    if(isset($_POST['nick']) && !empty($_POST['nick'])){
        if(!User::isExist("User", "Username", $_POST['nick'])){
            $nick = $_POST['nick'];
        }else{
            Message::setMessage("Vartotojas vardu ".$_POST['nick']." jau egzistuoja!");
            redirect();
            exit;
        }
    }else{
        Message::setMessage("Vartotojas nepaskirtas!");
        redirect();
        exit;
    }
    
    if(isset($_POST['isAdmin'])){
        $isAdmin = (int)$_POST['isAdmin'];
    }else{
        Message::setMessage("Nepaskirtas vartotojo tipas!");
        redirect();
        exit;
    }
    
    if($pass == $pass1){
        if(User::insertToDB($nick, $pass, $isAdmin)){
            Message::setMessage("Vartotojas įtrauktas sėkmingai!");    
        }else{
            Message::setMessage("Nepavyko įtraukti vartotojos! ".User::$error);
        }
        redirect();
        exit;
    }else{
        Message::setMessage("Slaptažodžiai nesutampa!");
        redirect();
        exit;
    }

?>
