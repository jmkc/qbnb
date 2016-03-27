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
$FName = $member->FName;
$LName = $member->LName;
$year = $member->year;
$faculty = $member->faculty;
$degree = $member->degree;
$message = "";
 
//check to see that the form has been submitted
if(isset($_POST['submit-updateProfile'])) { 
 
    //retrieve the $_POST variables
    $password = $_POST['password'];
    $email = $_POST['email'];
    $FName = $_POST['FName'];
    $LName = $_POST['LName'];
    $year = $_POST['year'];
    $faculty = $_POST['faculty'];
    $degree = $_POST['degree'];
    $password_confirm = $_POST['password-confirm'];
 
    $member->email = $email;
    $member->password = $password;
    $member->FName = $FName;
    $member->LName = $LName;
    $member->year = $year;
    $member->faculty = $faculty;
    $member->degree = $degree;
    $member->save();
 
    $message = "Settings Saved<br/>";
    header("Location: profile.php");
}
if(isset($_POST['cancel'])) { 
    header("Location: profile.php");
}
 
//If the form wasn't submitted, or didn't validate
//then we show the registration form again
?>
 
<html>
<head>
    <title>Qbnb | Update Profile</title>
</head>
<body>
 
    <form action="updateProfile.php" method="post">
    First Name: <input type='text' name='FName' id='FName'  value="<?php echo $FName; ?>" /><br/>
    Last Name: <input type='text' name='LName' id='LName'  value="<?php echo $LName; ?>"/><br/>
    Year: <input type='text' name='year' id='year'  value="<?php echo $year; ?>"/><br/>
    Faculty: <input type='text' name='faculty' id='faculty'  value="<?php echo $faculty; ?>"/><br/>
    Degree: <input type='text' name='degree' id='degree'  value="<?php echo $degree; ?>" /><br/>
    Password: <input type="password" name="password" /><br/>
    Password (confirm): <input type="password"  name="password-confirm" /><br/>
    
    <input type="submit" value="Update Profile" name="submit-updateProfile" />
    <input type="submit" value="Cancel" name="cancel" />
    </form>
</body>
</html>