<?php 
 
require_once 'global.inc.php';
 
//check to see if they're logged in
if(!isset($_SESSION['logged_in'])) {
    header("Location: index.php");
}
$allProperties = mysql_query("SELECT * FROM Property");
?>
<html>
<head>
    <title>Qbnb | View All Properties</title>
</head>
<body>
 	<?php
 	while($property = mysql_fetch_assoc($allProperties))
 	{
 		extract($property);
 		echo "<br />$property_id, Address:$address, $number_of_rooms, $room_type, $price <br />";
 	}

 	?>
</body>
</html>
