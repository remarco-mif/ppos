<?php
    
    class InformacineSistema
    {
        public $kodas;
        public $pavadinimas;
        
        public function __construct($kodas, $pavadinimas){
            $this->kodas = $kodas;
            $this->pavadinimas = $pavadinimas;
        }
    }
    
    /*
        Informaciini� sistem� parseris
        $xlsData Spreadsheet_Excel_Reader klas�s objektas
    */
    class ISParseris
    {
        static public function rastiIS($xlsData, $sheetNr){
            $res = array();
            
            for ($i = 2; $i <= $xlsData->rowcount($sheetNr); $i++){
                $IS = new InformacineSistema($xlsData->val($i, 1, $sheetNr), $xlsData->val($i, 2, $sheetNr));
                $res[] = $IS;
            }

            return($res);
        }
        
        /*Bandoma nustatyti ar dokumentas yra tikrai padalini� sarasas*/
        static function validuotiDokumenta(){
            return(TRUE);
        }
    }
    
?>