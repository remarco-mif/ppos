<?php
    class OrganizacijosPrognozes
    {
        
        /*
            Grazina pasirinktos paramos priemones ir pasirinkto menesio apdorotu paraisku kiekius kiekvieniems metams.
            Pvz. pasirinktus priemone pa1-1 ir menesi 01, bus grazinami tokie kiekiai: 2008 => 15, 2009 => 13, 2010=>17, 2011=>19 
        */
        static public function getMenesioParamosKiekius($idParamosPriemone, $menuo){
            $paramosKiekiai = ParamosKiekiai::select("EXTRACT(MONTH FROM Nuo) = " . $menuo . " AND ParamosPriemone = " . $idParamosPriemone);
    
            $parama = new ParamosKiekiai(0);
            $res = array ();
            foreach ($paramosKiekiai as $id){
                $parama->setId($id);
                $data = $parama->getNuo();
                $year = date('Y',strtotime("$data"));
                $res[$year] = $parama->getParaiskuKiekis();
            }  

            return($res);
        }
        
        /*
            $paraiskuKiekiai - tai ka grazina getMenesioParamosKiekius
            grazinamas prognozuojama paraisku kieki
        */
        static public function prognozuotiKieki($paraiskuKiekiai){
            $arr1 = array();
            $arr2 = array();
            foreach ($paraiskuKiekiai as $metai => $kiekis){
                $arr1[] = $metai;
                $arr2[] = $kiekis;
            }
            
            $kof = Mathematics::correlationCof($arr1, $arr2);
            $prognoze = round(Mathematics::skirtumoSumosVidurkis($arr2) * $arr2[sizeof($arr2) - 1], 0);
            return($prognoze);
        }
        
        /*
            planuojamiKiekiai: Array
            (
                [3] (idParamosPriemone) => Array
                (
                    [10] (menuo) => 21 (kiekis)
                )
            )
            
            padaliniuValandos: Array
            (
                [1] (menuo) => Array
                (
                    [1] (padalinys) => valandos
                    [2] (padalinys) => 12
                )
            )
        */
        /*
        static public function getPadaliniuApkrovimas($planuojamiKiekiai){
            $padaliniuValandos = array();
            
            foreach($planuojamiKiekiai as $paramosPriemone => $kiekiai){
                $padaliniai = ParamosAdministravimas::getPadaliniai($paramosPriemone);
                foreach ($kiekiai as $menuo => $kiekis){
                    foreach ($padaliniai as $p){
                        if (!isset($padaliniuValandos[$menuo][$p["Padalinys"]]))
                            $padaliniuValandos[$menuo][$p["Padalinys"]] = $kiekis * $p["Valandos"];
                        else
                            $padaliniuValandos[$menuo][$p["Padalinys"]] +=  $kiekis * $p["Valandos"];
                    }
                }
            }
            return($padaliniuValandos);
        }
        */
        
        /*
            planuojamiKiekiai: Array
            (
                [3] (idParamosPriemone) => Array
                (
                    [10] (menuo) => 21 (kiekis)
                )
            )
            
            padaliniuValandos: Array
            (
                [1] (padalinys) => Array
                (
                    [1] (menuo) => valandos
                    [12] (menuo) => 456
                )
            )
        */
        static public function getPadaliniuApkrovimas($planuojamiKiekiai){
            $padaliniuValandos = array();
            
            foreach($planuojamiKiekiai as $paramosPriemone => $kiekiai){
                $padaliniai = ParamosAdministravimas::getPadaliniai($paramosPriemone);
                foreach ($kiekiai as $menuo => $kiekis){
                    foreach ($padaliniai as $p){
                        if (!isset($padaliniuValandos[$p["Padalinys"]][$menuo]))
                            $padaliniuValandos[$p["Padalinys"]][$menuo] = $kiekis * $p["Valandos"];
                        else
                            $padaliniuValandos[$p["Padalinys"]][$menuo] +=  $kiekis * $p["Valandos"];
                    }
                }
            }
            return($padaliniuValandos);
        }        
        
        /*
            paramosPriemones: Array
            (
                [1] (idParamosPriemone)
            )
            
            planuojamiKiekiai: Array
            (
                [3] (idParamosPriemone) => Array
                (
                    [10] (menuo) => 21 (kiekis)
                )
            )
            
            return:
            padaliniuValandos: Array
            (
                [1] (padalinys) => Array
                (
                    [1] (menuo) => valandos
                    [12] (menuo) => 456
                )
            )
        */
        static public function getPadaliniuValandos($paramosPriemones){
            $planuojamiKiekiai = array();
            foreach ($paramosPriemones as $p){
                $paraiskuKiekiai = array();
                for ($i = 1; $i <= 12; $i++){
                    $paraiskuKiekiai[$i] = OrganizacijosPrognozes::prognozuotiKieki(OrganizacijosPrognozes::getMenesioParamosKiekius($p, $i));
                }
                $planuojamiKiekiai[$p] = $paraiskuKiekiai;
            }
            
            $padaliniuValandos = OrganizacijosPrognozes::getPadaliniuApkrovimas($planuojamiKiekiai);
            return($padaliniuValandos);
        }
        
        
        /*
            paramosPriemones: Array
            (
                [1] (idParamosPriemone)
            )
            
            return:
            isValandos: Array
            (
                [1] (Informacine Sistema) => Array
                (
                    [1] (menuo) => valandos
                    [12] (menuo) => 456
                )
            )
        */
        static public function getIsValandos($paramosPriemones){
            $padaliniuValandos = OrganizacijosPrognozes::getPadaliniuValandos($paramosPriemone);
            $isValandos = array();
            foreach($padaliniuValandos as $padalinys => $menesiai){
                foreach ($menesiai as $menuo){
                   
                }
            }
            
            return($isValandos);
        }
        
        /*
            grazinama kiek valandu ketinama administruoti paramos priemones ateinanciu metu kiekviena menesi.
            rezultatas: array
            (
                [0] => Array
                (
                    ['paramosPriemone'] => idParamosPriemone
                    ['prognozes'] => Array
                    (
                        [$menuo] => valandu skaicius
                        [12] => 345
                    )
                )
            )
        */
        static public function getParamosPriemoniuPrognozes($paramosPriemones){
            $prognozes = array();
            foreach ($paramosPriemones as $p){
                $prognoze = array();
                $prognoze['paramosPriemone'] = $p;
                $kiekiai = array();
                for ($i = 1; $i <= 12; $i++){
                    $kiekiai[$i] = OrganizacijosPrognozes::prognozuotiKieki(OrganizacijosPrognozes::getMenesioParamosKiekius($p, $i));
                } 
                        
                $prognoze['prognozes'] = $kiekiai;
                $prognozes[] = $prognoze;
            }
            return($prognozes);
        }
        
    }
?>