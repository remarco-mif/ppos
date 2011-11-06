<?php
    session_start();
    require_once("../Includes.php");
    
    function drawAnalysisGraph($graph){
        $graph->setGradient('red', 'maroon');
        $graph->setDataValues(true);
        $graph->setupXAxis(20);
        $graph->createGraph();
    }
    
    function drawPrognosisGraph($graph){
        $graph->setBars(false);
        $graph->setLine(true);
        $graph->setDataPoints(true);
        $graph->setDataPointColor('maroon');
        $graph->setDataValues(true);
        $graph->setDataValueColor('maroon');
        $graph->setupXAxis(25);
        $graph->createGraph();
    }
    
    define("STANDARD_CHART_WIDTH", 550);
    define("STANDARD_CHART_HEIGHT", 200);
    
    $chartWidth = STANDARD_CHART_WIDTH;
    $chartHeight = STANDARD_CHART_HEIGHT;
    if (isset($_GET["width"]))
        $chartWidth = (int)$_GET["width"];
    if (isset($_GET["height"]))
        $chartHeight = (int)$_GET["height"];
    
    if (!isset($_GET["chart"])){
        ImageText::createTextImage($chartWidth, $chartHeight, "Bloga nuoroda");
        exit(0);
    }
    
    $chart = repairSqlInjection($_GET["chart"]);
    //$chartType = repairSqlInjection($_GET["type"]);
    
    $graph = new PHPGraphLib($chartWidth, $chartHeight);
    
    switch ($chart){
        case "padaliniu_paraiskos":
            if (!isset($_GET["menuo"])){
                ImageText::createTextImage($chartWidth, $chartHeight, "Bloga nuoroda");
                exit(0);
            }
            
            $data = $_GET["menuo"] . "-01";
            if (ObjectValidation::validateDate($data) == false){
                ImageText::createTextImage($chartWidth, $chartHeight, "Blogas datos formatas");
                exit(0);
            }
            
            $graph->setTitle($data);
            
            $dbQuery = "SELECT * FROM PadaliniuParaiskuKiekis WHERE Nuo = '" . $data . "'";
            $dbResult = db::select($dbQuery);
            
            if (empty($dbResult["data"])){
                ImageText::createTextImage($chartWidth, $chartHeight, "Neturima duomenų apie pasirinktą mėnesį");
                exit(0);                
            }
            
            $chartData = array();
            foreach ($dbResult["data"] as $i){
                $chartData[$i["Kodas"]] = $i["Paraiskos"];
            }
            
            $graph->addData($chartData);
            drawAnalysisGraph($graph);
            break;
            
        case "is_paraiskos":
            if (!isset($_GET["menuo"])){
                ImageText::createTextImage($chartWidth, $chartHeight, "Bloga nuoroda");
                exit(0);
            }
            
            $data = $_GET["menuo"] . "-01";
            if (ObjectValidation::validateDate($data) == false){
                ImageText::createTextImage($chartWidth, $chartHeight, "Blogas datos formatas");
                exit(0);
            }
            
            $graph->setTitle($data);
            
            $dbQuery = "SELECT * FROM IsParaiskuKiekis WHERE Nuo = '" . $data . "'";
            $dbResult = db::select($dbQuery);
            
            if (empty($dbResult["data"])){
                ImageText::createTextImage($chartWidth, $chartHeight, "Neturima duomenų apie pasirinktą mėnesį");
                exit(0);                
            }
            
            $chartData = array();
            foreach ($dbResult["data"] as $i){
                $chartData[$i["Kodas"]] = $i["Paraiskos"];
            }

            $graph->addData($chartData);
            drawAnalysisGraph($graph);
            break;
            
        case "padaliniu_valandos":
            if ((!isset($_GET["menuoNuo"])) || (!isset($_GET["menuoIki"]))){
                ImageText::createTextImage($chartWidth, $chartHeight, "Bloga nuoroda");
                exit(0);
            }
            
            $dataNuo = $_GET["menuoNuo"] . "-01";
            $dataIki = $_GET["menuoIki"] . "-01";
            if ((ObjectValidation::validateDate($dataNuo) == false) || (ObjectValidation::validateDate($dataIki) == false)){
                ImageText::createTextImage($chartWidth, $chartHeight, "Blogas datos formatas");
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
                ImageText::createTextImage($chartWidth, $chartHeight, "Blogas laiko intervalas");
                exit(0);
            }
            
            if ($dataNuo < $minData)
                $dataNuo = $minData;
            if ($dataIki > $maxData)
                $dataIki = $maxData;
            $dataIki = date('Y-m-d',strtotime("$dataIki + 1 months"));
            
            if (($dataIki < $minData) || ($dataNuo > $maxData)){
                ImageText::createTextImage($chartWidth, $chartHeight, "Neturima duomenų apie pasirinktą laiko intervalą");
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

            $graph->addData($chartData);
            drawAnalysisGraph($graph);
            break;
            
        case "is_valandos":
            if ((!isset($_GET["menuoNuo"])) || (!isset($_GET["menuoIki"]))){
                ImageText::createTextImage($chartWidth, $chartHeight, "Bloga nuoroda");
                exit(0);
            }
            
            $dataNuo = repairSqlInjection($_GET["menuoNuo"]) . "-01";
            $dataIki = repairSqlInjection($_GET["menuoIki"]) . "-01";
            if ((ObjectValidation::validateDate($dataNuo) == false) || (ObjectValidation::validateDate($dataIki) == false)){
                ImageText::createTextImage($chartWidth, $chartHeight, "Blogas datos formatas");
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
                ImageText::createTextImage($chartWidth, $chartHeight, "Blogas laiko intervalas");
                exit(0);
            }
            
            if ($dataNuo < $minData)
                $dataNuo = $minData;
            if ($dataIki > $maxData)
                $dataIki = $maxData;
            $dataIki = date('Y-m-d',strtotime("$dataIki + 1 months"));
            
            if (($dataIki < $minData) || ($dataNuo > $maxData)){
                ImageText::createTextImage($chartWidth, $chartHeight, "Neturima duomenų apie pasirinktą laiko intervalą");
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

            $graph->addData($chartData);
            drawAnalysisGraph($graph);
            break;
            
            case "padaliniu_prognoze":

                if ((!isset($_GET["paramos_priemones"])) || (!isset($_GET["padaliniai"]))){
                    ImageText::createTextImage($chartWidth, $chartHeight, "Bloga nuoroda");
                    exit(0);
                }

                $chartData = array();
                //jei nenurodytos jokios paramos priemons
                if (strlen($_GET["paramos_priemones"]) > 0){ 
                    $paramosPriemones = explode(",", repairSqlInjection($_GET["paramos_priemones"]));
                    $padaliniuValandos = OrganizacijosPrognozes::getPadaliniuValandos($paramosPriemones);
                
                    if ($_GET["padaliniai"] == "all"){
                        $rodomiPadaliniai = array();
                        foreach ($padaliniuValandos as $padalinys => $menesiai){
                            $rodomiPadaliniai[] = $padalinys;
                        }
                    }
                    else
                        $rodomiPadaliniai = explode(",", repairSqlInjection($_GET["padaliniai"]));             

                    $chartTitles = array();
                    $chartLineColors = array();
                    
                    $menesiai = OrganizacijosPrognozes::getPrognozuojamiMenesiai();
                    
                    foreach ($padaliniuValandos as $idPadalinys => $padalinys){
                        $data = array();
                        
                        //inicializuojam kiekvieno menesio kiekius
                        foreach ($menesiai as $i)
                            $data[$i] = 0;

                        foreach ($padalinys as $menuo => $valandos){
                            $data[$menesiai[$menuo]] = $valandos;
                        }
                        
                        //tikrinama ar rastas padalinys yra rodomu padaliniu sarase
                        if (in_array($idPadalinys, $rodomiPadaliniai)){
                            $chartData[] = $data;
                            $chartLineColors[] = generateChartColor($idPadalinys);
                        }
                    }
                }
                
                //nerasta pasirinktu padaliniu
                if (sizeof($chartData) == 0){
                    $data = array();
                    $data[1] = 0;
                    $chartData[] = array(0); 
                    $chartLineColors[] = 'black';
                }

                call_user_func_array(array($graph, "addData"), $chartData);
                call_user_func_array(array($graph, "setLineColor"), $chartLineColors);
                drawPrognosisGraph($graph);
                break;
                
            case "is_prognoze":

                if ((!isset($_GET["paramos_priemones"])) || (!isset($_GET["is"]))){
                    ImageText::createTextImage($chartWidth, $chartHeight, "Bloga nuoroda");
                    exit(0);
                }

                $chartData = array();
                //jei nenurodytos jokios paramos priemons
                if (strlen($_GET["paramos_priemones"]) > 0){ 
                    $paramosPriemones = explode(",", repairSqlInjection($_GET["paramos_priemones"]));
                    $isValandos = OrganizacijosPrognozes::getIsValandos($paramosPriemones);
                
                    if ($_GET["is"] == "all"){
                        $rodomosIs = array();
                        foreach ($isValandos as $idIs => $menesiai){
                            $rodomosIs[] = $idIs;
                        }
                    }
                    else
                        $rodomosIs = explode(",", repairSqlInjection($_GET["is"]));      

                    $menesiai = OrganizacijosPrognozes::getPrognozuojamiMenesiai();                    

                    $chartTitles = array();
                    $chartLineColors = array();
                    foreach ($isValandos as $idIs => $is){
                        $data = array();
                        
                        //inicializuojam kiekvieno menesio kiekius
                        foreach ($menesiai as $i)
                            $data[$i] = 0;
                        foreach ($is as $menuo => $valandos){
                            $data[$menesiai[$menuo]] = $valandos;
                        }
                        
                        //tikrinama ar rastas padalinys yra rodomu padaliniu sarase
                        if (in_array($idIs, $rodomosIs)){
                            $chartData[] = $data;
                            $chartLineColors[] = generateChartColor($idIs);
                        }
                    }
                }
                
                //nerasta pasirinktu padaliniu
                if (sizeof($chartData) == 0){
                    $data = array();
                    $data[1] = 0;
                    $chartData[] = array(0); 
                    $chartLineColors[] = 'black';
                }

                call_user_func_array(array($graph, "addData"), $chartData);
                call_user_func_array(array($graph, "setLineColor"), $chartLineColors);
                drawPrognosisGraph($graph);
                break;
            
            default:
                ImageText::createTextImage($chartWidth, $chartHeight, "Bloga diagramos rūšis");
                exit(0);
                break;
    }
?>