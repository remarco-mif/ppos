<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Apmps
 *
 * @author jfeedas
 */
class Apmps extends MainPanel{
    
    protected function htmlContent(){
        $this->content = <<<FFF
        <li id="filter">
            <h2>Filtras:</h2>
            <p style="font-size:12px;">Data&nbsp;&nbsp;&nbsp;<input id="data" type="text" style="width:50px;" />&nbsp;&nbsp;&nbsp;YYYY-MM<br /><br /><input type="button" onClick="analizeapmps();" id="search-submit" value="Analizuoti" /></p>
            <p id="message"></p>
        </li>
FFF;
    }
    
}

?>
