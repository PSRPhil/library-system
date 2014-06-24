<?php
    
    class User{
        public $userid;
        public $username;
        private $password;
        public $typeid;
        
        function __construct($userid=""){
            if(empty($userid) || !is_numeric($userid)){
                return false;
            }else{
                global $database;
                
                $id = $database->escape_value($userid);
                $sql = "SELECT * FROM `user_info` WHERE `userid`={$id}";
                if($result = $database->query($sql)){
                    $result = $database->fetch_assoc($result);
                    
                    $this->userid = $result["userid"];
                    $this->username = $result["username"];
                    $this->password = $result["password"];
                    $this->typeid = $result["typeid"];
                    
                    // Fetch the users type - Student or Staff.
                    $sql = "SELECT * FROM `user_type` WHERE `typeid`='" . $this->typeid . "'";
                    $result = $database->query($sql);
                    $result = $database->fetch_assoc($result);
                    $this->type = $result['typename'];
                    
                    return true;
                }else{
                    return false; 
                }
            }
        }
        		
        public static function login($_POST=""){
            if(empty($_POST)){
                return false;
            }else{
                global $database;
				
                foreach($_POST as $key=>$value){
                    $_POST[$key] = $database->escape_value($value);
                }
					
                $hashedPass = hashString($_POST["pass"]);
					
                $sql = "SELECT `userid`,`username`, `password` FROM `user_info` WHERE `username`='{$_POST['username']}';";
                $sqlQuery = $database->query($sql);
                if($database->num_rows($sqlQuery) >= 1){
                    $user = $database->fetch_assoc($sqlQuery);
                    if($hashedPass === $user["password"]){
                        $_SESSION["user"] = $user["userid"];
                        return true;
                    }else{
                        return false;	
                    }
                }else{
                    return false;	
                }
            }	
        }
        
        public function logout(){
            session_destroy();
            return true;
        }
    }