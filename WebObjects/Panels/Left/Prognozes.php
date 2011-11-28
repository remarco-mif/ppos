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
            $this->paramosPriemones .= "<option value='".$paramosPriemone->getId()."'>".$paramosPriemone->getPavadinimas()."</option>";
        }
    }
    
    protected function htmlContent(){
        $this->content = <<<FFF
        <li>
            <h2>Filtras:</h2>
            <div style="padding-left:30px;">
                <select multiple="multiple" style="width:222px; height:300px; background-color:white; padding:5px 0px 0px 5px;">
                {$this->paramosPriemones}
                </select>
                <p style="font-size:11px; padding-left:0px; padding-top:10px; padding-bottom:10px;">Nuspaude CTRL klavisa suzymekite paramos priemones.</p>
                <input type="button" id="search-submit" value="Prognozuoti" />
            </div>
        </li>
FFF;
    }
    
}

?>
