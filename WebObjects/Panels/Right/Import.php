<?php

class Import extends MainPanel{
    
    protected function htmlContent(){
        $this->content = <<<FFF
        <div class="post">
            <div class="entry">
                <p>Importuoti duomenis:</p>
                <form id="ImporterForm" enctype="multipart/form-data" action="AjaxActions/Admin/Import.php" method="post">
                <p><input type="file" id="importas" name="file" /></p>
                <p><input type="submit" class="more" value="Importuoti" /></p>
                <iframe id="uploadTarget" src="" style="width:500px; height:100px; border:0px solid #fff;"></iframe>
            </div>
        </div>
        <div class="post">
            <div class="entry">
                
            </div>
        </div>
FFF;
    }
    
}

?>
