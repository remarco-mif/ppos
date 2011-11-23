<?php

class Padaliniai extends MysqlObject{
    
    private $tableID = "idPadaliniai";
    private $tableName = "Padaliniai";
    
    public function getKodas(){
        return $this->receiveFromDb("Kodas", $this->tableName, $this->tableID);
    }
        
    public function getPavadinimas(){
        return $this->receiveFromDb("Pavadinimas", $this->tableName, $this->tableID);
    }
    
    public function getIS(){
        return $this->receiveListFromDb("IS", "IS_Padaliniai", "Padalinys");
    }

    static public function insertToDB($kodas, $pavadinimas){
        $kodas = repairSqlInjection($kodas);
        $pavadinimas = repairSqlInjection($pavadinimas);
        if(!PadaliniaiValidation::validateKodas($kodas)){
            Padaliniai::$error = "Neteisingas kodo formatas!";
            return false;
        }
        if(!PadaliniaiValidation::validatePavadinimas($pavadinimas)){
            Padaliniai::$error = "Neteisingas pavadinimo formatas!";
            return false;
        }
        
        $result = mysql_query("INSERT INTO `PPOS`.`Padaliniai` (`idPadaliniai`, `Kodas`, `Pavadinimas`) VALUES (null, '".$kodas."', '".$pavadinimas."')");
        if(!$result){
            if(mysql_errno() != 1062){
                ErrorMessages::setError(7, "insertToDB('".$kodas."', '".$pavadinimas."')", "Padaliniai.php", "Padaliniai", mysql_error());
            }
            Padaliniai::$error = mysql_error();
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
                case "idPadaliniai":
                    break;
                case "Kodas":
                    if(!PadaliniaiValidation::validateKodas($value)){
                        return false;
                    }
                    break;
                case "Pavadinimas":
                    if(!PadaliniaiValidation::validatePavadinimas($value)){
                        return false;
                    }
                    break;
            }
        }
        return parent::update($id, $data, get_class());
    }
    
}

?>
