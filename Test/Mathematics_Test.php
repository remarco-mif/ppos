<?php

    session_start();
    require_once("../Includes.php");
    
    $ar1 = array(1, 10, 100, 1000);
    $ar2 = array(2008, 2009, 2010, 2011);
    
    
    echo "Vidurkis1: ".Mathematics::average($ar1)."<br>";
    echo "Vidurkis2: ".Mathematics::average($ar2)."<br>";
    
    echo "Suma: ".Mathematics::sum($ar2, 2)."<br>";
    
    echo "Skirtumu suma: ".Mathematics::skirtumuSuma($ar1)."<br>";
    
    echo "Koreliacijos kofas: ".Mathematics::correlationCof($ar1, $ar2)."<br>";
    
    echo (Mathematics::correlationCof($ar1, $ar2) * Mathematics::skirtumoSumosVidurkis($ar1)) + 1000;
    

?>
