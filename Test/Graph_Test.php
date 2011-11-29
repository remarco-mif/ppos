<?php

    session_start();
    require_once("../Includes.php");

    print("<img src=\"../Utilities/Charts.php?chart=padaliniu_paraiskos&menuo=2008-01-01\">");
    $data = "2008-01-01";
    echo date('Y-m-d',strtotime("$data + 1 months"));
    
    p(ErrorMessages::getErrors());
?>