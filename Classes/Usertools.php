<?php
//UserTools.php

require_once 'User.php';
require_once 'DB.php';

class UserTools {

	//Log the user in. First checks to see if the 
	//username and password match a row in the database.
	//If it is successful, set the session variables
	//and store the user object within.
	public function login($email, $password)
	{

		$query = "SELECT member_id,email, password, FName, LName, year, faculty, degree, is_admin, is_deleted
         FROM member WHERE email=$email AND password=$password";
 
        // prepare query for execution
        if($stmt = $con->prepare($query)){
		
        // bind the parameters. This is the best way to prevent SQL injection hacks.
        $stmt->bind_Param("ss", $_POST['email'], $_POST['password']);
         
        // Execute the query
		$stmt->execute();
 
		// Get Results
		$result = $stmt->get_result();

		// Get the number of rows returned
		$num = $result->num_rows;
		
		if($num>0){
			//If the username/password matches a user in our database
			//Read the user details
			$myrow = $result->fetch_assoc();
			//Create a session variable that holds the user's id
			$_SESSION['member_id'] = $myrow['member_id'];
			//Redirect the browser to the profile editing page and kill this page.
			return true;
		} else {
			//If the username/password doesn't matche a user in our database
			// Display an error message and the login form
			return false;
		}
	}
    }
	
	//Log the user out. Destroy the session variables.
	public function logout() {
		unset($_SESSION['member_id']);
		session_destroy();
	}

	//Check to see if a username exists.
	//This is called during registration to make sure all user names are unique.
	public function checkUsernameExists($email) {
		$result = mysql_query("select member_id from Member where email ='$email'");
    	if(mysql_num_rows($result) == 0)
    	{
			return false;
	   	}else{
	   		return true;
		}
	}
	
	//get a user
	//returns a User object. Takes the users id as an input
	/*public function get($id)
	{
		$db = new DB();
        
		$result = $db->select('Member', "id = $id");
		
		return new User($result);
	}*/
	
}
?>