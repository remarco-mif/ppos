<?php

class ManageUser {
    
    public function home(){
        $page = new Page();
        if(Message::isMessage()){
            $texyPanel = new PlainTextPanel();
            $texyPanel->setTitle("Message");
            $texyPanel->setText(Message::getMessge());
            $page->addToContainer(2, $texyPanel->getHtml());
        }
        $arrayUsers = User::select("1");
        $usersPanel = new UsersPanel($arrayUsers);

        $page->addToContainer(2, $usersPanel->getHTML());
        $page->pagePrint();
    }
    
    public function user(){
        $page = new Page();
        $userPanel = new UserPanel((int)$_GET['id']);
        $page->addToContainer(2, $userPanel->getHtml());
        $page->pagePrint();
    }
    
}

?>
