<?php

class DuomenuAnalizePanel extends MainPanel{    
    
    protected function htmlContent(){
        $this->content = <<<FFF
        <li>
            <h2>Pateikti ataskaitą pagal:</h2>
            <ul style="font-size:10px;">
                <li><a onClick="apmps();" href="javascript://">Apdorotą per menesį paraiškų skaičių</a></li>
                <li><a onClick="ppav();" href="javascript://">Panaudotas paraiškų apdorojimui valandas</a></li>
            </ul>
        </li>
FFF;
    }
    
}

?>
