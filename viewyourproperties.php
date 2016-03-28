<?php 
 
require_once 'global.inc.php';
 
//check to see if they're logged in
if(!isset($_SESSION['logged_in'])) {
    header("Location: index.php");
}
$member = unserialize($_SESSION['member_id']);

$allProperties = mysql_query("SELECT * FROM Property WHERE owner_id = $member->member_id");

if(isset($_POST['cancel'])) { 
    header("Location: profile.php");
}

if(isset($_POST['viewproperty'])) { 
    $_SESSION['property_id'] = $_POST['viewproperty'];
    header("Location: propertyInfo.php");
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
 	
 	echo "<input type='submit' value='Add Property' name='addProperty' />"
 	echo "<input type='submit' value='Cancel' name='cancel' /></form>";

 	?>
</body>
</html>
