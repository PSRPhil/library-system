<?php

class Loaned{
    public $loanid;
    public $bookid;
    public $userid;
    public $loandate;
    public $returndate;
    
    function __construct($loanid=""){
        if(empty($loanid) || !is_numeric($loanid)){
                return false;
        }else{
            global $database;
            $id = $database->escape_value($loanid);
            $sql = "SELECT * FROM `loan_info` WHERE `loanid`={$loanid}";
            if($result = $database->query($sql)){
                $result = $database->fetch_assoc($result);

                $this->loanid = $result["loanid"];
                $this->bookid = $result["bookid"];
                $this->userid = $result["userid"];
                $this->loandate = $result["loandate"];
                $this->returndate = $result["returndate"];

                return true;
            }else{
                return false; 
            }
        }
    }
    
    public static function getAllLoanedIDs(){
        global $database;
            $sql = "SELECT `loanid` FROM `loan_info` ORDER BY `loandate` ASC";
            $result = $database->query($sql);
            $ids = array();
            while($loaned = $database->fetch_assoc($result)){
                $ids[] = $loaned["loanid"];
            }
            return $ids;
    }
    
    public static function getAllUserLoanedIDs(){
        global $database;
        global $user;
        $sql = "SELECT `loanid` FROM `loan_info` WHERE `userid`='{$user->userid}' ORDER BY `loandate` DESC";
        $result = $database->query($sql);
        $ids = array();
        while($loaned = $database->fetch_assoc($result)){
            $ids[] = $loaned["loanid"];
        }
        return $ids;
    }
    
    public static function checkAlreadyLoaned($bookid){
        global $database;
        $sql = "SELECT * FROM `loan_info` WHERE `bookid`='{$bookid}'";
        $result = $database->query($sql);
        if($database->num_rows($result) != 0){
            return false;
        }
        return $result;
    }
}
$loaned = new Loaned();
