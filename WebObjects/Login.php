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
class Login extends HTMLPage{

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
            <title>Login page</title>
            <link href="Design/style.css" rel="stylesheet" type="text/css" media="screen" />
        </head>
        <body>
            <div id="wrapper">
                <div id="header" class="container" style="padding-bottom:50px; height:200px;">
                    <div id="logo">
                        <h1><a href="#">PPOS</a></h1>
                        <p>Paramos priemonių organizavimo sistema</p>
                    </div>
                    <div id="menu">
                        <form method="post" action="index.php?info=home/home">
                            <ul>
                                <li>
                                    <table>
                                        <tr>
                                            <td>Vartotojo vardas</td>
                                            <td><input type="text" name="username" /></td>
                                        </tr>
                                        <tr>
                                            <td>Slaptažodis</td>
                                            <td><input type="Password" name="password" /></td>
                                        </tr>
                                    </table>
                                    <input type="submit" id="search-submit" value="Prisijungti" />
                                    <p style="color:red;">{$message}</p>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
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
