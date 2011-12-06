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
                foreach ($padaliniai as $p){
                    for ($i = 1; $i <= 12; $i++){
                        $padaliniuValandos[$p["Padalinys"]][$i] = 0;
                    }
                    
                    foreach ($kiekiai as $menuo => $kiekis){
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
            ksort($padaliniuValandos);
            
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
            $padaliniuValandos = OrganizacijosPrognozes::getPadaliniuValandos($paramosPriemones);
            $isValandos = array();
            foreach($padaliniuValandos as $idPadalinys => $menesiai){
                $is = IS_Padaliniai::getNaudojamosIs($idPadalinys);
                $is = $is["data"];

                foreach ($menesiai as $menuo => $valandos){
                    foreach ($is as $i){
                        if (!isset($isValandos[$i["IS"]][$menuo]))
                            $isValandos[$i["IS"]][$menuo] = $valandos;
                        else 
                            $isValandos[$i["IS"]][$menuo] += $valandos;
                    }
                }
            }
            
            ksort($isValandos);
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
        
        /*
            Grazina menesio numeri, kuomet IS yra maziausiai uzimta.
        */
        static public function getTinkamiausiasLaikasIsAtnaujimui($idIs){
            $paramosPriemones = ParamosPriemones::select("1");
            $isValandos = self::getIsValandos($paramosPriemones);
            
            $minValandos = -1;
            $minMenuo = -1;
            foreach ($isValandos[$idIs] as $menuo => $valandos){
                if (($valandos < $minValandos) || ($minValandos == -1)){
                    $minValandos = $valandos;
                    $minMenuo = $menuo;
                }
            }
            
            return($minMenuo);
        }
        
        /*
            Grazina menesio numeri, kuomet padalinys yra maziausiai uzimtas.
        */
        static public function getTinkamiausiasLaikasPadalinioKvalifikacijai($idPadalinys){
            $paramosPriemones = ParamosPriemones::select("1");
            $padaliniuValandos = self::getPadaliniuValandos($paramosPriemones);
            
            $minValandos = -1;
            $minMenuo = -1;
            foreach ($padaliniuValandos[$idPadalinys] as $menuo => $valandos){
                if (($valandos < $minValandos) || ($minValandos == -1)){
                    $minValandos = $valandos;
                    $minMenuo = $menuo;
                }
            }
            
            return($minMenuo);
        }
        
        /*
            Grazina menesiu numerius, kuomet geriausia daryti padalinio patalpu remonta.
        */
        static public function getTinkamiausiasLaikasPadalinioRemontui($idPadalinys){
            $paramosPriemones = ParamosPriemones::select("1");
            $padaliniuValandos = self::getPadaliniuValandos($paramosPriemones);
            $prognozuojamiMenesiai = self::getPrognozuojamiMenesiai();

            $valanduVidurkis = self::padaliniuMenesiuValanduVidurkis($padaliniuValandos[$idPadalinys], $prognozuojamiMenesiai, 1);
            $minValandos = $valanduVidurkis["valandos"];
            $minMenesiai = $valanduVidurkis["menesiai"];
            
            $i = 0;
            foreach ($prognozuojamiMenesiai as $menuo => $metaiMenuo){
                $i++;
                if ($i < 12){
                    $valanduVidurkis = self::padaliniuMenesiuValanduVidurkis($padaliniuValandos[$idPadalinys], $prognozuojamiMenesiai, $i);
                    if ($valanduVidurkis["valandos"] < $minValandos){
                        $minValandos = $valanduVidurkis["valandos"];
                        $minMenesiai = $valanduVidurkis["menesiai"];
                    }
                } 
            }
            
            return($minMenesiai);
        }
        
        /*
            pagalbine funkcija, kuria naudoja funkcija getTinkamiausiasLaikasPadalinioRemontui.
            Ji paskaiciuoja keliu menesiu valandu vidurki, t.y. jei tikrinamuose menesiuose nera ziemos menesio,
            tai vedamas vidurkis is dvieju menesiu, jei yra bent vienas ziemos menesis - vidurkis vedamas is triju menesiu.
            
            padalinioValandos: Array
            (
                [1] (menuo) => valandos
                [12] (menuo) => 456
            )
            
            $prognozuojamiMenesiai: Array
            (
                [6] => "2012-06"
                [12] => "2012-12"
            )
            
            $menesioPozicija - elemento numeris, nuo kurio bus pradedamas skaiciuoti vidurkis. Pirmas elementas = 1;
        */
        static private function padaliniuMenesiuValanduVidurkis($padalinioValandos, $prognozuojamiMenesiai, $menesioPozicija){
            $menesiuSuma = 0;
            $menesiuSkaicius = 2;
            $valanduVidurkis = 0;
            $menesiai = array();
            
            $i = 0;
            foreach ($prognozuojamiMenesiai as $menuo => $metaiMenuo){
                $i++;
                if ($i >= $menesioPozicija){
                    if (($menuo == 1) || ($menuo == 2) || ($menuo == 12)) //ziema
                        $menesiuSkaicius = 3;
                    
                    $valanduVidurkis += $padalinioValandos[$menuo];
                    $menesiai[] = $menuo;
                    $menesiuSuma++;
                    if ($menesiuSuma == $menesiuSkaicius)
                        break;
                }
            }
            
            if ($menesiuSuma < $menesiuSkaicius)
                $menesiuSuma = 1;
            
            return(array("valandos" => ($valanduVidurkis / $menesiuSuma), "menesiai" => $menesiai));
        }
        
        /*
            Grazina prognozuojamu menesiu stringu masyva.
            
            $menesiai: Array
            (
                [6] => "2012-06"
                [12] => "2012-12"
            )
        */
        static public function getPrognozuojamiMenesiai(){
            $menesiai = array();
            $data = date('Y-m-d');
            for ($i = 1; $i <= 12; $i++){
                $data = date('Y-m', strtotime("$data + 1 months"));
                $menuo = (int)date('m', strtotime("$data"));
                $menesiai[$menuo] = $data;
            }
            
            return($menesiai);
        }
        
    }
?>