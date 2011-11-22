<?php

class IS extends MysqlObject{

    private $tableID = "idIS";
    private $tableName = "IS";
    
    public function getKodas(){
        return $this->receiveFromDb("Kodas", $this->tableName, $this->tableID);
    }
        
    public function getPavadinimas(){
        return $this->receiveFromDb("Pavadinimas", $this->tableName, $this->tableID);
    }

    static public function insertToDB($kodas, $pavadinimas){
        $name = repairSqlInjection($kodas);
        $name = repairSqlInjection($pavadinimas);
        if(!ISValidation::validateKodas($kodas)){
            IS::$error = "Neteisingas kodo formatas!";
            return false;
        }
        if(!ISValidation::validatePavadinimas($pavadinimas)){
            IS::$error = "Neteisingas pavadinimo formatas!";
            return false;
        }
        
        $result = mysql_query("INSERT INTO `PPOS`.`IS` (`idIS`, `Kodas`, `Pavadinimas`) VALUES (null, '".$kodas."', '".$pavadinimas."')");
        if(!$result){
            if(mysql_errno() != 1062){
                ErrorMessages::setError(7, "insertToDB('".$kodas."', '".$pavadinimas."')", "IS.php", "IS", mysql_error());
            }
            IS::$error = mysql_error();
            return false;
        }else{
            return true;
        }
    }

    static public function select($query){
        return parent::select($query, get_class());
    }

    static public function delete($id){
        return parent::delete($id, get_class());
    }

    static public function update($id, $data){
        foreach($data as $key => $value){
            switch($key){
                case "idIS":
                    break;
                case "Kodas":
                    if(!ISValidation::validateKodas($value)){
                        return false;
                    }
                    break;
                case "Pavadinimas":
                    if(!ISValidation::validatePavadinimas($value)){
                        return false;
                    }
                    break;
            }
        }
        return parent::update($id, $data, get_class());
    }
    
}

?>
