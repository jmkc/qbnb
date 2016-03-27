<!DOCTYPE HTML>
<html>
    <head>
        <title>Welcome to mysite</title>
  
    </head>
<body>
<?php
  //Create a user session or resume an existing one
 session_start();
 ?>
<?php
 
 if(isset($_POST['updateBtn']) && isset($_SESSION['member_id'])){
  // include database connection
    include_once 'config/connection.php'; 
    
    $query = "UPDATE Member SET password=?,email=? WHERE member_id=?";
 
    $stmt = $con->prepare($query);
    $stmt->bind_param('sss', $_POST['password'], $_POST['email'], $_SESSION['member_id']);
    // Execute the query
        if($stmt->execute()){
            echo "Record was updated. <br/>";
        }else{
            echo 'Unable to update record. Please try again. <br/>';
        }
 }
 
  if(isset($_POST['logoutBtn']) && isset($_SESSION['member_id'])){
  // include database connection
    include_once 'config/connection.php'; 
    unset($_SESSION['member_id']);
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
Welcome  <?php echo $myrow['FName']; ?>, <a href="index.php?logout=1">Log Out</a><br/>
<!-- dynamic content will be here -->
<!-- Update profile-->
<input type='update' name='goToUpdate' id='goToUpdate' value='Update Profile' \>
<!-- View Booking profile-->
<input type='viewBookings' name='viewBookings' id='viewBookings' value='View Bookings' \>
=======
<form name='editProfile' id='editProfile' action='profile.php' method='post'>
    <table border='0'>
        <!--<tr>
            <td>Username</td>
            <td><input type='text' name='username' id='username' disabled  value="<?php echo $myrow['username']; ?>"  /></td>
        </tr>-->
          <tr>
            <td>Email</td>
            <td><input type='text' name='email' id='email'  value="<?php echo $myrow['email']; ?>" /></td>
        </tr>
        <tr>
            <td>Password</td>
             <td><input type='text' name='password' id='password'  value="<?php echo $myrow['password']; ?>" /></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' name='updateBtn' id='updateBtn' value='Update' /> 
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