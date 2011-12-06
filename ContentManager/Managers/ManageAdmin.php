<?php

class ManageAdmin {
    
    public function __construct($method, $checkType = true){
        if($checkType == true){
            if(isset($GLOBALS['login']->user)){
                if(!$GLOBALS['login']->user->isAdmin()){
                    header("location: index.php?info=home/".$method);    
                }
            }
        }
    }
    
    public function home(){
        $page = new AdminPage();
        $page->pagePrint();
    }
    
    public function duom_anal(){
        $page = new AdminPage();
        $panel = new DuomenuAnalizePanel();
        $panel1 = new Lenteles();
        $panel2 = new Filters();
        $page->addToContainer(1, $panel1->getHtml());
        $page->addToContainer(2, $panel->getHtml());
        $page->addToContainer(2, $panel2->getHtml());
        $page->pagePrint();
    }
    
    public function prognozes(){
        $page = new AdminPage();
        $panel = new Prognozes();
        $panel1 = new Lenteles();
        $panel2 = new TvarkymoPrognozavimas();
        $page->addToContainer(1, $panel1->getHtml());
        $page->addToContainer(2, $panel->getHTML());
        $page->addToContainer(2, $panel2->getHtml());
        $page->pagePrint();
    }
    
    public function import(){
        $page = new AdminPage();
        $panel = new Import();
        $page->addToContainer(1, $panel->getHtml());
        $page->pagePrint();
    }
    
    public function vartotojai(){
        $page = new AdminPage();
        $panel = new Users();
        $panel1 = new UserManage();
        $page->addToContainer(1, $panel->getHtml());
        $page->addToContainer(2, $panel1->getHtml());
        $page->pagePrint();
    }
    
    public function add_var(){
        $page = new AdminPage();
        $panel = new AddUser();
        $page->addToContainer(1, $panel->getHtml());
        $page->pagePrint();
    }
    
    public function laikas(){
            $page = new AdminPage();
            $panel = new TvarkymoPrognozavimas();
            $page->addToContainer(2, $panel->getHtml());
            $page->pagePrint();
        }
    
    public function login(){
        $manager = new ManageHome("login", false);
        $manager->login();
    }
    
    public function logout(){
        $manager = new ManageHome("logout", false);
        $manager->logout();
    }  
    
}

?>
