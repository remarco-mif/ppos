<?php
    class IS_Padaliniai
    {
        static public function getNaudojamosIs($padalinys){
            $info = db::select("SELECT `IS` FROM IS_Padaliniai WHERE Padalinys = " . $padalinys);
            return($info);
        }
    }
?>