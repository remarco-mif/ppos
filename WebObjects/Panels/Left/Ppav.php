<?php

class Ppav extends MainPanel{
    
    protected function htmlContent(){
        $this->content = <<<FFF
        <li id="filter">
            <h2>Filtras:</h2>
            <div style="padding-left:30px;">
                <table style="font-size:12px;" border="0" width="100%">
                    <tr>
                        <td align="left">Data nuo:</td>
                        <td align="left"><input id="data1" type="text" style="width:50px;" /></td>
                        <td align="left" rowspan="2">YYYY-MM-DD</td>
                    </tr>
                    <tr>
                        <td align="left">Data iki:</td>
                        <td align="left"><input <input id="data2" type="text" style="width:50px;" /></td>
                    </tr>
                </table><br />
                <input type="button" onClick="analizeppav();" id="search-submit" value="Analizuoti" />
                <p id="message"></p>
            </div>
        </li>
FFF;
    }
    
}

?>
