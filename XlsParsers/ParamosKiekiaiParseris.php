<?php
    require_once("ParamosKiekis.php");
    
    class ParamosKiekiaiParseris
    {
        
        /*
            return:
                ParamosKiekis[]{priemonesKodas, paramosNuo, paramosIki, kiekis}
        */
        static public function rastiParamosKiekius($xlsData, $sheetNr)
        {
            $res = array();
            
            for ($i = 2; $i <= $xlsData->rowcount($sheetNr); $i++){
                $paramosKiekiai = new ParamosKiekis();
                $paramosKiekiai->priemonesKodas = $xlsData->val($i, 1, $sheetNr);
                $paramosKiekiai->paramosNuo = $xlsData->val($i, 2, $sheetNr);
                $paramosKiekiai->paramosIki = $xlsData->val($i, 3, $sheetNr);
                $paramosKiekiai->kiekis = $xlsData->val($i, 4, $sheetNr);
                $res[] = $paramosKiekiai;
            }
            
            return($res);
        }
        
        /*Bandoma nustatyti ar dokumentas yra tikrai paramos priemoniu sarasas*/
        static public function validuotiDokumenta(){
            return(TRUE);
        }
    }
?>