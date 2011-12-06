<?php

class UserManage extends MainPanel{
    
    protected function htmlContent(){
        $this->content = <<<FFF
        <li>
            <h2>Valdymas:</h2>
            <ul style="font-size:10px;">
                <li><a href="?info=admin/add_var">Prideti vartotoja</a></li>
            </ul>
        </li>
FFF;
    }
    
}

?>
