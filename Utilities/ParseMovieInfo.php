<?php

class ParseMovieInfo {

    private $content = null;

    function __construct($link) {
        $this->content = file_get_contents($link);
    }

    public function getTitle() {
        $subPattern = "^<";
        if(preg_match("<span class=\"title-extra\">", $this->content)){
            $pattern = <<<FFF
            /<span class=\"title-extra\">([{$subPattern}]*)/i
FFF;
        }else{
            $pattern = <<<FFF
            /<h1 class=\"header\" itemprop=\"name\">([{$subPattern}]*)/i
FFF;
        }
        
        $pattern = trim($pattern);
        $matches = array();
        preg_match($pattern, $this->content, $matches);
        if(isset($matches[1])){
            $matches = trim($matches[1]);
        }else{
            ErrorMessages::setError(1, "getTitle()", "ParseMovieInfo.php", get_class($this));
            $matches = array();
        }
        return str_replace("&#x27;", "'", $matches);
    }

    public function getReleaseDate(){
        $pattern = <<<FFF
            /<time itemprop=\"datePublished\" datetime=\"[^\"]*\">([^<]*)/i
FFF;
        $pattern = trim($pattern);
        $matches = array();
        preg_match($pattern, $this->content, $matches);
        if(isset($matches[1])){
            $matches = trim($matches[1]);
        }else{
            ErrorMessages::setError(1, "getReleaseDate()", "ParseMovieInfo.php", get_class($this));
            $matches = array();
        }
        return $matches;
        //p($this->makeAllNotHtml($matches));
    }

    public function getRating(){
        $pattern = <<<FFF
            /<span itemprop=\"ratingValue\">([^<]*)/i
FFF;
        $pattern = trim($pattern);
        $matches = array();
        preg_match($pattern, $this->content, $matches);
        if(isset($matches[1])){
            $matches = trim($matches[1]);
        }else{
            ErrorMessages::setError(1, "getRating()", "ParseMovieInfo.php", get_class($this));
            $matches = array();
        }
        return $matches;
        //p($this->makeAllNotHtml($matches));
    }

    public function getGenres(){
        $pattern = <<<FFF
            /<a\s*href="[^"]*"\s*itemprop="genre">([^<]*)/i
FFF;
        $pattern = trim($pattern);
        $matches = array();
        preg_match_all($pattern, $this->content, $matches);
        if(isset($matches[1])){
            $matches = $matches[1];
        }else{
            ErrorMessages::setError(1, "getGenres()", "ParseMovieInfo.php", get_class($this));
            $matches = array();
        }
        $returnArray = array();
        foreach($matches as $m){
            $returnArray[] = htmlspecialchars_decode($m, ENT_QUOTES);
        }
        return $returnArray;
        //p($matches);
    }

    public function getDirectors(){
        $pattern = <<<FFF
            /<a\s*href="[^\"]*"\s*itemprop="director"\s*>([^<]*)/i
FFF;
        $pattern = trim($pattern);
        $matches = array();
        preg_match_all($pattern, $this->content, $matches);
        if(isset($matches[1])){
            $matches = $matches[1];
        }else{
            ErrorMessages::setError(1, "getDirectors()", "ParseMovieInfo.php", get_class($this));
            $matches = array();
        }
        $returnArray = array();
        foreach($matches as $m){
            $returnArray[] = htmlspecialchars_decode($m, ENT_QUOTES);
        }
        return $returnArray;
        //p($matches);
    }

    public function getActors(){
        $pattern = <<<FFF
            /<td\s*class="name">\s*<a\s*href="[^\"]*"\s*>([^<]*)/i
FFF;
        $pattern = trim($pattern);
        $matches = array();
        preg_match_all($pattern, $this->content, $matches);
        if(isset($matches[1])){
            $matches = $matches[1];
        }else{
            ErrorMessages::setError(1, "getActors()", "ParseMovieInfo.php", get_class($this));
            $matches = array();
        }
        $returnArray = array();
        foreach($matches as $m){
            $returnArray[] = htmlspecialchars_decode($m, ENT_QUOTES);
        }
        return $returnArray;
        //p($matches);
    }

    public function getImage(){
        $pattern = <<<FFF
            /<img\ssrc=\"([^\"]*)\"\s*style/i
FFF;
        $pattern = trim($pattern);
        $matches = array();
        preg_match($pattern, $this->content, $matches);
        if(isset($matches[1])){
            $matches = trim($matches[1]);
        }else{
            ErrorMessages::setError(1, "getImage()", "ParseMovieInfo.php", get_class($this));
            $matches = array();
        }
        return $matches;
        //p($this->makeAllNotHtml($matches));

    }

    public function getContent(){
        return htmlspecialchars($this->content);
    }

    private function makeAllNotHtml($mas){
        $mas1 = array();
        foreach($mas as $m){
            $mas1[] = htmlspecialchars($m);
        }
        return $mas1;
    }

    public function printClass(){
        echo "----------------------------------------------<br />";
        echo $this->getTitle();
        echo $this->getReleaseDate();
        echo $this->getRating();
        echo "<img src='".$this->getImage()."' height='100px' /><br /><br />";
        echo "Genres:<br />";
        foreach($this->getGenres() as $g){
            echo $g."<br />";
        }
        echo "<br />Actors:<br />";
        foreach($this->getActors() as $a){
            echo $a."<br />";
        }
        echo "<br />Directors:<br />";
        foreach($this->getDirectors() as $d){
            echo $d."<br />";
        }
    }
    
}

?>
