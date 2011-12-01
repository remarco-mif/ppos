<?php
    session_start();
    require_once("../Includes.php");


    class IS_Padaliniai
    {
        static public function getNaudojamasIs($padalinys){
            $info = db::select("SELECT IS WHERE Padalinys = " . $padalinys);
            return($info);
        }
    }
?>