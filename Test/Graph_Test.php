<?php

    session_start();
    require_once("../Includes.php");
    
    require_once("../phpgraph/phpgraphlib.php");
    
    
    $data = db::select("SELECT * FROM MenesiuPadaliniuApkrovimas WHERE Nuo = '2008-01-01'");
    $newData = array();
    foreach ($data["data"] as $i){
        $newData[$i["Kodas"]] = $i["ParaiskuKiekis"];
    }
    
    $graph = new PHPGraphLib(550, 200);
    $graph->addData($newData);
    $graph->setTitle('2008-01-01');
    $graph->setGradient('red', 'maroon');
    $graph->setDataValues(true);
    $graph->createGraph();
    
    p(ErrorMessages::getErrors());
?>