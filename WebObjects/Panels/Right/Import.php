<?php

class Import extends MainPanel{
    
    protected function htmlContent(){
        $this->content = <<<FFF
        <div class="post">
            <div class="entry">
                <p>Importuoti duomenis:</p>
                <p><input type="file" /></p>
                <p class="links"><input type="Button" class="more" value="Importuoti" /></p>
            </div>
        </div>
FFF;
    }
    
}

?>
