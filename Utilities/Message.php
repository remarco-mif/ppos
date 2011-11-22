<?php

class Message {
    
    static public function setMessage($text){
        $_SESSION['message'] = $text;
    }
    
    static public function getMessge(){
        $text = $_SESSION['message'];
        $_SESSION['message'] = null;
        $a = explode(":::", $text);
        if(sizeof($a) == 2){
            return $a[1];
        }else{
            return $a[0];
        }
    }
    
    static public function isMessage(){
        if(isset($_SESSION['message']) && !empty($_SESSION['message'])){
            return true;
        }
        return false;
    }
}

?>
