<?php

    function repairSqlInjection($string){
        $string = trim($string);
        //$string = htmlspecialchars($string, ENT_QUOTES);
        $string = str_replace("'", "&#39;", $string);
        return $string;
    }
    
    function generateChartColor($colorNr){
        $colors = array("#000000", "#C0C0C0", "#A00000", "#FF0000", "#FF00FF", "#00FF00", "#0000FF",
                        "#00FFFF", "#CC9900", "#003300", "#1155AA", "#FF5511", "#BBAA55");
        if ($colorNr > sizeof($colors))
            $colorNr = $colorNr % sizeof($colors);
            
        return($colors[$colorNr - 1]);
    }

?>
