<?php

    session_start();
    include("../../Includes.php");
    
    if(ErrorMessages::isErrors()){
        p(ErrorMessages::getErrors());
    }
    
    $login = new Session();
    
    if(!$login->isLogedin()){
        die("You must loged in!");
    }
    
    if(isset($_GET['tipas']) && !empty($_GET['tipas'])){
        $tipas = $_GET['tipas'];
    }else{
        die("Nepaskirtas tipas!!");
    }
    
    if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
    }else{
        die("Nepaskirtas ID!!");
    }
    
    $men = OrganizacijosPrognozes::getPrognozuojamiMenesiai();
    
    if($tipas == "IS"){
        echo "Tinkamiausias laikas IS atnaujinti: ".$men[OrganizacijosPrognozes::getTinkamiausiasLaikasIsAtnaujimui($id)];
    }else{
        $kval = $men[OrganizacijosPrognozes::getTinkamiausiasLaikasPadalinioKvalifikacijai($id)];
        $rem = "";
        foreach(OrganizacijosPrognozes::getTinkamiausiasLaikasPadalinioRemontui($id) as $menesis){
            $rem .= $men[$menesis].", ";
        }
        $rem = substr($rem, 0, -2);
        echo "Tinkamiausias laikas padalinio kvalifikacijai kelti: <br />".$kval."<br /><br />Tinkamiausias laikas padaliniui remontuoti: <br />".$rem;
    }

?>
