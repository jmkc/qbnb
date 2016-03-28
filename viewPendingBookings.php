<?php 
 
require_once 'global.inc.php';
 
//check to see if they're logged in
if(!isset($_SESSION['logged_in'])) {
    header("Location: index.php");
}
 
//get the user object from the session
$member = unserialize($_SESSION['member_id']);
$message = "";

$allProperties = mysql_query("SELECT * 
    FROM Property natural join Booking 
    WHERE status = 'Unconfirmed'
    and owner_id = $member->member_id");


//check to see that the form has been submitted
if(isset($_POST['submit-updateConfirm'])) { 
    $data['status'] = 'Confirmed';
    $booking_id = $_POST['booking_id'];
    if (is_numeric($booking_id)){
        $db->update($data, 'Booking', 'booking_id = '.$booking_id);
        header("Location: viewPendingBookings.php");    
    } else {
        $message = "Please enter a number";
    }
}

//check to see that the form has been submitted
if(isset($_POST['submit-updateDeny'])) { 
    $data['status'] = 'Denied';
    $booking_id = $_POST['booking_id'];
    if (is_numeric($booking_id)){
        $db->update($data, 'Booking', 'booking_id = '.$booking_id);
        header("Location: viewPendingBookings.php");    
    } else {
        $message = "Please enter a number";
    }
}
?>
 
<html>
<head>
    <title>Qbnb | Update Property</title>
</head>
<body>
    <?php echo $message ?>
    <?php
    echo "<form action='viewPendingBookings.php' method='post'>";
    while($booking = mysql_fetch_assoc($allProperties))
    {
        extract($booking);
        echo "<br />Booking ID: $booking_id - Address: $address - Date: $start_date - Status: $status<br />";
    }
    echo "</form>";
    ?>
    <?php if(mysql_num_rows($allProperties)!=0){
        echo "<form action='viewPendingBookings.php' method='post'>
        Booking ID: 
        <input type='text' value='Booking ID' name='booking_id' />
        <input type='submit' value='Confirm' name='submit-updateConfirm' />
        <input type='submit' value='Deny' name='submit-updateDeny' />
    </form>";
    } else{
        echo "No pending bookings";
    }
    ?>
    <form action='profile.php' method='post'>
    <input type='submit' value='Cancel' name='cancel' />
    </form>
</body>
</html>