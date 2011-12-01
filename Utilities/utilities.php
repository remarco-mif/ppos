<?php

    function repairSqlInjection($string){
        $string = trim($string);
        //$string = htmlspecialchars($string, ENT_QUOTES);
        $string = str_replace("'", "&#39;", $string);
        return $string;
    }
    
    function generateChartColor($colorNr){
        $colors = array('black', 'gray', 'maroon', 'red', 'purple', 'fuscia', 'green',
                        'lime', 'olive', 'yellow', 'navy', 'blue', 'teal', 'aqua');
        if ($colorNr > sizeof($colors))
            $colorNr = $colorNr % sizeof($colors);
            
        return($colors[$colorNr - 1]);
    }

?>
