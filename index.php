<?php
require_once 'global.inc.php';
 //check if the user clicked the logout link and set the logout GET parameter
if(isset($_GET['logout'])){
	//Destroy the user's session.
	$_SESSION['member_id']=null;
	session_destroy();
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Welcome to mysite</title>
  
    </head>
<body>
 <?php
 //check if the user is already logged in and has an active session
if(isset($_SESSION['member_id'])){
	//Redirect the browser to the profile editing page and kill this page.
	header("Location: profile.php");
	die();
}
?>
<?php
//check if the login form has been submitted
if(isset($_POST['loginBtn'])){
 
    // include database connection
    include_once 'config/connection.php'; 
	$email = $_POST['email'];
	$password = $_POST['password'];
    $userTools = new UserTools();
	if($userTools->login($email, $password)){
		//successful login, redirect them to a page
		header("Location: profile.php");
	}else{
		$error = "Incorrect username or password. Please try again.";
	}   
 }
 
 if(isset($_POST['regBtn'])){
     header("Location: register.php");
 }
 
?>
<!-- dynamic content will be here -->
 <form name='login' id='login' action='index.php' method='post'>
    <table border='0'>
        <tr>
            <td>E-Mail</td>
            <td><input type='text' name='email' id='email' /></td>
        </tr>
        <tr>
            <td>Password</td>
             <td><input type='password' name='password' id='password' /></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' id='loginBtn' name='loginBtn' value='Log In' /> 
            </td>
        </tr>
         <tr>
            <td></td>
            <td>
                <input type='submit' id='regBtn' name='regBtn' value='Register' /> 
            </td>
        </tr>
    </table>
</form>

</body>
</html>