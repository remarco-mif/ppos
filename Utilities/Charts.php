<?php
    session_start();
    require_once("../Includes.php");
    
    define("CHART_WIDTH", 550);
    define("CHART_HEIGHT", 200);
    
    $chart = repairSqlInjection($_GET["chart"]);
    //$chartType = repairSqlInjection($_GET["type"]);
    
    $graph = new PHPGraphLib(CHART_WIDTH, CHART_HEIGHT);
    
    switch ($chart){
        case "padaliniu_paraiskos":
            $data = $_GET["menuo"];
            $graph->setTitle($data);
            
            $dbQuery = "SELECT * FROM PadaliniuParaiskuKiekis WHERE Nuo = '" . $data . "'";
            $dbResult = db::select($dbQuery);
            $chartData = array();
            foreach ($dbResult["data"] as $i){
                $chartData[$i["Kodas"]] = $i["Paraiskos"];
            }
            
            break;
            
        case "is_paraiskos":
            $data = $_GET["menuo"];
            $graph->setTitle($data);
            
            $dbQuery = "SELECT * FROM IsParaiskuKiekis WHERE Nuo = '" . $data . "'";
            $dbResult = db::select($dbQuery);
            $chartData = array();
            foreach ($dbResult["data"] as $i){
                $chartData[$i["Kodas"]] = $i["Paraiskos"];
            }
            
            break;
            
        case "padaliniu_valandos":
            $dataNuo = $_GET["menuoNuo"];
            $dataIki = $_GET["menuoIki"];
            $dataIki = date('Y-m-d',strtotime("$dataIki + 1 months"));
            $graph->setTitle($dataNuo . " - " . $dataIki);
   
            $chartData = array();
            $data = $dataNuo;
            while ($data != $dataIki){
                $dbQuery = "SELECT * FROM PadaliniuValanduKiekis WHERE Nuo = '" . $data . "'";
                $dbResult = db::select($dbQuery);
                
                foreach ($dbResult["data"] as $i){
                    if (!isset($chartData[$i["Kodas"]]))
                        $chartData[$i["Kodas"]] = $i["Valandos"];
                    else
                        $chartData[$i["Kodas"]] += $i["Valandos"];
                }
                $data = date('Y-m-d',strtotime("$data + 1 months"));
            } 
            
            break;
            
        case "is_valandos":
            $dataNuo = $_GET["menuoNuo"];
            $dataIki = $_GET["menuoIki"];
            $dataIki = date('Y-m-d',strtotime("$dataIki + 1 months"));
            $graph->setTitle($dataNuo . " - " . $dataIki);
   
            $chartData = array();
            $data = $dataNuo;
            while ($data != $dataIki){
                $dbQuery = "SELECT * FROM IsValanduKiekis WHERE Nuo = '" . $data . "'";
                $dbResult = db::select($dbQuery);
                
                foreach ($dbResult["data"] as $i){
                    if (!isset($chartData[$i["Kodas"]]))
                        $chartData[$i["Kodas"]] = $i["Valandos"];
                    else
                        $chartData[$i["Kodas"]] += $i["Valandos"];
                }
                $data = date('Y-m-d',strtotime("$data + 1 months"));
            } 
            
            break;
    }
    
    $graph->addData($chartData);
    $graph->setGradient('red', 'maroon');
    $graph->setDataValues(true);
    $graph->createGraph();
?>