<?php
    
    require_once("ObjectValidation.php");
    
    define("USERNAME_MIN_LEN", 3);
    define("USERNAME_MAX_LEN", 45);
    define("PASSWORD_MIN_LEN", 1);
    define("PASSWORD_MAX_LEN", 256);

    class UserValidation extends ObjectValidation {

        //valid username: not empty, 3-45 symbols, latin symbols, digits, spec. symbols (-, _)
        static public function validateUsername($name){
            if (!isset($name)) //empty string
                return false;
                
            if (ObjectValidation::validateStrLength($name, USERNAME_MAX_LEN, USERNAME_MIN_LEN) == false) //valid string length
                return false;
                
            if (preg_match("([^A-Za-z0-9_-]+)", $name) == true) //valid symbols
                return false;
                
            return true; //valid
        }        
        
        //valid password: not empty, max 256 symbols
        static public function validatePassword($password){
            if (!isset($password))
                return false;
                
            if (ObjectValidation::validateStrLength($password, PASSWORD_MAX_LEN, PASSWORD_MIN_LEN) == false) //valid string length
                return false;
                
            return true;
        }
    
    }
    
?>