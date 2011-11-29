<?php

class ErrorMessages {
    
    static private $errors = array(
        1 => 'Filmo duomenu parsinimo klaida.',
        2 => 'Nepavyko ivykdyti mysql uzklausos.',
        3 => 'Bloga sql sintakse.',
        4 => 'Klaida vykdant select.',
        5 => 'Klaida vykdant delete.',
        6 => 'Klaida vykdant update.',
        7 => 'Klaida vykdant insert.',
        8 => 'Nepavyko ideti iraso.',
        9 => 'Nepavyko itraukti duomens del neaiskiu priezasciu.',
        10 => 'Nerasti _GET[] masyvo kintamieji',
        11 => 'Bloga diagramos rusis: chart',
        12 => 'Blogas datos formatas',
        256 => 'sikt'
    );
    
    static public function setError($errorNr, $function, $file, $class = null, $message = null){
        $errorMessage = static::getErrorName($errorNr);

        $error = array(
            'errorNr' => $errorNr,
            'errorMessage' => $errorMessage,
            'file' => $file,
            'function' => $function,
            'class' => $class,
            'message' => $message
        );
        
        $_SESSION['error'][] = $error;
    }
    
    static public function getErrors(){
        if(isset($_SESSION['error'])){
            $errors = $_SESSION['error']; 
            $_SESSION['error'] = null;
            return $errors;
        }else{
            return null;
        }
    }
    
    static public function getErrorName($errorNr){
        if(isset(static::$errors[$errorNr])){
            $errorMessage = static::$errors[$errorNr];
        }else{
            $errorMessage = "Unknown error!";
        }
        return $errorMessage;
    }
    
    static public function isErrors(){
        if(isset($_SESSION['error'])){
            return true;
        }else{
            return false;
        }
    }
    
}

?>
