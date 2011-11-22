<?php

    function repairSqlInjection($string){
        $string = trim($string);
        //$string = htmlspecialchars($string, ENT_QUOTES);
        $string = str_replace("'", "&#39;", $string);
        return $string;
    }

?>
