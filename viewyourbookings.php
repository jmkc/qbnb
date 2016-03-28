<?php 
 
require_once 'global.inc.php';
 
//check to see if they're logged in
if(!isset($_SESSION['logged_in'])) {
    header("Location: index.php");
}
$member = unserialize($_SESSION['member_id']);
$yourBookings = mysql_query("SELECT * FROM Booking inner join Property on Booking.property_id = Property.property_id inner join Member on owner_id = Member.member_id WHERE booking_member_id = $member->member_id and Booking.is_deleted = 0");


if(isset($_POST['cancel'])) { 
    header("Location: profile.php");
}


?>
<html>
<head>
    <title>Qbnb | View All Properties</title>
</head>
<body>
 	<?php
 	echo "<form action='viewyourbookings.php' method='post'>";
 	while($booking = mysql_fetch_assoc($yourBookings))
 	{
 		extract($booking);
 		echo "<br />Address: $address - Number of Rooms: $number_of_rooms - Room Type: $room_type - Price: $price - Owner: $FName $LName - Move In Date: $start_date <br />";
 		//echo "<input type='submit' value=$property_id name='viewproperty' />";
 	}
 	//echo "<input type='submit' value='Add Property' name='addProperty' />";
 	echo "<input type='submit' value='Cancel' name='cancel' /></form>";
 	?>
</body>
</html>
