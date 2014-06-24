<?php
//start a session
session_start();
// load config file first
require_once("config.php");
// load functions
require_once("functions.php");
// load core objects
require_once("classes/database.php");
require_once("classes/user.php");
require_once("classes/books.php");
require_once("classes/loaned.php");
require_once("classes/waitinglist.php");

if(isLoggedIn()){
	$user = new User($_SESSION["user"]);
}