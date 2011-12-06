<?php

class Users extends MainPanel{
    
    private $users = "";
    private $error = "";
    
    public function __construct(){
        $this->getUsers();
        if(Message::isMessage()){
            $this->error = Message::getMessge();
            $this->error =<<<FFF
                <div class="post">
                    <p>{$this->error}</p>
                </div>
FFF;
        }
    }
    
    private function getUsers(){
        $users = User::select("1");
        foreach($users as $u){
            $user = new User($u);
            $this->users .=<<<FFF
                <tr id="{$user->getId()}user">
                    <td class="name">{$user->getUsername()}</td>
                    <td><span class="delUser" userid="{$user->getId()}">Trinti</span></td>
                </tr>
FFF;
        }
    }
    
    protected function htmlContent(){
        $this->content = <<<FFF
                {$this->error}
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
