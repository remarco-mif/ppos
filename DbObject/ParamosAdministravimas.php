<?php

class ParamosAdministravimas {
    
        static public function getValandos($paramosPriemone, $padalinys){
            $query = "SELECT Valandos FROM ParamosAdministravimas WHERE ParamosPriemone = ".(int)$paramosPriemone." AND Padalinys = ".(int)$padalinys;
            
            $result = mysql_query($query);
            if($result){
                $row = mysql_fetch_array($result);
                return $row['Valandos'];
            }else{
                ErrorMessages::setError(2, "getValandos('".$paramosPriemone."', '".$padalinys."')", "ParamosAdministravimas.php", "ParamosAdministravimas", mysql_error());
                return null;
            }
        }

        static public function insert($paramosPriemone, $padalinys, $valandos){
            $result = mysql_query("INSERT INTO `PPOS`.`ParamosAdministravimas` (`ParamosPriemone`, `Padalinys`, `Valandos`) VALUES ('".$paramosPriemone."', '".$padalinys."', '".$valandos."')");
            if($result){
                return true;
            }else{
                ErrorMessages::setError(7, "insert('".$paramosPriemone."', '".$padalinys."', '".$valandos."')", "ParamosAdministravimas.php", "ParamosAdministravimas");
                return false;
            }
        }
        
        static public function delete($paramosPriemone, $padalinys){
            $result = mysql_query("DELETE FROM `PPOS`.`ParamosAdministravimas` WHERE ParamosPriemone = ".(int)$paramosPriemone. 
                                  " AND Padalinys = ".(int)$padalinys);
            if($result){
                return true;
            }else{
                ErrorMessages::setError(5, "delete('".$paramosPriemone."', '".$padalinys."')", "ParamosAdministravimas.php", "ParamosAdministravimas");
                return false;
            }
        }
        
        static public function update($valandos, $paramosPriemone, $padalinys){
            $query = "UPDATE  `PPOS`.`ParamosAdministravimas` SET  `Valandos` =  '".(int)$valandos."' WHERE  `ParamosPriemone` = ".$paramosPriemone." AND `Padalinys` = ".(int)$padalinys;
            
            $result = mysql_query($query);
            if($result){
                return true;
            }else{
                ErrorMessages::setError(6, "update('".$valandos."', '".$paramosPriemone."', '".$padalinys."')", "ParamosAdministravimas.php", "ParamosAdministravimas", mysql_error());
                return false;
            }
        }
    
}

?>
