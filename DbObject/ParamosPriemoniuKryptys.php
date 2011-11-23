<?php

class ParamosPriemoniuKryptys extends MysqlObject{
    
    private $tableID = "idParamosPriemoniuKryptys";
    private $tableName = "ParamosPriemoniuKryptys";
        
    public function getPavadinimas(){
        return $this->receiveFromDb("Pavadinimas", $this->tableName, $this->tableID);
    }

    static public function insertToDB($pavadinimas){
        $pavadinimas = repairSqlInjection($pavadinimas);
        
        if(!ParamosPriemoniuKryptysValidation::validatePavadinimas($pavadinimas)){
            ParamosPriemoniuKryptys::$error = "Neteisingas pavadinimo formatas!";
            return false;
        }
        
        $result = mysql_query("INSERT INTO `PPOS`.`ParamosPriemoniuKryptys` (`idParamosPriemoniuKryptys`, `Pavadinimas`) VALUES (null, '".$pavadinimas."')");
        if(!$result){
            if(mysql_errno() != 1062){
                ErrorMessages::setError(7, "insertToDB('".$pavadinimas."')", "ParamosPriemoniuKryptys.php", "ParamosPriemoniuKryptys", mysql_error());
            }
            ParamosPriemoniuKryptys::$error = mysql_error();
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
                case "idParamosPriemoniuKryptys":
                    break;
                case "Pavadinimas":
                    if(!ParamosPriemoniuKryptysValidation::validatePavadinimas($value)){
                        return false;
                    }
                    break;
            }
        }
        return parent::update($id, $data, get_class());
    }
    
}

?>
