<?php

    class db{

        public $con = null;
        static private $tables = null;

        public function __construct(){
            $dbhost = 'localhost';
            $dbuser = 'root';
            $dbpass = 'pass';

            $this->con = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');

            $dbname = 'PPOS';
            mysql_select_db($dbname);
            mysql_query("SET NAMES utf8");
            db::$tables = $this->analyzeTables();
        }

        static public function select($query){
            $result = mysql_query($query);
            $data = array();
            $info = array();
            if($result){
                while($row = mysql_fetch_assoc($result)){
                    $data[] = $row;
                }
                $info = array('error' => mysql_error(),
                              'bool' => true,
                              'data' => $data);
            }else{
                $info = array('error' => mysql_error(),
                              'bool' => false,
                              'data' => array());
                ErrorMessages::setError(3, "select(".$query.")", "db.php", "db");
            }
            return $info;
        }

        private function analyzeTables(){
            $data = db::select("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'thoinex_thoinex'");
            foreach ($data['data'] as $d){
                $columns = db::select("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE (TABLE_NAME = '".$d['TABLE_NAME']."') AND (TABLE_SCHEMA = 'thoinex_thoinex')");
                $columnsArray = array();
                foreach($columns['data'] as $c){
                    $columnsArray[] = $c['COLUMN_NAME'];
                }
                $tables[$d['TABLE_NAME']] = $columnsArray;
            }
            return $tables;
        }

        static public function getTables(){
            return db::$tables;
        }

    }
	
    $db = new db();

?>