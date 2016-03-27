<!DOCTYPE HTML>
<html>
    <head>
        <title>Welcome to mysite</title>
  
    </head>
<body>
<?php
require_once 'global.inc.php';
$member = unserialize($_SESSION['member_id']);
  //Create a user session or resume an existing one
 //session_start();
 ?>
<?php
 if(isset($_POST['updateBtn']) && isset($_SESSION['member_id'])){
  // include database connection
    include_once 'config/connection.php'; 
    header("Location: updateProfile.php");
 }
 
  if(isset($_POST['viewProps']) && isset($_SESSION['member_id'])){
  // include database connection
    include_once 'config/connection.php'; 
   header("Location: viewproperties.php");
 }
 
  if(isset($_POST['logoutBtn']) && isset($_SESSION['member_id'])){
  // include database connection
    include_once 'config/connection.php'; 
    $userTools = new UserTools();
    $userTools->logout();
   header("Location: index.php");
 }
 

 
 ?>
 <?php
if(isset($_SESSION['member_id'])){
   // include database connection
    include_once 'config/connection.php'; 
    
    // SELECT query
        $query = "SELECT member_id,FName, LName, password, email FROM Member WHERE member_id=?";
 
        // prepare query for execution
        $stmt = $con->prepare($query);
        
        // bind the parameters. This is the best way to prevent SQL injection hacks.
        $stmt->bind_Param("s", $_SESSION['member_id']);

        // Execute the query
        $stmt->execute();
 
        // results 
        $result = $stmt->get_result();
        
        // Row data
        $myrow = $result->fetch_assoc();
        
} else {
    //User is not logged in. Redirect the browser to the login index.php page and kill this page.
    header("Location: index.php");
    die();
}

?>
Welcome,  <?php echo $member->FName; ?>, to QBnB your number one source for shared housing at Queen's!<br/>
<!-- dynamic content will be here -->
<!-- Update profile-->
<form name='options' id='options' action='profile.php' method='post'>
    <table border='0'>
        <!--<tr>
            <td>Username</td>
            <td><input type='text' name='username' id='username' disabled  value="<?php echo $myrow['username']; ?>"  /></td>
        </tr>-->
        <tr>
            <td></td>
            <td>
                <input type='submit' name='updateBtn' id='updateBtn' value='Update Your Profile' /> 
            </td>
        </tr>
         <tr>
            <td></td>
            <td>
                <input type='submit' name='viewProps' id='viewProps' value='View All Properties' /> 
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' name='viewYourProps' id='viewYourProps' value='View Your Properties' /> 
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' name='viewBooks' id='viewBooks' value='View Your Pending Bookings' /> 
            </td>
        </tr>
         <tr>
            <td></td>
            <td>
                <input type='submit' name='logoutBtn' id='logoutBtn' value='Log Out' /> 
            </td>
        </tr>
    </table>
</form>
</body>

</html>