<?php

    class ObjectValidation {

        /*
         * Intervalas imamas imtinai
         */
        static public function validateStrLength($str, $max, $min = 0){
            $len = strlen($str);
            if($max > 0 && $min >= 0){
                if($max <= $min){
                    return false;
                }else{
                    if($len >= $min && $len <= $max){
                        return true;
                    }else{
                        return false;
                    }
                }
            }else{
                return false;
            }
        }
        
        

        /*
         * Intervalas imamas imtinai
         */
        static public function validateInterval($number, $min, $max){
            if (!is_numeric($number))
                return false;
                
            if($min >= $max){
                return false;
            }else{
                if($number >= $min && $number <= $max){
                    return true;
                }else{
                    return false;
                }
            }
        }
        
        static public function validateDate($date){ //2011-10-11
            $dateArray = explode("-", $date);
            if(sizeof($dateArray) == 3){
                $year = (int)$dateArray[0];
                $month = (int)$dateArray[1];
                $day = (int)$dateArray[2];
                    
                if(checkdate($month, $day, $year)){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }

        static public function validateImdb($imdburl){ // tt0111161
            if(preg_match("/^http:\/\/www.imdb.com\/title\/tt\d{7}\/$/", $imdburl)){
                return true;
            }else{
                return false;
            }
        }

        static public function validateEmail($email){
            $pattern = <<<FFF
            /(?:[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/
FFF;
            $pattern = trim($pattern);
            if(preg_match($pattern, $email)){
                return true;
            }else{
                return false;
            }
        }
        
    }

?>
