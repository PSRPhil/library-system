<?php

class Waiting{
    public $waitingid;
    public $userid;
    public $bookid;
    public $dateadded;
    
    function __construct($waitingid=""){
        if(empty($waitingid) || !is_numeric($waitingid)){
            return false;
        }else{
            global $database;
            $id = $database->escape_value($waitingid);
            $sql = "SELECT * FROM `waiting_list` WHERE `waitingid`={$waitingid}";
            if($result = $database->query($sql)){
                $result = $database->fetch_assoc($result);

                $this->waitingid = $result['waitingid'];
                $this->userid = $result['userid'];
                $this->bookid = $result['bookid'];
                $this->dateadded = $result['dateadded'];

                return true;
            }else{
                return false; 
            }
        }
    }
    
    public static function getBookWaitingIDs($bookid){
        global $database;
        $sql = "SELECT `waitingid` FROM `waiting_list` WHERE `bookid`='{$bookid}' ORDER BY `dateadded` ASC";
        $result = $database->query($sql);
        $ids = array();
        while($waiting = $database->fetch_assoc($result)){
            $ids[] = $waiting["waitingid"];
        }
        return $ids;
    }
    
    public static function getAllUserWaitingIDs($userid){
        global $database;
        $sql = "SELECT `waitingid` FROM `waiting_list` WHERE `userid`='{$userid}' ORDER BY `dateadded` ASC";
        $result = $database->query($sql);
        $ids = array();
        while($waiting = $database->fetch_assoc($result)){
            $ids[] = $waiting["waitingid"];
        }
        return $ids;
    }
    
    public static function checkUserAlreadyWaiting($bookid, $userid){
        global $database;
        $sql = "SELECT `bookid` FROM `waiting_list` WHERE `userid`='{$userid}' AND `bookid`='{$bookid}' ORDER BY `dateadded` ASC";
        $result = $database->query($sql);
        if($database->num_rows($result) === 0){
            return false;
        }
        return $result;
    }
}
$waiting = new Waiting();
