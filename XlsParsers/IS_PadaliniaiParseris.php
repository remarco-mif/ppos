<?php
    require_once("Padalinys.php");
    
    class IS_PadaliniaiParseris
    {
            static public function rastiIS_Padalinius($xlsData, $sheetNr){
            $res = array();
            
            for ($i = 2; $i <= $xlsData->colcount($sheetNr) - 1; $i++){
                $padalinioKodas = $xlsData->val(3, $i, $sheetNr);
                $padalinys = new Padalinys($padalinioKodas, "");
                $res[] = $padalinys;
                
                for ($j = 4; $j <= $xlsData->rowcount($sheetNr) - 1; $j++){
                    $isKodas = $xlsData->val($j, 1, $sheetNr);
                    if ($xlsData->val($j, $i, $sheetNr) == "1"){
                        $padalinys->naudojamosIS[] = $isKodas;
                    }
                }
            }

            return($res);
        }
        
        /*Bandoma nustatyti ar dokumentas yra tikrai padaliniø sarasas*/
        static public function validuotiDokumenta(){
            return(TRUE);
        }
    }
?>