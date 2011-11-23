<?php

class ParamosPriemones extends MysqlObject{
    
    private $tableID = "idParamosPriemones";
    private $tableName = "ParamosPriemones";
    
    public function getKodas(){
        return $this->receiveFromDb("Kodas", $this->tableName, $this->tableID);
    }
        
    public function getPavadinimas(){
        return $this->receiveFromDb("Pavadinimas", $this->tableName, $this->tableID);
    }
    
    public function getKryptis(){
        return $this->receiveFromDb("Kryptis", $this->tableName, $this->tableID);
    }

    static public function insertToDB($kodas, $pavadinimas, $kryptis){
        $kodas = repairSqlInjection($kodas);
        $pavadinimas = repairSqlInjection($pavadinimas);
        $kryptis = repairSqlInjection($kryptis);
        
        if(!ParamosPriemonesValidation::validateKodas($kodas)){
            ParamosPriemones::$error = "Neteisingas kodo formatas!";
            return false;
        }
        if(!ParamosPriemonesValidation::validatePavadinimas($pavadinimas)){
            ParamosPriemones::$error = "Neteisingas pavadinimo formatas!";
            return false;
        }
        if(!ParamosPriemonesValidation::validateKryptis($kryptis)){
            ParamosPriemones::$error = "Neteisingas krypties formatas!";
            return false;
        }
        
        $result = mysql_query("INSERT INTO `PPOS`.`ParamosPriemones` (`idParamosPriemones`, `Kodas`, `Pavadinimas`, `Kryptis`) VALUES (null, '".$kodas."', '".$pavadinimas."', '".$kryptis."')");
        if(!$result){
            if(mysql_errno() != 1062){
                ErrorMessages::setError(7, "insertToDB('".$kodas."', '".$pavadinimas."', '".$kryptis."')", "ParamosPriemones.php", "ParamosPriemones", mysql_error());
            }
            ParamosPriemones::$error = mysql_error();
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
                case "idParamosPriemones":
                    break;
                case "Kodas":
                    if(!ParamosPriemonesValidation::validateKodas($value)){
                        return false;
                    }
                    break;
                case "Pavadinimas":
                    if(!ParamosPriemonesValidation::validatePavadinimas($value)){
                        return false;
                    }
                    break;
                case "Kryptis":
                    if(!ParamosPriemonesValidation::validateKryptis($value)){
                        return false;
                    }
                    break;
            }
        }
        return parent::update($id, $data, get_class());
    }
    
}

?>
