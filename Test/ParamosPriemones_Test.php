<?php

    session_start();
    include("../Includes.php");
    
    ParamosPriemones::insertToDB("gavno", "Labas", "1");
    
    $pp = ParamosPriemones::select("1");
    p($pp);
    
    $ppriemones = new ParamosPriemones($pp[0]);  
    ParamosPriemones::update($pp[0], array('Pavadinimas' => 'ISSSSS'));
    echo "<br />".$ppriemones->getPavadinimas();
    
    ParamosPriemones::delete(1);

?>
