<?php

    class HTMLContainer {

        private $HTMLElements = array();

        public function addToContainer($HTMLElement){
            $this->HTMLElements[] = $HTMLElement;
        }

        public function getHTML(){
            $output = null;
            foreach($this->HTMLElements as $element){
                $output .= $element;
            }
            return $output;
        }

    }

?>
