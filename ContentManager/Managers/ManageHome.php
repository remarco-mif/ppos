<?php

    function sortas($a, $b){
        $aobj = new IS($a);
        $bobj = new IS($b);
        return sizeof($bobj->getPadaliniai()) - sizeof($aobj->getPadaliniai());
    }

    class ManageHome {
        
        public function home(){
            $is = IS::select("1");
            usort($is, 'sortas');

            echo "------- IS --------<br />";
            foreach($is as $idIs){
                $infSys = new IS($idIs);
                echo $infSys->getPavadinimas()."<br />";
                p($infSys->getPadaliniai());
            }
            
            $padaliniai = Padaliniai::select("1");
            echo "------- Padaliniai --------<br />";
            foreach($padaliniai as $id){
                $padalinys = new Padaliniai($id);
                echo $padalinys->getPavadinimas()."<br />";
                p($padalinys->getIS());
            }
        }
        
    }

?>
