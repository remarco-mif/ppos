<?php

class Importer{
    
    private $xlsData;
    
    public function __construct($filePath){
        $this->xlsData = new Spreadsheet_Excel_Reader($filePath, false, "UTF-8");
    }
    
    public function importIS(){
        $sheetNr = 2;
        
        $is = ISParseris::rastiIS($this->xlsData, $sheetNr);
        foreach ($is as $i){
            IS::insertToDb($i->kodas, $i->pavadinimas);
        }
    }
    
    public function importPadaliniai(){
        $sheetNr = 1;
        
        $padaliniai = PadaliniaiParseris::rastiPadalinius($this->xlsData, $sheetNr);
        foreach ($padaliniai as $i){
            Padaliniai::insertToDb($i->kodas, $i->pavadinimas);    
        }            
    }
    
    public function importIS_Padaliniai(){
        $sheetNr = 3;
        
        $isp = IS_PadaliniaiParseris::rastiIS_Padalinius($this->xlsData, $sheetNr);
        foreach ($isp as $i){
            $linkTable = new LinkTable("IS_Padaliniai", "Padalinys", "IS");
            $idPadalinys = Padaliniai::select("Kodas = '" . repairSqlInjection($i->kodas) . "'");
            foreach ($i->naudojamosIS as $j){
                $idIS = IS::select("Kodas = '" . repairSqlInjection($j) . "'");
                if ((sizeof($idPadalinys) > 0) && (sizeof($idIS) > 0)){
                    $linkTable->insert($idPadalinys[0], $idIS[0]);    
                }
            }
        }            
    }
    
    public function importParamosPriemoniuKryptys(){
        $sheetNr = 0;
        
        $kryptys = ParamosPriemonesParseris::rastiKryptis($this->xlsData, $sheetNr);  
        foreach ($kryptys as $i){
            ParamosPriemoniuKryptys::insertToDB($i->pavadinimas);
        }
    }
    
    public function importParamosPriemones(){
        $sheetNr = 0;
        
        $kryptys = ParamosPriemonesParseris::rastiKryptis($this->xlsData, $sheetNr);  
        foreach ($kryptys as $i){
            $idKryptis = ParamosPriemoniuKryptys::select("Pavadinimas = '" . repairSqlInjection($i->pavadinimas) . "'");
            foreach ($i->paramosPriemones as $j){
                if (sizeof($idKryptis) > 0){
                    ParamosPriemones::insertToDB($j->kodas, $j->pavadinimas, $idKryptis[0]);
                }
            }
        }
    }
    
    public function importParamosAdministravimas(){
        $sheetNr = 4;
        
        $padaliniai = ParamosAdministravimasParseris::rastiAdministravimoSanaudas($this->xlsData, $sheetNr); 
        foreach ($padaliniai as $i){
            $idPadalinys = Padaliniai::select("Kodas = '" . repairSqlInjection($i->kodas) . "'");
            foreach ($i->paramosPriemones as $j){
                $idParamosPriemone = ParamosPriemones::select("Kodas = '" . repairSqlInjection($j->kodas) . "'");
                if ((sizeof($idPadalinys) > 0) && (sizeof($idParamosPriemone) > 0)){
                    ParamosAdministravimas::insert($idParamosPriemone[0], $idPadalinys[0], $j->administravimoSanaudos);
                }
            }
        }
    }
    
    public function importParamosKiekiai(){
        $sheetNr = 5;
        
        $kiekiai = ParamosKiekiaiParseris::rastiParamosKiekius($this->xlsData, $sheetNr); 
        foreach($kiekiai as $i){
            $idParamosPriemone = ParamosPriemones::select("Kodas = '" . repairSqlInjection($i->priemonesKodas) . "'");
            if (sizeof($idParamosPriemone) > 0){
                ParamosKiekiai::insertToDB($idParamosPriemone[0], $i->paramosNuo, $i->paramosIki, $i->kiekis);
            }
        }
    }        
    
    public function import()
    {
        $this->importIS();
        $this->importPadaliniai();
        $this->importIS_Padaliniai();
        $this->importParamosPriemoniuKryptys();
        $this->importParamosPriemones();
        $this->importParamosAdministravimas();
        $this->importParamosKiekiai();
    }
    
}

?>