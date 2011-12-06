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
        echo "Tinkamiausia atnaujinti IS: ".$men[OrganizacijosPrognozes::getTinkamiausiasLaikasIsAtnaujimui($id)];
    }else{
        echo "Tinkamiausias laikas padalinio kvalifikacijai kelti: ".$men[OrganizacijosPrognozes::getTinkamiausiasLaikasPadalinioKvalifikacijai($id)]; //."\nTinkamiausias laikas padaliniui remontuoti: ".$men[OrganizacijosPrognozes::getTinkamiausiasLaikasPadalinioRemontui($id)];
    }

?>
