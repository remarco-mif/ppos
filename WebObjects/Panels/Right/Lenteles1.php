<?php

class Lenteles1 extends MainPanel{    
    
    protected function htmlContent(){
        $this->content = <<<FFF
        <div>
            <div class="post">
                <p>Padalinių užimtumas</p>
                <div id="chart1Div"><img id="chart1" src="Design/images/Blank.jpg" width="548" height="200" /></div>
            </div>
            <div class="post">
                <p>Informacinių sistemų užimtumas</p>
                <div id="chart2Div"><img id="chart2" src="Design/images/Blank.jpg" width="548" height="200" /></div>
            </div>
        </div>
FFF;
    }
    
}

?>
