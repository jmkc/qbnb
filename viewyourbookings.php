<?php 
 
require_once 'global.inc.php';
 
//check to see if they're logged in
if(!isset($_SESSION['logged_in'])) {
    header("Location: index.php");
}
$member = unserialize($_SESSION['member_id']);
$yourBookings = mysql_query("SELECT * FROM Booking where booking_member_id = $member->member_id and is_deleted = 0");
if(isset($_POST['cancel'])) { 
    header("Location: profile.php");
}

if(isset($_POST['addProperty'])) { 
    header("Location: addProperty.php");
}

?>
<html>
<head>
    <title>Qbnb | View All Properties</title>
</head>
<body>
 	<?php
 	echo "<form action='viewproperties.php' method='post'>";
 	while($property = mysql_fetch_assoc($allProperties))
 	{
 		extract($property);
 		echo "<br />Address: $address - Number of Rooms: $number_of_rooms - Room Type: $room_type - Price: $price <br />";
 		echo "<input type='submit' value=$property_id name='viewproperty' />";
 	}
 	echo "<input type='submit' value='Add Property' name='addProperty' />";
 	echo "<input type='submit' value='Cancel' name='cancel' /></form>";
 	?>
</body>
</html>
