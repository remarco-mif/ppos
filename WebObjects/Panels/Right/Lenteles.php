<?php

class Lenteles extends MainPanel{    
    
    protected function htmlContent(){
        $this->content = <<<FFF
        <div id="bandau">
            <div class="post">
                <img id="chart1" src="" width="550" height="200" />
            </div>
            <div class="post">
                <img id="chart2" src="" width="550" height="200" />
            </div>
        </div>
FFF;
    }
    
}

?>
