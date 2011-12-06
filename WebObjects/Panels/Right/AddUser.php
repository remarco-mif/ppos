<?php

class AddUser extends MainPanel{
    
    protected function htmlContent(){
        $this->content = <<<FFF
        <div class="post">
            <div class="entry">
                <p>Pridėti vartotoją</p>
                <form method="post" action="AjaxActions/Admin/AddUser.php">
                    <table>
                        <tr>
                            <td>Vartotojo vardas: </td>
                            <td><input type="text" name="nick" /></td>
                        </tr>
                        <tr>
                            <td>Slaptažodis: </td>
                            <td><input type="text" name="pass" /></td>
                        </tr>
                        <tr>
                            <td>Pakartoti slaptažodį: </td>
                            <td><input type="text" name="pass1" /></td>
                        </tr>
                        <tr>
                            <td>Vartotojas</td>
                            <td><input type="radio" name="isAdmin" value="0" checked="true" /></td>
                        </tr>
                        <tr>
                            <td>Administratorius</td>
                            <td><input type="radio" name="isAdmin" value="1" /></td>
                        </tr>
                    </table>
                    <p><input type="submit" class="more" value="Pridėti" /></p>
                </form>
            </div>
        </div>
FFF;
    }
    
}

?>
