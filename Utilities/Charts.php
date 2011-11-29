<?php
    session_start();
    require_once("../Includes.php");
    
    define("CHART_WIDTH", 550);
    define("CHART_HEIGHT", 200);
    
    if (!isset($_GET["chart"])){
        ErrorMessages::setError(10, "null", "Charts.php");
        exit(0);
    }
    
    $chart = repairSqlInjection($_GET["chart"]);
    //$chartType = repairSqlInjection($_GET["type"]);
    
    $graph = new PHPGraphLib(CHART_WIDTH, CHART_HEIGHT);
    
    switch ($chart){
        case "padaliniu_paraiskos":
            if (!isset($_GET["menuo"])){
                ErrorMessages::setError(10, "null", "Charts.php");
                exit(0);
            }
            
            $data = $_GET["menuo"] . "-01";
            if (ObjectValidation::validateDate($data) == false){
                ErrorMessages::setError(12, "null", "Charts.php");
                exit(0);
            }
            
            $graph->setTitle($data);
            
            $dbQuery = "SELECT * FROM PadaliniuParaiskuKiekis WHERE Nuo = '" . $data . "'";
            $dbResult = db::select($dbQuery);
            $chartData = array();
            foreach ($dbResult["data"] as $i){
                $chartData[$i["Kodas"]] = $i["Paraiskos"];
            }
            
            break;
            
        case "is_paraiskos":
            if (!isset($_GET["menuo"])){
                ErrorMessages::setError(10, "null", "Charts.php");
                exit(0);
            }
            
            $data = $_GET["menuo"] . "-01";
            if (ObjectValidation::validateDate($data) == false){
                ErrorMessages::setError(12, "null", "Charts.php");
                exit(0);
            }
            
            $graph->setTitle($data);
            
            $dbQuery = "SELECT * FROM IsParaiskuKiekis WHERE Nuo = '" . $data . "'";
            $dbResult = db::select($dbQuery);
            $chartData = array();
            foreach ($dbResult["data"] as $i){
                $chartData[$i["Kodas"]] = $i["Paraiskos"];
            }
            
            break;
            
        case "padaliniu_valandos":
            if ((!isset($_GET["menuoNuo"])) || (!isset($_GET["menuoIki"]))){
                ErrorMessages::setError(10, "null", "Charts.php");
                exit(0);
            }
            
            $dataNuo = $_GET["menuoNuo"];
            $dataIki = $_GET["menuoIki"];
            $dataIki = date('Y-m-d',strtotime("$dataIki + 1 months"));
            if ((ObjectValidation::validateDate($dataNuo) == false) || (ObjectValidation::validateDate($dataIki) == false)){
                ErrorMessages::setError(12, "null", "Charts.php");
                exit(0);
            }
            
            $graph->setTitle($dataNuo . " - " . date('Y-m-d',strtotime("$dataIki - 1 day")));
   
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
                ErrorMessages::setError(10, "null", "Charts.php");
                exit(0);
            }
            
            $dataNuo = $_GET["menuoNuo"];
            $dataIki = $_GET["menuoIki"];
            $dataIki = date('Y-m-d',strtotime("$dataIki + 1 months"));
            if ((ObjectValidation::validateDate($dataNuo) == false) || (ObjectValidation::validateDate($dataIki) == false)){
                ErrorMessages::setError(12, "null", "Charts.php");
                exit(0);
            }
            
            $graph->setTitle($dataNuo . " - " . date('Y-m-d',strtotime("$dataIki - 1 day")));
   
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
                ErrorMessages::setError(11, "null", "Charts.php");
                exit(0);
                break;
    }
    
    $graph->addData($chartData);
    $graph->setGradient('red', 'maroon');
    $graph->setDataValues(true);
    $graph->createGraph();
?>