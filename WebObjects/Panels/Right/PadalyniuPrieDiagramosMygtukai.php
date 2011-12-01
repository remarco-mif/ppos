<?php

class PadalyniuPrieDiagramosMygtukai extends MainPanel{
    
    private $Buttons = "";
    
    public function __construct($padaliniai){
        foreach($padaliniai as $padalinys => $value){
            $this->Buttons .= $this->getButton($padalinys);
        }
    }
    
    private function getButton($padalinys){
        $pad = new Padaliniai($padalinys);
        $color = generateChartColor($padalinys);
        $design =<<<FFF
            <span id="{$padalinys}padalinys" style="background-color:{$color}" class="rodyti">{$pad->getKodas()}</span>
FFF;
        return $design;
    }
    
    protected function htmlContent(){
        $this->content = <<<FFF
        <p id="Pad">{$this->Buttons}</pa>
FFF;
    }
    
}

?>
