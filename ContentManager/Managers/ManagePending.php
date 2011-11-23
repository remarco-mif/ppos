<?php

class ManagePending {
    
    private $page;
    
    public function __construct(){
        $this->page = new Page();
        $buttons = new LeftButtonPanel("Actions");
        $buttons->addButton("Add pending movie", "?page=pending&subpage=add");
        $this->page->addToContainer(3, $buttons->getHtml());
    }
    
    public function home(){
        if(Message::isMessage()){
            $texyPanel = new PlainTextPanel();
            $texyPanel->setTitle("Message");
            $texyPanel->setText(Message::getMessge());
            $this->page->addToContainer(2, $texyPanel->getHtml());
        }
        $arrayPendingMovies = Pending_Movie::select("1");
        $pendingMoviesPanel = new PendingMoviesPanel($arrayPendingMovies);

        $this->page->addToContainer(2, $pendingMoviesPanel->getHtml());
        $this->page->pagePrint();
    }
        
    public function pending(){
        $pendingPanel = new PendingMoviePanel((int)$_GET['id']);
        
        $this->page->addToContainer(2, $pendingPanel->getHtml());
        $this->page->pagePrint();
    }
    
    public function add(){
        $addPendingMovie = new AddPendingMoviePanel();
        
        $this->page->addToContainer(2, $addPendingMovie->getHtml());
        $this->page->pagePrint();
    }
        
}

?>
