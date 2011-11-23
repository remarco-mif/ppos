<?php

    session_start();

    include("../Includes.php");
    
    ParamosPriemoniuKryptys::insertToDB("gavno");
    
    $ppk = ParamosPriemoniuKryptys::select("1");
    p($ppk);
    
    $kryptys = new ParamosPriemoniuKryptys($ppk[0]);
    
    ParamosPriemoniuKryptys::update($ppk[0], array('Pavadinimas' => 'ISSSSS'));
    
    echo "<br />".$kryptys->getPavadinimas();
    
    ParamosPriemoniuKryptys::delete(2);

?>
