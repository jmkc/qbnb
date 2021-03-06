<?php
//UserTools.class.php

require_once 'Member.php';
require_once 'Database.php';

class Usertools
{

	//Log the user in. First checks to see if the 
	//username and password match a row in the database.
	//If it is successful, set the session variables
	//and store the user object within.
	public function login($email, $password)
	{
		$result = mysql_query("SELECT * FROM Member WHERE email = '$email' AND password = '$password'");
		if(mysql_num_rows($result) == 1)
		{
			$_SESSION["member_id"] = serialize(new Member(mysql_fetch_assoc($result)));
			$_SESSION["login_time"] = time();
			$_SESSION["logged_in"] = 1;
			return true;
		}else{
            echo "Failed to log in!";
			return false;
		}
	}
	
	//Log the user out. Destroy the session variables.
	public function logout() {
		unset($_SESSION['member_id']);
		unset($_SESSION['login_time']);
		unset($_SESSION['logged_in']);
		session_destroy();
	}

	//Check to see if a username exists.
	//This is called during registration to make sure all user names are unique.
	public function checkEmailExists($email) {
		$result = mysql_query("select member_id from users where email='$email'");
    	if(mysql_num_rows($result) == 0)
    	{
			return false;
	   	}else{
	   		return true;
		}
	}
	
	// Check to see if the member is an admin
	public function checkAdmin($email) {
		$db = new Database();
		$result = $db->select('Member', "email= '$email'");
		$member = new Member($result);
		if ($member->is_admin == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//get a user
	//returns a User object. Takes the users id as an input
	public function get($member_id)
	{
		$db = new Database();
		$result = $db->select('Member', "member_id = $member_id");

		return new Member($result);
	}
	
}

?>