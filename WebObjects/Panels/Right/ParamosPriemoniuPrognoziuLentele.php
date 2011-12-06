<?php

class ParamosPriemoniuPrognoziuLentele extends MainPanel{
    
    private $ParamosPriemonesPrognozes = "";
    private $prognozuojamiMenesiai = "";
    
    public function __construct($paramosPriemoniuPrognozes){
        $this->progMen();
        foreach($paramosPriemoniuPrognozes as $p){
            $this->ParamosPriemonesPrognozes .= $this->getPriemonesPrognozes($p);
        }
    }
    
    private function progMen(){
        
        $h = "";
        foreach(OrganizacijosPrognozes::getPrognozuojamiMenesiai() as $men1){
            $men = <<<FFF
                <td class="menTd">
                    <svg width="12px" height="50px" xmlns='http://www.w3.org/2000/svg'>
                        <text x='-40' y='10' font-family='Tahoma' font-size='12' transform='rotate(-90)' text-rendering='optimizeSpeed' fill='#888'>{$men1}</text>
                    </svg> 
                </td>
FFF;
            $h .= $men;
        }
        
        $a =<<<FFF
            <tr>
                <td class="tdPavv"><b>Priemonė</b></td>
                {$h}
            </tr>
FFF;
        $this->prognozuojamiMenesiai = $a;
    }
    
    private function getPriemonesPrognozes($ParamosPriemone){
        $paramosPriemonesId = $ParamosPriemone['paramosPriemone'];
        $paramPriemone = new ParamosPriemones($paramosPriemonesId);
        $prog = $ParamosPriemone['prognozes'];
        $design =<<<FFF
            <tr>
                <td class="tdPav" pavadinimas="{$paramPriemone->getPavadinimas()}">{$paramPriemone->getKodas()}</td>
                <td class="menTd">{$prog[1]}</td>
                <td class="menTd">{$prog[2]}</td>
                <td class="menTd">{$prog[3]}</td>
                <td class="menTd">{$prog[4]}</td>
                <td class="menTd">{$prog[5]}</td>
                <td class="menTd">{$prog[6]}</td>
                <td class="menTd">{$prog[7]}</td>
                <td class="menTd">{$prog[8]}</td>
                <td class="menTd">{$prog[9]}</td>
                <td class="menTd">{$prog[10]}</td>
                <td class="menTd">{$prog[11]}</td>
                <td class="menTd">{$prog[12]}</td>
            </tr>
FFF;
        return $design;
    }
    
    protected function htmlContent(){
        $this->content = <<<FFF
        <div class="post">
            <p style="color:#CA4C44;">Prognozuojamos administravimo sąnaudos paramos priemonėms valandomis:</p>
            <table width="100%" cellpadding="0px" cellspacing="0px">
                {$this->prognozuojamiMenesiai}
                {$this->ParamosPriemonesPrognozes}
            </table>
        </div>
FFF;
    }
    
}

?>
