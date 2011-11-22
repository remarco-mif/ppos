<?php
    require_once("ParamosPriemone.php");
    
    class ParamosPriemoniuKryptis
    {
        public $pavadinimas;
        public $paramosPriemones = array();
    }
    
    class ParamosPriemonesParseris
    {
    
        /*
            Ið "Paramos priemoniø" xls failo iðparsina visas kryptis, paramos priemones ir gràþina jas masyve.
            Masyvas yra klasiø ParamosPriemoniuKryptis tipo.
        */
        static public function rastiKryptis($xlsData, $sheetNr){
            $res = array();
        
            for ($i = 2; $i <= $xlsData->rowcount($sheetNr); $i++){
                $line = $xlsData->val($i, 2, $sheetNr);
        
                if (strpos($line, "KRYPTIS") !== FALSE){
                    $pavadinimas = explode("KRYPTIS", $line);
                    $kryptis = new ParamosPriemoniuKryptis();
                    $kryptis->pavadinimas = $pavadinimas[1];
                    $res[] = $kryptis;
                }
                else{
                    $pavadinimas = explode(".", $line);
                    $paramosPriemone = new ParamosPriemone($xlsData->val($i, 1, $sheetNr), $pavadinimas[1]);
                    $res[sizeof($res) - 1]->paramosPriemones[] = $paramosPriemone;
                }
            }
            return($res);
        }
    
        /*Bandoma nustatyti ar dokumentas yra tikrai paramos priemoniu sarasas*/
        static public function validuotiDokumenta(){
            return(TRUE);
        }
    }
?>