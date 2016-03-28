<?php 
 
require_once 'global.inc.php';
 
//check to see if they're logged in
if(!isset($_SESSION['logged_in'])) {
    header("Location: index.php");
}
 
//get the user object from the session
$data['property_id'] = $_SESSION['property_id'];
$data['member_id'] = unserialize($_SESSION['member_id']);

$allProperties = mysql_query("SELECT * 
    FROM Property natural join Booking 
    WHERE status = 'Unconfirmed'
    and owner_id = $member_id");


//check to see that the form has been submitted
if(isset($_POST['submit-updateConfirm'])) { 
 
    //retrieve the $_POST variables

    $data['status'] = 'Confirmed';

    $updateBooking = new Booking($data);
    $updateProperty->save();
 
    $message = "Settings Saved<br/>";
}

if(isset($_POST['submit-updateProperty'])) { 
 
    //retrieve the $_POST variables
    header("Location: propertyInfo.php");
}
 
//If the form wasn't submitted, or didn't validate
//then we show the registration form again
?>
 
<html>
<head>
    <title>Qbnb | Update Property</title>
</head>
<body>
    <?php
    echo "<form action='viewPendingBookings.php' method='post'>";
    while($booking = mysql_fetch_assoc($allProperties))
    {
        extract($booking);
        echo "<br />Address: $address - Date: $start_date - Status: $status <br />";
        echo "<input type='submit' value='Confirm' name='submit-updateConfirm' />";
        echo "<input type='submit' value='Deny' name='submit-updateDeny' />";
    }
    echo "</form>";
    ?>
    <form action="profile.php" method="post">
    <input type='submit' value='Cancel' name='cancel' />
    </form>
</body>
</html>