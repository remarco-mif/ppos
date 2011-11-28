<?php

    function sortas($a, $b){
        $aobj = new IS($a);
        $bobj = new IS($b);
        return sizeof($bobj->getPadaliniai()) - sizeof($aobj->getPadaliniai());
    }

    class ManageHome {
        
        public function home(){
            $page = new Page();
            $page->pagePrint();
        }
        
        public function duom_anal(){
            $page = new Page();
            $panel = new DuomenuAnalizePanel();
            $panel1 = new Lenteles();
            $page->addToContainer(1, $panel1->getHtml());
            $page->addToContainer(2, $panel->getHtml());
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
        
    }

?>
