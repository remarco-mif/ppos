<?php

class Users extends MainPanel{
    
    private $users = "";
    
    public function __construct(){
        $this->getUsers();
    }
    
    private function getUsers(){
        $users = User::select("1");
        foreach($users as $u){
            $user = new User($u);
            $this->users .=<<<FFF
                <tr id="{$user->getId()}user">
                    <td class="name">{$user->getUsername()}</td>
                    <td><a href="#">Trinti</a></td>
                </tr>
FFF;
        }
    }
    
    protected function htmlContent(){
        $this->content = <<<FFF
                <div class="post">
                <p>Vartotojai</p>
                <table width="100%">
                    <tr>
                        <td><b>Vartotojo vardas</b></td>
                        <td><b>Veiksmas</b></td>
                    </tr>
                    {$this->users}
                </table>
            </div>
FFF;
    }
    
}

?>
