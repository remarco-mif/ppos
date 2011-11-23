<?php


class ManageComment {
    
    public function home(){
        $page = new Page();
        $arrayComments = Comment::select("1");
        $commentsPanel = new CommentsPanel($arrayComments);

        $page->addToContainer(2, $commentsPanel->getHtml());
        $page->pagePrint();
    }
    
    public function comment(){
        $page = new Page();
        $commentPanel = new CommentPanel((int)$_GET['id']);
        
        $page->addToContainer(2, $commentPanel->getHtml());
        $page->pagePrint();
    }
    
}

?>
