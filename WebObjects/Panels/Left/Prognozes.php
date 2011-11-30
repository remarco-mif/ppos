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
            $this->paramosPriemones .= "<li id='{$paramosPriemone->getId()}param'>".$paramosPriemone->getPavadinimas()."</li>";
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
        </li>
FFF;
    }
    
}

?>
