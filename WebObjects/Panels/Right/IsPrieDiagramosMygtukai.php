<?php

class IsPrieDiagramosMygtukai extends MainPanel{
    
    private $Buttons = "";
    
    public function __construct($is){
        foreach($is as $i => $value){
            $this->Buttons .= $this->getButton($i);
        }
    }
    
    private function getButton($is){
        $inSys = new IS($is);
        $color = generateChartColor($is);
        $design =<<<FFF
            <span id="{$is}is" style="background-color:{$color}" class="rodyti">{$inSys->getKodas()}</span>
FFF;
        return $design;
    }
    
    protected function htmlContent(){
        $this->content = <<<FFF
        <p id="Is">{$this->Buttons}</pa>
FFF;
    }
    
}

?>
