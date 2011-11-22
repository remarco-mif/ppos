<?php
    class ParamosPriemone
    {
        public $kodas;
        public $pavadinimas;
        public $administravimoSanaudos;
        
        public function __construct($kodas, $pavadinimas){
            $this->kodas = $kodas;
            $this->pavadinimas = $pavadinimas;
        }
    }
?>