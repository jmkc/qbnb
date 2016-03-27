<?php 
 
require_once 'global.inc.php';
 
//check to see if they're logged in
if(!isset($_SESSION['logged_in'])) {
    header("Location: index.php");
}
 
//get the user object from the session
$member = unserialize($_SESSION['member_id']);
 
//initialize php variables used in the form
$email = $member->email;
$firstName = $member->firstName;
$lastName = $member->lastName;
$year = $member->year;
$faculty = $member->faculty;
$degree = $member->degree;
$message = "";
 
//check to see that the form has been submitted
if(isset($_POST['submit-updateProfile'])) { 
 
    //retrieve the $_POST variables
    $password = $_POST['password'];
    $email = $_POST['email'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $year = $_POST['year'];
    $faculty = $_POST['faculty'];
    $degree = $_POST['degree'];
    $password_confirm = $_POST['password-confirm'];
 
    $member->email = $email;
    $member->password = $password;
    $member->firstName = $firstName;
    $member->lastName = $lastName;
    $member->year = $year;
    $member->faculty = $faculty;
    $member->degree = $degree;
    $member->save();
 
    $message = "Settings Saved<br/>";
}
 
//If the form wasn't submitted, or didn't validate
//then we show the registration form again
?>
 
<html>
<head>
    <title>Qbnb | Update Profile</title>
</head>
<body>
    <?php echo $message; ?>
 
    <form action="updateProfile.php" method="post">
    First Name: <input type='text' name='firstName' id='firstName'  value="<?php echo $firstName; ?>" /><br/>
    Last Name: <input type='text' name='lastName' id='lastName'  value="<?php echo $lastName; ?>"/><br/>
    Year: <input type='text' name='year' id='year'  value="<?php echo $year; ?>"/><br/>
    Faculty: <input type='text' name='faculty' id='faculty'  value="<?php echo $faculty; ?>"/><br/>
    Degree: <input type='text' name='degree' id='degree'  value"<?php echo $email; ?>" /><br/>
    Password: <input type="password" value="<?php echo $password; ?>" name="password" /><br/>
    Password (confirm): <input type="password" value="<?php echo $password_confirm; ?>" name="password-confirm" /><br/>
    
    <input type="submit" value="Update Profile" name="submit-updateProfile" />
    </form>
</body>
</html>