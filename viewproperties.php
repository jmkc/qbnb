<?php 
 
require_once 'global.inc.php';
 
//check to see if they're logged in
if(!isset($_SESSION['logged_in'])) {
    header("Location: index.php");
}

$message = "";
$allProperties = mysql_query("SELECT * FROM Property where is_deleted = 0");

if(isset($_POST['cancel'])) {
    $_SESSION['is_searching'] = 0;
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

if(isset($_POST['Search'])) { 
    $query = "SELECT * FROM Property where is_deleted = 0";
    if(!empty($_POST['owned']) and $_POST['owned'] != "No"){
        //$num_rooms = $_POST['num_rooms'];
        $member = unserialize($_SESSION['member_id']);
        $owner_id = $member->member_id;
        //$message = $message."Viewing acommodations with $num_rooms rooms<br/>";
        $query .= " and owner_id = '". $owner_id . "'";
    } 
    if(!empty($_POST['num_rooms']) and $_POST['num_rooms'] != "All"){
        $num_rooms = $_POST['num_rooms'];
        //$message = $message."Viewing acommodations with $num_rooms rooms<br/>";
        $query .= " and number_of_rooms = '". $num_rooms . "'";
    } 
    if(!empty($_POST['room_type']) and $_POST['room_type'] != "All"){
        $room_type = $_POST['room_type'];
        //$message = $message."Viewing acommodations that are $room_type<br/>";
        $query .= " and room_type = '". $room_type . "'";
    } 
    if(!empty($_POST['price']) and $_POST['price'] != "All"){
        $price = $_POST['price'];
        //$message = $message."Viewing acommodations that cost $price<br/>";
        if ($price == 1){
            $query .= " and price < 200";
        }
        else if ($price == 2){
            $query .= " and price > 200 and price <= 400";
        }
        else if ($price == 3){
            $query .= " and price > 400 and price <= 600";
        }
        else if ($price == 4){
            $query .= " and price > 600 and price <= 1000";
        }
        else if ($price == 5){
            $query .= " and price > 1000";
        }
        
    }
    if(!empty($_POST['district_id']) and $_POST['district_id'] != "All"){
        $district_id = $_POST['district_id'];
        //$message = $message."Viewing acommodations in the district with ID: $district_id<br/>";
        $query .= " and district_id = '". $district_id . "'";
    }
   //$message = $message.$query;
    $allProperties = mysql_query("$query");
    // echo $num_rooms;
    
    
    //header("Refresh:0");
}

?>
<html>
<head>

    <title>Qbnb | View All Properties</title>
</head>
<body>
    <h1> View Properties</h1>
    <h2> Search Properties</h2>
    <form action="viewproperties.php" method="post">
    Only My Properties? <select name="owned">
   <option value="No">No</option>     
  <option value="Yes">Yes</option>
    </select>
    <br/>
    Number of Rooms: <select name="num_rooms">
   <option value="All">All</option>     
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
    </select>
    <br/>
    Room Type: <select name="room_type">
  <option value="All">All</option>      
  <option value="Apartment">Apartment</option>
  <option value="House">House</option>
  <option value="Condo">Condo</option>
    </select>
    <br/>
    Price: <select name="price">
   <option value="All">All</option>     
  <option value="1">$0 - $200</option>
  <option value="2">$200 - $400</option>
  <option value="3">$400 - $600</option>
  <option value="4">$600 - $1000</option>
  <option value="5">More than $1000</option>
    </select>
    <br/>
    District: <select name="district_id">
  <option value="All">All</option>
  <option value="1">Uptown</option>
  <option value="2">Waterfront</option>
  <option value="3">Rosedale</option>
  <option value="4">Chinatown</option>
  <option value="5">Midtown</option>
    </select>
    <br/>
    <!--<td>Features:</td>
    <td><label><input type='checkbox' name='1 Bathroom' value='1 Bathroom'/>1 Bathroom</label></td>
	<td><label><input type='checkbox' name='2 Bathrooms' value='2 Bathrooms'/>2 Bathrooms</label></td>
	<td><label><input type='checkbox' name='Backyard' value='Backyard'/>Backyard</label></td>
	<td><label><input type='checkbox' name='gym' value='gym'/>Gym</label></td>
    <td><label><input type='checkbox' name='pool' value='pool'/>Pool</label></td>
    <td><label><input type='checkbox' name='Queen Beds' value='Queen Beds'/>Queen Beds</label></td>-->
    <?php
 	echo "<br/><input type='submit' value='Search' name='Search' /></form>";
    echo "<form action='viewproperties.php' method='post'>";
 	echo "<input type='submit' value='Back' name='cancel' /></form>";
 	?>
    <?php echo $message ?>
    <h2>Properties</h2>
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
 	echo "<br/><input type='submit' value='Add Property' name='addProperty' /><br/></form>";
     ?>
    
</body>
</html>
