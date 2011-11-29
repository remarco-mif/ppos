<?php

class Prognozes extends MainPanel{
    
    private $paramosPriemones = "";
    
    public function __construct(){
        $this->getParamosPriemones();
    }
    
    private function getParamosPriemones(){
        $paramosPriemones = ParamosPriemones::select("1");
        foreach($paramosPriemones as $p){
            $paramosPriemone = new ParamosPriemones($p);
            $this->paramosPriemones .= "<li id='param{$paramosPriemone->getId()}'>".$paramosPriemone->getPavadinimas()."</li>";
        }
    }
    
    protected function htmlContent(){
        $this->content = <<<FFF
        <li>
            <h2>Filtras:</h2>
            <div id="_prognozes" style="padding-left:30px;">
                <ul id="prognozes">
                {$this->paramosPriemones}
                </ul>
            </div>
            <p style="font-size:11px; padding-left:0px; padding-top:10px; padding-bottom:10px;">Nuspaude CTRL klavisa suzymekite paramos priemones.</p>
            <input type="button" id="search-submit" value="Prognozuoti" />
        </li>
FFF;
    }
    
}

?>
