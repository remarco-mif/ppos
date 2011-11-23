<?php

    session_start();
    include("../Includes.php");
    
    ParamosAdministravimas::insert(4, 1, 45);
    ParamosAdministravimas::update(445, 4, 1);
    echo ParamosAdministravimas::getValandos(4, 1);
    ParamosAdministravimas::delete(4, 1);

?>
