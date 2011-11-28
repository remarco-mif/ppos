<?php

    abstract class MainPanel {
        
        protected $content = null;
        
        abstract protected function htmlContent();
        
        public function getHtml(){
            $this->htmlContent();
            return $this->content;
        }
    }

?>
