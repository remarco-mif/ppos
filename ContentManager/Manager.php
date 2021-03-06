<?php

//$_GET['info'] = "class/method/var1/var2/var3";

class Manager {
    
    public $class = "home";
    public $method = "login";
    public $arguments = array();
    
    public $currentlySelected = "login";
    
    private $classArray = array('home'  => 'ManageHome',
                                'admin' => 'ManageAdmin');
    
    public function __construct(){
        $contentVars = array();
        if(isset($_GET['info'])){
            $contentVars = explode("/", $_GET['info'], 3);
        }
        
        if(isset($contentVars[0])){
            $this->class = $contentVars[0];
        }
        
        if(isset($contentVars[1])){
            //setcookie("newrandomcookie", $this->method);
            
            if ($contentVars[1] != "help") {
                setcookie("cookie[previous]", $contentVars[1]);
            }
            
            $this->method = $contentVars[1];
            
        }
        
        if(isset($contentVars[2])){
            $this->arguments = explode("/", $contentVars[2]);
        }
    }
    
    public function open(){
        if(array_key_exists($this->class, $this->classArray)){
            $class = new $this->classArray[$this->class]($this->method);
            if(in_array($this->method, get_class_methods($class))){
                if($this->method != "__construct"){
                    call_user_func_array(array($class, $this->method), $this->arguments);
                }else{
                    $class->home();
                }
            }else{
                $class->home();
            }
        }else{
            echo "Nera tokios klases!";
        }
    }
    
}

?>
