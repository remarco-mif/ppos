<?php

    class User extends MysqlObject{

        private $tableID = "idUser";
        private $tableName = "User";

        public function getUsername(){
            return $this->receiveFromDb("Username", $this->tableName, $this->tableID);
        }

        public function getPassword(){
            return $this->receiveFromDb("Password", $this->tableName, $this->tableID);
        }
        
        public function isAdmin(){
            return $this->receiveFromDb("Admin", $this->tableName, $this->tableID);
        }
        
        static public function insertToDB($username, $password, $admin){
            if(!UserValidation::validateUsername($username)){
                User::$error = "Incorect username.";
                return false;
            }
            if(!UserValidation::validatePassword($password)){
                User::$error = "Incorect password";
                return false;
            }

            $username = repairSqlInjection($username);
            $password = repairSqlInjection($password);
            $admin = (int)$admin;

            $result = mysql_query("INSERT INTO `PPOS`.`User` (`idUser`, `username`, `password`, `Admin`) VALUES (null, '".$username."', '".$password."', '".$admin."')");
            if(!$result){
                ErrorMessages::setError(9, "insertToDB('".$username."', '".$password."', '".$admin."')", "User.php", "User");
                User::$error = mysql_error();
                return false;
            }else{
                return true;
            }
        }

        static public function select($query){
            return parent::select($query, get_class());
        }

        static public function delete($id){
            return parent::delete($id, get_class());
        }

        static public function update($id, $data){
            foreach($data as $key => $value){
                switch($key){
                    case "idUser":
                        break;
                    case "username":
                        if(!UserValidation::validateUsername($value)){
                            User::$error = "Inocorrenct username.";
                            return false;
                        }
                        break;
                    case "password":
                        if(!UserValidation::validatePassword($value)){
                            User::$error = "Inocorrenct password.";
                            return false;
                        }
                        break;
                }
            }
            return parent::update($id, $data, get_class());
        }
    }

?>
