<?php 
 
require_once 'global.inc.php';
 
//check to see if they're logged in
if(!isset($_SESSION['logged_in'])) {
    header("Location: index.php");
}
$allProperties = mysql_query("SELECT * FROM Property");

if(isset($_POST['cancel'])) { 
    header("Location: profile.php");
}

if(isset($_POST['viewbooking'])) { 
	$_SESSION['property_id'] = $property_id;
    header("Location: propertyinfo.php");
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
 		echo "<br />Address:$address, 
 		$number_of_rooms, $room_type, $price <br />";
 		echo "<input type='submit' value='View Property' name='viewbooking' />";
 	}
 	echo "<input type='submit' value='Cancel' name='cancel' /></form>";
 	?>
</body>
</html>
