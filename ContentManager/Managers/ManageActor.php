<?php

    class ManageActor {
        
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
            
            $arrayActors = Actor::select("1 ORDER BY ".$order);
            $actorsPanel = new ActorsPanel($arrayActors);
            
            $page->addToContainer(2, $actorsPanel->getHTML());
            $page->pagePrint();
        }
        
        public function actor(){
            $page = new Page();
            $actorPanel = new ActorPanel((int)$_GET['id']);
            
            $page->addToContainer(2, $actorPanel->getHtml());
            $page->pagePrint();
        }
        
    }

?>
