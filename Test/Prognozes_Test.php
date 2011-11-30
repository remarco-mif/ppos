<?php
    session_start();
    require_once("../Includes.php");
    
    /*
    for ($i = 1; $i <= 12; $i++){
        $res = Prognozes::getMenesioParamosKiekius(1, $i);
        $prognoze = Prognozes::prognozuotiKieki($res);
        //p($res);
        print($i . " " . $prognoze . "<br/>");
    }
    */
    
    $planuojamiKiekiai = array();
    
    for ($j = 1; $j <= 27; $j++){
        $kiekiai = array();
        $paramosPriemone = $j;
        
        for ($i = 1; $i <= 12; $i++){
            $res = Prognozes::getMenesioParamosKiekius($paramosPriemone, $i);
            $prognoze = Prognozes::prognozuotiKieki($res);
            $kiekiai[$i] = $prognoze;
        }
        $planuojamiKiekiai[$paramosPriemone] =  $kiekiai;
    }
    
    $valandos = Prognozes::getPadaliniuApkrovimas($planuojamiKiekiai);
    p($valandos);
?>