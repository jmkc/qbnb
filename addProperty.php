<?php 
 
require_once 'global.inc.php';
 
//check to see if they're logged in
if(!isset($_SESSION['logged_in'])) {
    header("Location: index.php");
}
 
//get the user object from the session
$member = unserialize($_SESSION['member_id']);
 
$address = "";
$number_of_rooms = "";
$room_type = "";
$price = "";


//initialize php variables used in the form

 
//check to see that the form has been submitted
if(isset($_POST['submit-form'])) { 
 
    //retrieve the $_POST variables
    $address = $_POST['address'];
    $number_of_rooms = $_POST['number_of_rooms'];
    $room_type = $_POST['room_type'];
    $price = $_POST['price'];

    $data['address'] = $address;
    $data['number_of_rooms'] = $number_of_rooms;
    $data['room_type'] = $room_type;
    $data['price'] = $price;

    $newProperty = new Property($data);
    $property->save(true);
 
    $message = "Settings Saved<br/>";
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
    address: <input type='text' name='address' id='address'  value="<?php echo $address; ?>"/><br/>
    number_of_rooms: <input type='text' name='number_of_rooms' id='number_of_rooms'  value="<?php echo $number_of_rooms; ?>"/><br/>
    room_type: <input type='text' name='room_type' id='room_type'  value"<?php echo $room_type; ?>" /><br/>
    Price:  <input type='text' name='price' id='price'  value"<?php echo $price; ?>" /><br/>
    <input type="submit" value="Update Property" name="submit-updateProperty" />
    </form>
</body>
</html>