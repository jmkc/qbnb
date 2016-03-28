<?php

require_once 'Classes/Member.php';
require_once 'Classes/Usertools.php';
require_once 'Classes/Database.php';
require_once 'Classes/Booking.php';
require_once 'Classes/Bookingtools.php';
require_once 'Classes/Property.php';
require_once 'Classes/Propertytools.php';
require_once 'Classes/Comment.php';
require_once 'Classes/Commenttools.php';

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
