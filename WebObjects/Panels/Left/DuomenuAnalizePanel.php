<?php

class DuomenuAnalizePanel extends MainPanel{    
    
    protected function htmlContent(){
        $this->content = <<<FFF
        <li>
            <h2>Ataskaitą pagal:</h2>
            <ul style="font-size:10px;">
                <li><a onClick="apmps();" href="javascript://">Apdorota per menesi paraiskų skaičiu</a></li>
                <li><a onClick="ppav();" href="javascript://">Panaudotas paraisku apdorojimui valandas</a></li>
            </ul>
        </li>
FFF;
    }
    
}

?>
