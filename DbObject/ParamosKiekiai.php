<?php

class ParamosKiekiai extends MysqlObject{

    private $tableID = "idParamosKiekiai";
    private $tableName = "ParamosKiekiai";
    
    public function getParamosPriemone(){
        return $this->receiveFromDb("ParamosPriemone", $this->tableName, $this->tableID);
    }
        
    public function getNuo(){
        return $this->receiveFromDb("Nuo", $this->tableName, $this->tableID);
    }
    
    public function getIki(){
        return $this->receiveFromDb("Iki", $this->tableName, $this->tableID);
    }
    
    public function getParaiskuKiekis(){
        return $this->receiveFromDb("ParaiskuKiekis", $this->tableName, $this->tableID);
    }

    static public function insertToDB($paramosPriemone, $nuo, $iki, $paraiskuKiekis){
        $paramosPriemone = repairSqlInjection($paramosPriemone);
        $nuo = repairSqlInjection($nuo);
        $iki = repairSqlInjection($iki);
        $paraiskuKiekis = repairSqlInjection($paraiskuKiekis);
        
        if(!ParamosKiekiaiValidation::validateParamosPriemone($paramosPriemone)){
            ParamosKiekiai::$error = "Neteisingas priemones formatas formatas!";
            return false;
        }

        if(!ParamosKiekiaiValidation::validateNuo($nuo)){
            ParamosKiekiai::$error = "Neteisingas datos Nuo formatas!";
            return false;
        }   

        if(!ParamosKiekiaiValidation::validateIki($iki)){
            ParamosKiekiai::$error = "Neteisingas datos Iki formatas!";
            return false;
        }     

        if(!ParamosKiekiaiValidation::validateParaiskuKiekis($paraiskuKiekis)){
            ParamosKiekiai::$error = "Neteisingas paraisku kiekio formatas!";
            return false;
        }                
        
        $result = mysql_query("INSERT INTO `PPOS`.`ParamosKiekiai` (`idParamosKiekiai`, `ParamosPriemone`, `Nuo`, `Iki`, `ParaiskuKiekis`) 
                              VALUES (null, '".$paramosPriemone."', '".$nuo."','" . $iki . "', '" . $paraiskuKiekis . "')");
        if(!$result){
            if(mysql_errno() != 1062){
                ErrorMessages::setError(7, "insertToDB('".$paramosPriemone."', '".$nuo."','" . $iki . "', '" . $paraiskuKiekis . "')", "ParamosKiekiai.php", "ParamosKiekiai", mysql_error());
            }
            ParamosKiekiai::$error = mysql_error();
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
            
            //validation
            switch($key){
                case "idParamosKiekiai":
                    break;
                case "ParamosPriemone":
                    if(!ParamosKiekiaiValidation::validateParamosPriemone($value)){
                        return false;
                    }
                    break;
                case "Nuo":
                    if(!ParamosKiekiaiValidation::validateNuo($value)){
                        return false;
                    }
                    break;
                case "Iki":
                    if(!ParamosKiekiaiValidation::validateIki($value)){
                        return false;
                    }
                    break;
                case "ParaiskuKiekis":
                    if(!ParamosKiekiaiValidation::validateParaiskuKiekis($value)){
                        return false;
                    }
                    break;
            }
        }
        return parent::update($id, $data, get_class());
    }
    
}

?>