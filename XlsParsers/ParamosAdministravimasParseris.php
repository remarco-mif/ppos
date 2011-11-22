<?php   
    require_once("ParamosPriemone.php");
    
    class ParamosAdministravimasParseris
    {
        static public function rastiAdministravimoSanaudas($xlsData, $sheetNr)
        {
            $res = array();
            
            for ($i = 2; $i <= $xlsData->colcount($sheetNr) - 1; $i++){
                $padalinys = new Padalinys($xlsData->val(3, $i, $sheetNr), "");
                $res[] = $padalinys;
                
                for ($j = 4; $j <= $xlsData->rowcount($sheetNr) - 1; $j++){
                    $paramosPriemonesKodas = $xlsData->val($j, 1, $sheetNr);
                    $paramosPriemone = new ParamosPriemone($paramosPriemonesKodas, "");
                    $paramosPriemone->administravimoSanaudos = (float)$xlsData->val($j, $i, $sheetNr);
                    $padalinys->paramosPriemones[] = $paramosPriemone;
                }
            }
            
            return $res;
        }
        
        /*Bandoma nustatyti ar dokumentas yra tikrai paramos priemoniu sarasas*/
        static public function validuotiDokumenta(){
            return(TRUE);
        }
    }
?>