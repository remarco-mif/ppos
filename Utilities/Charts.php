<?php
    session_start();
    require_once("../Includes.php");
    
    define("CHART_WIDTH", 550);
    define("CHART_HEIGHT", 200);
    
    if (!isset($_GET["chart"])){
        ImageText::createTextImage(CHART_WIDTH, CHART_HEIGHT, "Bloga nuoroda");
        exit(0);
    }
    
    $chart = repairSqlInjection($_GET["chart"]);
    //$chartType = repairSqlInjection($_GET["type"]);
    
    $graph = new PHPGraphLib(CHART_WIDTH, CHART_HEIGHT);
    
    switch ($chart){
        case "padaliniu_paraiskos":
            if (!isset($_GET["menuo"])){
                ImageText::createTextImage(CHART_WIDTH, CHART_HEIGHT, "Bloga nuoroda");
                exit(0);
            }
            
            $data = $_GET["menuo"] . "-01";
            if (ObjectValidation::validateDate($data) == false){
                ImageText::createTextImage(CHART_WIDTH, CHART_HEIGHT, "Blogas datos formatas");
                exit(0);
            }
            
            $graph->setTitle($data);
            
            $dbQuery = "SELECT * FROM PadaliniuParaiskuKiekis WHERE Nuo = '" . $data . "'";
            $dbResult = db::select($dbQuery);
            
            if (empty($dbResult["data"])){
                ImageText::createTextImage(CHART_WIDTH, CHART_HEIGHT, "Neturima duomenų apie pasirinktą mėnesį");
                exit(0);                
            }
            
            $chartData = array();
            foreach ($dbResult["data"] as $i){
                $chartData[$i["Kodas"]] = $i["Paraiskos"];
            }
            
            break;
            
        case "is_paraiskos":
            if (!isset($_GET["menuo"])){
                ImageText::createTextImage(CHART_WIDTH, CHART_HEIGHT, "Bloga nuoroda");
                exit(0);
            }
            
            $data = $_GET["menuo"] . "-01";
            if (ObjectValidation::validateDate($data) == false){
                ImageText::createTextImage(CHART_WIDTH, CHART_HEIGHT, "Blogas datos formatas");
                exit(0);
            }
            
            $graph->setTitle($data);
            
            $dbQuery = "SELECT * FROM IsParaiskuKiekis WHERE Nuo = '" . $data . "'";
            $dbResult = db::select($dbQuery);
            
            if (empty($dbResult["data"])){
                ImageText::createTextImage(CHART_WIDTH, CHART_HEIGHT, "Neturima duomenų apie pasirinktą mėnesį");
                exit(0);                
            }
            
            $chartData = array();
            foreach ($dbResult["data"] as $i){
                $chartData[$i["Kodas"]] = $i["Paraiskos"];
            }
            
            break;
            
        case "padaliniu_valandos":
            if ((!isset($_GET["menuoNuo"])) || (!isset($_GET["menuoIki"]))){
                ImageText::createTextImage(CHART_WIDTH, CHART_HEIGHT, "Bloga nuoroda");
                exit(0);
            }
            
            $dataNuo = $_GET["menuoNuo"] . "-01";
            $dataIki = $_GET["menuoIki"] . "-01";
            if ((ObjectValidation::validateDate($dataNuo) == false) || (ObjectValidation::validateDate($dataIki) == false)){
                ImageText::createTextImage(CHART_WIDTH, CHART_HEIGHT, "Blogas datos formatas");
                exit(0);
            }
            
            $graph->setTitle($dataNuo . " - " . date('Y-m-d',strtotime("$dataIki - 1 day + 1 months")));
            
            $dbQuery = "SELECT MIN(Nuo) AS `min` FROM PadaliniuValanduKiekis";
            $dbResult = db::select($dbQuery);
            $minData = $dbResult["data"][0]["min"];
            $dbQuery = "SELECT MAX(Nuo) AS `max` FROM PadaliniuValanduKiekis";
            $dbResult = db::select($dbQuery);
            $maxData = $dbResult["data"][0]["max"];
            
            if ($dataNuo > $dataIki){
                ImageText::createTextImage(CHART_WIDTH, CHART_HEIGHT, "Blogas laiko intervalas");
                exit(0);
            }
            
            if ($dataNuo < $minData)
                $dataNuo = $minData;
            if ($dataIki > $maxData)
                $dataIki = $maxData;
            $dataIki = date('Y-m-d',strtotime("$dataIki + 1 months"));
            
            if (($dataIki < $minData) || ($dataNuo > $maxData)){
                ImageText::createTextImage(CHART_WIDTH, CHART_HEIGHT, "Neturima duomenų apie pasirinktą laiko intervalą");
                exit(0);
            }
   
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
            if ((!isset($_GET["menuoNuo"])) || (!isset($_GET["menuoIki"]))){
                ImageText::createTextImage(CHART_WIDTH, CHART_HEIGHT, "Bloga nuoroda");
                exit(0);
            }
            
            $dataNuo = $_GET["menuoNuo"] . "-01";
            $dataIki = $_GET["menuoIki"] . "-01";
            if ((ObjectValidation::validateDate($dataNuo) == false) || (ObjectValidation::validateDate($dataIki) == false)){
                ImageText::createTextImage(CHART_WIDTH, CHART_HEIGHT, "Blogas datos formatas");
                exit(0);
            }
            
            $graph->setTitle($dataNuo . " - " . date('Y-m-d',strtotime("$dataIki - 1 day + 1 months")));
            
            $dbQuery = "SELECT MIN(Nuo) AS `min` FROM IsValanduKiekis";
            $dbResult = db::select($dbQuery);
            $minData = $dbResult["data"][0]["min"];
            $dbQuery = "SELECT MAX(Nuo) AS `max` FROM IsValanduKiekis";
            $dbResult = db::select($dbQuery);
            $maxData = $dbResult["data"][0]["max"];
            
            if ($dataNuo > $dataIki){
                ImageText::createTextImage(CHART_WIDTH, CHART_HEIGHT, "Blogas laiko intervalas");
                exit(0);
            }
            
            if ($dataNuo < $minData)
                $dataNuo = $minData;
            if ($dataIki > $maxData)
                $dataIki = $maxData;
            $dataIki = date('Y-m-d',strtotime("$dataIki + 1 months"));
            
            if (($dataIki < $minData) || ($dataNuo > $maxData)){
                ImageText::createTextImage(CHART_WIDTH, CHART_HEIGHT, "Neturima duomenų apie pasirinktą laiko intervalą");
                exit(0);
            }
   
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
            
            default:
                ImageText::createTextImage(CHART_WIDTH, CHART_HEIGHT, "Bloga diagramos rūšis");
                exit(0);
                break;
    }
    
    $graph->addData($chartData);
    $graph->setGradient('red', 'maroon');
    $graph->setDataValues(true);
    $graph->setupXAxis(20);
    $graph->createGraph();
?>