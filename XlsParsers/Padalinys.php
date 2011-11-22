<?php
    class Padalinys
    {
        public $kodas;
        public $pavadinimas;
        public $naudojamosIS = array(); //informaciniu sistemu kodai
        public $paramosPriemones = array(); //ParamosPriemone objektu masyvas
        
        public function __construct($kodas, $pavadinimas){
            $this->kodas = $kodas;
            $this->pavadinimas = $pavadinimas;
        }
    }
?>