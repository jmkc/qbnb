<?php 
 
require_once 'global.inc.php';
 
//check to see if they're logged in
if(!isset($_SESSION['logged_in'])) {
    header("Location: index.php");
}
$allProperties = mysql_query("SELECT * FROM Property where is_deleted = 0");
if(isset($_POST['cancel'])) { 
    header("Location: profile.php");
}

if(isset($_POST['viewproperty'])) { 
    //"Location: propertyInfo.php?property_id=$_POST['viewproperty']";
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
    <h1> View all Properties</h1>
 	<?php
 	echo "<form action='viewproperties.php' method='post'>";
 	while($property = mysql_fetch_assoc($allProperties))
 	{
 		extract($property);
 		echo "<br />Address: $address - Number of Rooms: $number_of_rooms - Room Type: $room_type - Price: \$$price <br />";
 		echo "View Property: <input type='submit' value=$property_id name='viewproperty' /><br/>";
 	}
 	echo "<br/><input type='submit' value='Add Property' name='addProperty' />";
 	echo "<input type='submit' value='Cancel' name='cancel' /></form>";
 	?>
</body>
</html>
