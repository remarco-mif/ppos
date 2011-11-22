<?php
    require_once("Padalinys.php");
    
    class PadaliniaiParseris
    {
        static public function rastiPadalinius($xlsData, $sheetNr){
            $res = array();
            
            for ($i = 2; $i <= $xlsData->rowcount($sheetNr); $i++){
                $padalinys = new Padalinys($xlsData->val($i, 1, $sheetNr), $xlsData->val($i, 2, $sheetNr));
                $res[] = $padalinys;
            }

            return($res);
        }
        
        /*Bandoma nustatyti ar dokumentas yra tikrai padaliniø sarasas*/
        static public function validuotiDokumenta(){
            return(TRUE);
        }
    }
    
?>