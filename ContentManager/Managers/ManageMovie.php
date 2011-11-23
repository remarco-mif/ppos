<?php

    class ManageMovie {
        
        public function home(){
            $page = new Page();
            if(Message::isMessage()){
                $texyPanel = new PlainTextPanel();
                $texyPanel->setTitle("Message");
                $texyPanel->setText(Message::getMessge());
                $page->addToContainer(2, $texyPanel->getHtml());
            }
            $arrayMovies = Movie::select("1 ORDER BY title");
            $moviesPanel = new MoviesPanel($arrayMovies);
            
            $page->addToContainer(2, $moviesPanel->getHTML());
            $page->pagePrint();
        }
        
        public function movie(){
            $page = new Page();
            $moviePanel = new MoviePanel((int)$_GET['id']);
            $page->addToContainer(2, $moviePanel->getHtml());
            $page->pagePrint();
        }
        
    }

?>
