<?php

class TvarkymoPrognozavimas extends MainPanel{
    
    private $padaliniai = "";
    private $infSystemos = "";
    
    public function __construct(){
        $this->getPadaliniai();
        $this->getInfSystemos();
    }
    
    public function getPadaliniai(){
        $padaliniai = Padaliniai::select("1");
        foreach($padaliniai as $padId){
            $padalinys = new Padaliniai($padId);
            $this->padaliniai .= "<li objectid='".$padalinys->getId()."'>".$padalinys->getPavadinimas()."</li>";
        }
    }
    
    public function getInfSystemos(){
        $infSystemos = IS::select("1");
        foreach($infSystemos as $infSysId){
            $IS = new IS($infSysId);
            $this->infSystemos .= "<li objectid='".$IS->getId()."'>".$IS->getPavadinimas()."</li>";
            
        }
    }
    
    protected function htmlContent(){
        $this->content = <<<FFF
        <li style="padding-top:20px;">
            <h2>Tinkamiausi laikai:</h2>
            <div style="height:40px;">
                <div tipas="padaliniai" class="dropDownMenu">
                    <p class="dropDownVisualButton">Padalinys</p>
                    <ul class="dropDownButtons">
                        {$this->padaliniai}
                    </ul>
                </div>
            </div>
            <div style="height:40px;">
                <div tipas="IS" class="dropDownMenu">
                    <p class="dropDownVisualButton">Informacinė sistema</p>
                    <ul class="dropDownButtons">
                        {$this->infSystemos}
                    </ul>
                </div>
           </div>
           <p id="messageTvarkymui"></p>
        </li>
FFF;
    }
    
}

?>
