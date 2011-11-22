<?php

    session_start();

    include("../Includes.php");
    
    $padaliniai = Padaliniai::select("idPadaliniai > 0");
    p($padaliniai);
    
    $padalinys = new Padaliniai($padaliniai[0]);
    
    Padaliniai::update($padaliniai[0], array('Kodas' => 'ISSSSS'));
    
    echo "<br />".$padalinys->getKodas();
    echo $padalinys->getPavadinimas();
    
    Padaliniai::insertToDB("Bla", "gavno");
    echo Padaliniai::$error;
    
    Padaliniai::delete(2);

?>
