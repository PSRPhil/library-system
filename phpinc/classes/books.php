<?php

    class Books{
        public $bookid;
        public $bookname;
        public $bookcreated;
        public $typeid;

        function __construct($bookid=""){
            if(empty($bookid) || !is_numeric($bookid)){
                return false;
            }else{
                global $database;

                $id = $database->escape_value($bookid);
                $sql = "SELECT * FROM `book_info` WHERE `bookid`={$id}";
                if($result = $database->query($sql)){
                    $result = $database->fetch_assoc($result);

                    $this->bookid = $result["bookid"];
                    $this->bookname = $result["bookname"];
                    $this->bookcreated = $result["bookcreated"];
                    $this->typeid = $result["typeid"];

                    // Fetch the books type/genre.
                    $sql = "SELECT * FROM `book_type` WHERE `typeid`=" . $this->typeid;
                    $result = $database->query($sql);
                    $result = $database->fetch_assoc($result);
                    $this->type = $result['typename'];

                    return true;
                }else{
                    return false; 
                }
            }
        }
        
        public static function getAllBookIDs(){
            global $database;
            $sql = "SELECT `bookid` FROM `book_info` ORDER BY `bookcreated` DESC";
            $result = $database->query($sql);
            $ids = array();
            while($book = $database->fetch_assoc($result)){
                $ids[] = $book["bookid"];
            }
            return $ids;
        }
        
        public static function loanBookbyID($_POST=""){
            if(empty($_POST)){
                return false;
            }else{
                global $database;
                foreach($_POST as $key=>$value){
                    $_POST[$key] = $database->escape_value($value);
                }
                
                $sqlCheck = "SELECT * FROM `loan_info` WHERE `bookid`='{$_POST['bookid']}'";
                $sqlQuery = $database->query($sqlCheck);
                if($database->num_rows($sqlQuery) != 0){
                    return false;
                }else{
                    $sql = "INSERT INTO `loan_info` (`bookid`,`userid`,`returndate`) VALUES ('{$_POST['bookid']}','{$_POST['userid']}','{$_POST['returndate']}')";
                    if($database->query($sql)){
                        return true;
                    }else{
                        return false;
                    }
                }
            }
        }
        
        public static function waitingListByID($_POST=""){
            if(empty($_POST)){
                return false;
            }else{
                global $database;
                foreach($_POST as $key=>$value){
                    $_POST[$key] = $database->escape_value($value);
                }
                $sql = "INSERT INTO `waiting_list` (`userid`,`bookid`) VALUES ('{$_POST['userid']}','{$_POST['bookid']}')";
                if($database->query($sql)){
                    return true;
                }else{
                    return false;
                }
            }
        }
    }
    
    $book = new Books();