<?php

    class ManageDirector {
        
        public function home(){
            $page = new Page();
            if(Message::isMessage()){
                $texyPanel = new PlainTextPanel();
                $texyPanel->setTitle("Message");
                $texyPanel->setText(Message::getMessge());
                $page->addToContainer(2, $texyPanel->getHtml());
            }
            
            if(isset($_GET['order'])){
                switch($_GET['order']){
                    case 0:
                        $order = "name";
                        break;
                    case 1:
                        $order = "movieCount DESC";
                }
            }else{
                $order = "name";
            }
            
            $arrayDirectors = Director::select("1 ORDER BY ".$order);
            $directorsPanel = new DirectorsPanel($arrayDirectors);
            
            $page->addToContainer(2, $directorsPanel->getHtml());
            $page->pagePrint();
        }
        
        public function director(){
            $page = new Page();
            $directorPanel = new DirectorPanel((int)$_GET['id']);
            
            $page->addToContainer(2, $directorPanel->getHtml());
            $page->pagePrint();
        }
        
    }

?>
