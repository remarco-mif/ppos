<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Page
 *
 * @author jfeedas
 */
class AdminPage extends HTMLPage{

    public function pagePrint(){
        $message = null;
        if(Message::isMessage()){
            $message = Message::getMessge();
        }
        
        $page =<<<FFF
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta name="keywords" content="" />
            <meta name="description" content="" />
            <meta http-equiv="content-type" content="text/html; charset=utf-8" />
            <title>PPOS</title>
            <link href="Design/style.css" rel="stylesheet" type="text/css" media="screen" />
            <script src="jquery-1.7.min.js"></script>
            <script src="JS/functions.js"></script>
        </head>
        <body>
            <div id="wrapper">
                <div id="header" class="container">
                    <div id="menu">
                        <ul>
                            <li><a hintas="Pateikiamos padalinių ir IS apkrovimo ataskaitos." href="?info=admin/duom_anal">Duomenų analizė</a></li>
                            <li><a hintas="Planuoja (vienos ar net kelių) paramos priemonių poveikį IS ir padalinių apkrovimui." href="?info=admin/prognozes">Prognozės</a></li>
                            <li><a hintas="Importuoti duomenis iš .xsl failo." href="?info=admin/import">Importuoti duomenis</a></li>
                            <li><a hintas="Leidžia sukurti naują arba ištrinti jau esama vartotoją." href="?info=admin/vartotojai">Vartotojai</a></li>
                            <li><a hintas="Atjungia nuo sistemos." href="?info=admin/logout">Atsijungti</a></li>
                            <li><a hintas="Parodo pagalbą esamam langui" href="?info=admin/help">Help</a></li>
                        </ul>
                    </div>
                    <div class="hintPanel">
                        <p id="hint"></p>
                    </div>
                </div>
                <!-- end #header -->
                <div id="page" class="container">
                    <div id="content">
                        {$this->HTMLContainers[0]->getHTML()}
                        <div style="clear: both;">&nbsp;</div>
                    </div>
                    <!-- end #content -->
                    <div id="sidebar">
                        <ul id="panels1">	
                            {$this->HTMLContainers[1]->getHTML()}
                        </ul>
                    </div>
                    <!-- end #sidebar -->
                    <div style="clear: both;">&nbsp;</div>
                </div>
                    <!-- end #page -->
            </div>
            <div id="footer">
                <p>Copyright (c) 2011. All rights reserved.</p>
            </div>
            <!-- end #footer -->
        </body>
        </html>


FFF;
        echo $page;
    }

}
?>
