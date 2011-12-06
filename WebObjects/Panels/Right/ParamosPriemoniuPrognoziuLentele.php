<?php

class ParamosPriemoniuPrognoziuLentele extends MainPanel{
    
    private $ParamosPriemonesPrognozes = "";
    
    public function __construct($paramosPriemoniuPrognozes){
        foreach($paramosPriemoniuPrognozes as $p){
            $this->ParamosPriemonesPrognozes .= $this->getPriemonesPrognozes($p);
        }
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
            <p style="color:#CA4C44;">Administravimo sąnaudos paramos priemonėms valandomis:</p>
            <table width="100%" cellpadding="0px" cellspacing="0px">
                <tr>
                    <td class="tdPavv"><b>Priemonė</b></td>
                    <td class="menTd">
                        <svg width="12px" height="40px" xmlns='http://www.w3.org/2000/svg'>
                            <text x='-40' y='10' font-family='Tahoma' font-size='12' transform='rotate(-90)' text-rendering='optimizeSpeed' fill='#888'>2001-02</text>
                        </svg> 
                    </td>
                    <td class="menTd"><b>02</b></td>
                    <td class="menTd"><b>03</b></td>
                    <td class="menTd"><b>04</b></td>
                    <td class="menTd"><b>05</b></td>
                    <td class="menTd"><b>06</b></td>
                    <td class="menTd"><b>07</b></td>
                    <td class="menTd"><b>08</b></td>
                    <td class="menTd"><b>09</b></td>
                    <td class="menTd"><b>10</b></td>
                    <td class="menTd"><b>11</b></td>
                    <td class="menTd"><b>12</b></td>
                </tr>
                {$this->ParamosPriemonesPrognozes}
            </table>
        </div>
FFF;
    }
    
}

?>
