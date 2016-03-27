<?php

require_once 'Classes/User.php';
require_once 'Classes/UserTools.php';
require_once 'Classes/Database.php';

//connect to the database
$db = new Database();
$db->connect();

//initialize UserTools object
$userTools = new UserTools();

//start the session
session_start();

//refresh session variables if logged in
if(isset($_SESSION['logged_in'])) {
	$user = unserialize($_SESSION['member_id']);
	$_SESSION['member_id'] = serialize($userTools->get($user->member_id));
}
