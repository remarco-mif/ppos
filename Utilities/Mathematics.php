<?php

class Mathematics {

    // Dispersija
    public static function dispersion($array){
        $n = sizeof($array);
        $var1 = (self::sum($array, 2) / ($n - 1)) - (($n * pow(self::average($array), 2)) / ($n - 1));
        return $var1;
    }
    
    // Vidurkis
    static public function average($array){
        $average = self::sum($array) / sizeof($array);
        return $average;
    }
    
    // Imties suma betkurio laipsnio
    static public function sum($array, $pow = 1){
        $sum = 0;
        foreach($array as $a){
            $sum += pow($a, $pow);
        }
        return $sum;
    }
    
    // Standartinis nuokrypis
    static public function standartDeviation($array){
        $standartDiviation = sqrt(self::dispersion($array));
        if($standartDiviation == 0){
            return 1;
        }else{
            return $standartDiviation;
        }
    }
    
    // Korialecinis koeaficientas
    static public function correlationCof($array1, $array2){
        $avg1 = self::average($array1);
        $avg2 = self::average($array2);
        $sum = 0;
        for($i = 0; $i < sizeof($array1); $i++){
            $sum += ($array1[$i] - $avg1) * ($array2[$i] - $avg2); 
        }
        return $sum / ((sizeof($array1) - 1) * self::standartDeviation($array1) * self::standartDeviation($array2));
    }
    
    static public function skirtumuSuma($array){
        $suma = 0;
        for($i = 0; $i < sizeof($array); $i++){
            if(isset($array[$i + 1])){
                if($array[$i] != 0){
                    $suma += $array[$i + 1] / $array[$i];
                }else{
                    $suma += $array[$i + 1] / 1;
                }
            }else{
                break;
            }
        }
        return $suma;
    }
    
    static public function skirtumoSumosVidurkis($array){
        $suma = self::skirtumuSuma($array);
        return $suma / (sizeof($array) - 1);
    }
 
}

?>
