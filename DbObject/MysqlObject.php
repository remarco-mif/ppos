<?php

    class MysqlObject {

        protected $ID = null;
        static public $error = null;

        public function  __construct($id){
            $this->ID = (int)$id;
        }

        public function getId(){
            return $this->ID;
        }
        
        public function setId($id){
            $this->ID = (int)$id;
        }
        
        static public function isExist($tableName, $column, $value){
            $data = db::select("SELECT * FROM `".$tableName."` WHERE ".$column." = '".$value."'");
            if(sizeof($data['data']) > 0){
                return true;
            }else{
                return false;
            }
        }

        protected function receiveFromDb($column, $tableName, $idName){
            $data = db::select("SELECT ".$column." FROM `".$tableName."` WHERE ".$idName." = ".$this->ID);
            if($data['bool']){
                if(sizeof($data['data']) > 0){
                    return $data['data'][0][$column];
                }else{
                    return null;
                }
            }else{
                ErrorMessages::setError(2, "receiveFromDb('".$column."', '".$tableName."', '".$idName."')", "MysqlObject.php", "MysqlObject");
                MysqlObject::$error = mysql_error();
                return null;
            }
        }

        protected function receiveListFromDb($column, $tableName, $idName){
            $result = mysql_query("SELECT ".$column." FROM `".$tableName."` WHERE ".$idName." = ".(int)$this->ID);
            $data = array();
            if($result){
                while($row = mysql_fetch_assoc($result)){
                    $data[] = $row[$column];
                }
            }else{
                ErrorMessages::setError(2, "receiveListFromDb('".$column."', '".$tableName."', '".$idName."')", "MysqlObject.php", "MysqlObject");
                MysqlObject::$error = mysql_error();
            }
            return $data;
        }

        static public function getMaxID($tableID, $tableName){
            $data = db::select("SELECT MAX(".$tableID.") as Max FROM `".$tableName."`");
            if($data['bool']){
                if(sizeof($data['data']) > 0){
                    return $data['data'][0]['Max'];
                }else{
                    return null;
                }
            }else{
                ErrorMessages::setError(2, "getMaxID('".$tableID."', '".$tableName."')", "MysqlObject.php", "MysqlObject");
                User::$error = mysql_error();
                return null;
            }
        }

        static protected function select($query, $class){ // Use virtual table
            $result = mysql_query("SELECT id".$class." FROM `".$class."` WHERE ".$query);
            $data = array();
            if($result){
                while($row = mysql_fetch_assoc($result)){
                    $data[] = $row['id'.$class];
                }
            }else{
                ErrorMessages::setError(4, "select('".$query."', '".$class."')", "MysqlObject.php", $class);
                MysqlObject::$error = mysql_error();
            }
            return $data;
        }
        
        static protected function delete($id, $class){
            $result = mysql_query("DELETE FROM `PPOS`.`".$class."` WHERE `".$class."`.`id".$class."` = ".(int)$id);
            if($result){
                return true;
            }else{
                ErrorMessages::setError(5, "delete('".$id."', '".$class."')", "MysqlObject.php", $class);
                MysqlObject::$error = mysql_error();
                return false;
            }
        }
        
        static protected function update($id, $data, $class){
            $id = repairSqlInjection($id);
            $class = repairSqlInjection($class);
            
            $dbTables = db::getTables();
            $query = "UPDATE `PPOS`.`".$class."` SET ";
            $set = "";
            foreach($data as $key => $value){
                if(in_array($key, $dbTables[$class])){
                    $value = repairSqlInjection($value);
                    $key = repairSqlInjection($key);
                    $set .= $key." = '".$value."', ";
                }
            }
            $query .= substr($set, 0, -2);
            $query .= " WHERE id" . $class . " = ".(int)$id;
            
            $result = mysql_query($query);
            if($result){
                return true;
            }else{
                ErrorMessages::setError(6, "update('".$id."', array, '".$class."')", "MysqlObject.php", $class);
                MysqlObject::$error = mysql_error();
                return false;
            }
        }

    }

?>
