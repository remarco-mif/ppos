<?php

class Lenteles extends MainPanel{    
    
    protected function htmlContent(){
        $this->content = <<<FFF
        <div>
            <div id="ProgTable"></div>
            <div class="post">
                <p>Padalinių užimtumas valandomis</p>
                <div id="chart1Div"><img id="chart1" src="Design/images/Blank.jpg" width="548" height="200" /></div>
                <div id="PadButtons"></div>
                <div><p id="PadZooms"></p></div>
            </div>
            <div class="post">
                <p>Informacinių sistemų užimtumas valandomis</p>
                <div id="chart2Div"><img id="chart2" src="Design/images/Blank.jpg" width="548" height="200" /></div>
                <div id="IsButtons"></div>
                <div><p id="IsZooms"></p></div>
            </div>
        </div>
FFF;
    }
    
}

?>
