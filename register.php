<!DOCTYPE HTML>
<html>
    <head>
        <title>Qbnb | Register</title>
  
    </head>
<body>


<?php
 //check if the user clicked the logout link and set the logout GET parameter
if(isset($_GET['logout'])){
    //Destroy the user's session.
    $_SESSION['member_id']=null;
    session_destroy();
}
?>
<?php
  //Create a user session or resume an existing one
 session_start();
 ?>
 <?php
 //check if the user is already logged in and has an active session
if(isset($_SESSION['member_id'])){
    //Redirect the browser to the profile editing page and kill this page.
    header("Location: profile.php");
    die();
}
?>

</body>

</html>