<?php

    session_start();

    include("Includes.php");
    
    $IS = IS::select("idIS > 0");
    p($IS);
    
    $is = new IS($IS[0]);
    
    IS::update($IS[0], array('Kodas' => 'ISSSSS'));
    
    echo "<br />".$is->getKodas();
    echo $is->getPavadinimas();
    
    IS::insertToDB("Bla", "gavno");
    echo IS::$error;
    
    IS::delete(2);

?>
