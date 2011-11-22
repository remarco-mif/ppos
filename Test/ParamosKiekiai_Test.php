<?php

    session_start();

    include("../Includes.php");
    
    print("insert: " . ParamosKiekiai::insertToDb(1, "2011-12-01", "2011-12-30", 32) . "<br>");
    print("error: " . ParamosKiekiai::$error . "<br>");
    
    p(ParamosKiekiai::select("1"));

    ParamosKiekiai::delete("4");
    
    ParamosKiekiai::update("5", array('ParaiskuKiekis'=>64));
    
    $parama = new ParamosKiekiai("5");
    print("Paraisku kiekis:" .  $parama->getParaiskuKiekis() . "<br>");
?>
