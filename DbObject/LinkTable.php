<?php

    class LinkTable {

        private $tableName = null;
        private $var1 = null;
        private $var2 = null;

        public function __construct($tableName, $var1, $var2){
            $this->tableName = $tableName;
            $this->var1 = $var1;
            $this->var2 = $var2;
        }

        public function insert($var1, $var2){
            $result = mysql_query("INSERT INTO `thoinex_thoinex`.`".$this->tableName."` (`".$this->var1."`, `".$this->var2."`) VALUES ('".$var1."', '".$var2."')");
            if($result){
                return true;
            }else{
                ErrorMessages::setError(7, "insert('".$var1."', '".$var2."')", "LinkTable.php", "LinkTable");
                return false;
            }
        }

        /*
        public function delete($column, $id){
            $result = mysql_query("DELETE FROM `thoinex_thoinex`.`".$this->tableName."` WHERE `".$this->tableName."`.`".$column."` = ".(int)$id);
            if($result){
                return true;
            }else{
                return false;
            }
        }
        */
        
        public function delete($id1, $id2){
            $result = mysql_query("DELETE FROM `thoinex_thoinex`.`".$this->tableName."` WHERE ".$this->tableName."." . $this->var1 . " = ".(int)$id1 . 
                                  " AND " . $this->tableName."." . $this->var2 . " = ".(int)$id2);
            if($result){
                return true;
            }else{
                ErrorMessages::setError(5, "delete('".$id1."', '".$id2."')", "LinkTable.php", "LinkTable");
                return false;
            }
        }

    }

?>
