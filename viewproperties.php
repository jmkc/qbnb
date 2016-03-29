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
 		echo "<br />Address: $address <br />Number of Rooms: $number_of_rooms <br /> Room Type: $room_type <br /> Price: \$$price <br />";
        $property_district = mysql_query("SELECT * FROM District natural join Property WHERE property_id = $property_id");
        $district = mysql_fetch_assoc($property_district);
        extract($district);
        echo "District: $district_name<br />";
        echo "View Property: <input type='submit' value=$property_id name='viewproperty' /><br/>";
        
 	}
 	echo "<br/><input type='submit' value='Add Property' name='addProperty' /><br/>";
     ?>
    <h1> Search Properties</h1>
    
    District: <select name="district_id">
  <option value="1">Uptown</option>
  <option value="2">Waterfront</option>
  <option value="3">Rosedale</option>
  <option value="4">Chinatown</option>
  <option value="5">Midtown</option>
    </select>"
    <?php
 	echo "<<br/>input type='submit' value='Cancel' name='cancel' /></form>";
 	?>
</body>
</html>
