<?php

    session_start();
    require_once("../Includes.php");

    //print("<img src=\"../Utilities/Charts.php?chart=padaliniu_paraiskos&menuo=2008-01-01\">");
    $graph = new PHPGraphLib(650,200);
    $data1 = array(0);
    $data2 = array(8, 15, 4, 12);
    $data3 = array(1, 2, 3, 4);
    $graph->addData($data1);
    $graph->setTitle('PPM Per Container');
    $graph->setBars(false);
    $graph->setLine(true);
    $graph->setLineColor('blue', 'green', 'red');
    //$graph->setDataPoints(true);
    $graph->setDataPointColor('maroon');
    //$graph->setDataValues(true);
    $graph->setDataValueColor('maroon');
    $graph->setLegend(true);
    $graph->setLegendTitle("PA1", "PA2", "PA3");
    $graph->createGraph();
    
    p(ErrorMessages::getErrors());
?>