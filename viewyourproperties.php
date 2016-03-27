<?php 
 
require_once 'global.inc.php';
 
//check to see if they're logged in
if(!isset($_SESSION['logged_in'])) {
    header("Location: index.php");
}

if(isset($_POST['back'])) { 
    header("Location: profile.php");
} 

$member = unserialize($_SESSION['member_id']);
$allProperties = mysql_query("SELECT * FROM Property WHERE owner_id = $member->member_id");
?>
<html>
<head>
    <title>Qbnb | View Your Properties</title>
</head>
<body>
 	<?php
 	while($property = mysql_fetch_assoc($allProperties))
 	{
 		extract($property);
 		echo "<br />Address: $address - Number of Rooms: $number_of_rooms - Room Type: $room_type - Price: $price <br />";
 	}

 	?>
<form name='options' id='options' action='profile.php' method='post'>
<input type='submit' name='back' id='back' value='Back' /> 
</form>
</body>

</html>