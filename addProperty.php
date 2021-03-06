<?php 
 
require_once 'global.inc.php';
 
//check to see if they're logged in
if(!isset($_SESSION['logged_in'])) {
    header("Location: index.php");
}
 
//get the user object from the session
$member = unserialize($_SESSION['member_id']);
$owner_id = $member->member_id;
 
$address = "";
$number_of_rooms = "";
$room_type = "";
$price = "";


//initialize php variables used in the form

 
//check to see that the form has been submitted
if(isset($_POST['submit-addProperty'])) { 
 
    //retrieve the $_POST variables
    $address = $_POST['address'];
    $number_of_rooms = $_POST['number_of_rooms'];
    $room_type = $_POST['room_type'];
    $price = $_POST['price'];
    $district_id = $_POST['district_id'];

    $data['address'] = $address;
    $data['number_of_rooms'] = $number_of_rooms;
    $data['room_type'] = $room_type;
    $data['price'] = $price;
    $data['owner_id'] = $owner_id;
    $data['district_id'] = $district_id;
    
    $newProperty = new Property($data);
    $newProperty->save(true);
   
    header("Location: viewproperties.php");
}
 
if(isset($_POST['back'])) { 
    header("Location: viewproperties.php");
}

//If the form wasn't submitted, or didn't validate
//then we show the registration form again
?>
 
<html>
<head>
    <title>Qbnb | Add Property</title>
</head>
<body>
 
    <form action="addProperty.php" method="post">
    Address: <input type='text' name='address' id='Address'  value=""/><br/>
    Number of Rooms: <input type='text' name='number_of_rooms' id='number_of_rooms'  value=""/><br/>
    Room Type: <input type='text' name='room_type' id='room_type'  value="" /><br/>
    Price:  <input type='text' name='price' id='price'  value="" /><br/>
    District: <select name="district_id">
  <option value="1">Uptown</option>
  <option value="2">Waterfront</option>
  <option value="3">Rosedale</option>
  <option value="4">Chinatown</option>
  <option value="5">Midtown</option>
</select>
<br/>
    <input type="submit" value="Add Property" name="submit-addProperty" />
    <input type='submit' value='Back' name='back' /></form>
    </form>
</body>
</html>