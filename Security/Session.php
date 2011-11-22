<?php

    class Session {

        private $isLogedin = false;
        private $username = null;
        private $password = null;
        private $isAdmin = 0;
        
        public $user = null;

        public function __construct($isAdmin = 0){
            $this->isAdmin = $isAdmin;
            if(isset($_POST['username']) && isset($_POST['password'])){
                $this->username = $_POST['username'];
                $this->password = $_POST['password'];
            }else{
                if(isset($_SESSION['username']) && isset($_SESSION['password'])){
                    $this->username = $_SESSION['username'];
                    $this->password = $_SESSION['password'];
                }
            }
            $this->login();
        }

        private function login(){
            if(isset($this->username) && isset($this->password)){
                $this->user = User::select("username = '".$this->username."'");
                if(sizeof($this->user) > 0){
                    $this->user = $this->user[0];
                    $this->user = new User($this->user);
                    if($this->password == $this->user->getPassword()){
                        $_SESSION['username'] = $this->username;
                        $_SESSION['password'] = $this->password;
                        if($this->isAdmin == 0){
                            if($this->user->getId() == 0){
                                $this->isLogedin = true;
                            }else{
                                $this->isLogedin = false;
                            }
                        }else{
                            $this->isLogedin = true;
                        }
                    }else{
                        $this->isLogedin = false;
                    }
                }else{
                    $this->isLogedin = false;
                }
            }else{
                $this->isLogedin = false;
            }
        }

        public function isLogedin(){
            return $this->isLogedin;
        }

    }

?>
