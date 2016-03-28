<?php 
 
require_once 'global.inc.php';
 
//check to see if they're logged in
if(!isset($_SESSION['logged_in'])) {
    header("Location: index.php");
}
$member = unserialize($_SESSION['member_id']);

$allProperties = mysql_query("SELECT * FROM Property natural join Booking WHERE status = 'Unconfirmed'");

if(isset($_POST['cancel'])) { 
    header("Location: profile.php");
}

if(isset($_POST['status'])) { 
    $_SESSION['property_id'] = $_POST['viewproperty'];
    header("Location: propertyInfo.php");
}

?>
<html>
<head>
    <title>Qbnb | View Pending Bookings</title>
</head>
<body>
 	<?php
 	echo "<form action='viewPendingBookings.php' method='post'>";
 	while($booking = mysql_fetch_assoc($allProperties))
 	{
 		extract($property);
 		echo "<br />Address: $address - Date: $start_date - Room Type: $room_type - Price: $price <br />";
 		echo "<input type='submit' value=$status name='status' />";
 	}
 	
 	echo "<input type='submit' value='Cancel' name='cancel' /></form>";

 	?>
</body>
</html>
