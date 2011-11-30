<?php

    class ManageHome {
        
        public function __construct($method, $checkType = true){
            if($checkType == true){
                if(isset($GLOBALS['login']->user)){
                    if($GLOBALS['login']->user->isAdmin()){
                        header("location: index.php?info=admin/".$method);
                    }
                }
            }
        }
        
        public function home(){
            $page = new Page();
            $page->pagePrint();
        }
        
        public function duom_anal(){
            $page = new Page();
            $panel = new DuomenuAnalizePanel();
            $panel1 = new Lenteles();
            $panel2 = new Filters();
            $page->addToContainer(1, $panel1->getHtml());
            $page->addToContainer(2, $panel->getHtml());
            $page->addToContainer(2, $panel2->getHtml());
            $page->pagePrint();
        }
        
        public function prognozes(){
            $page = new Page();
            $panel = new Prognozes();
            $panel1 = new Lenteles();
            $page->addToContainer(1, $panel1->getHtml());
            $page->addToContainer(2, $panel->getHTML());
            $page->pagePrint();
        }
        
        public function login(){
            $page = new Login();
            $page->pagePrint();
        }
        
        public function logout(){
            $_SESSION['username'] = null;
            $_SESSION['password'] = null;
            $this->login();
        }
        
    }

?>
