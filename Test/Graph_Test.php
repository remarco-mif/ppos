<?php

    session_start();
    require_once("../Includes.php");
    
    $data = db::select("SELECT * FROM PadaliniuParaiskuKiekis WHERE Nuo = '2008-01-01'");
    $newData = array();
    foreach ($data["data"] as $i){
        $newData[$i["Kodas"]] = $i["Paraiskos"];
    }
    
    $graph = new PHPGraphLib(550, 200);
    $graph->addData($newData);
    $graph->setTitle('2008-01-01');
    $graph->setGradient($_GET["color"], 'maroon');
    $graph->setDataValues(true);
    $graph->createGraph();
    
    p(ErrorMessages::getErrors());
?>