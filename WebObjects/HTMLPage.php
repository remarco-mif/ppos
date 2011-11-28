<?php

abstract class HTMLPage {

    protected $HTMLContainers = array();

    public function  __construct(){
        $this->HTMLContainers[] = new HTMLContainer();
        $this->HTMLContainers[] = new HTMLContainer();
    }

    public function addToContainer($n, $HTMLElements){
        $n--;
        if($n < sizeof($this->HTMLContainers) && $n >= 0){
            $this->HTMLContainers[$n]->addToContainer($HTMLElements);
        }
    }

    abstract public function pagePrint();

    

}

?>
