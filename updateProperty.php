<?php 
 
require_once 'global.inc.php';
 
//check to see if they're logged in
if(!isset($_SESSION['logged_in'])) {
    header("Location: index.php");
}
 
//get the user object from the session
$property = $_SESSION['property_id'];
 
//initialize php variables used in the form
$address = "";
$number_of_rooms = "";
$room_type = "";
$price = "";
 
//check to see that the form has been submitted
if(isset($_POST['submit-updateProperty'])) { 
 
    //retrieve the $_POST variables
    $address = $_POST['address'];
    $number_of_rooms = $_POST['number_of_rooms'];
    $room_type = $_POST['room_type'];
    $price = $_POST['price'];

    $property->address = $address;
    $property->number_of_rooms = $number_of_rooms;
    $property->room_type = $room_type;
    $property->price = $price;
    $member->save();
 
    $message = "Settings Saved<br/>";
}
 
//If the form wasn't submitted, or didn't validate
//then we show the registration form again
?>
 
<html>
<head>
    <title>Qbnb | Update Property</title>
</head>
<body>
    <?php //echo $message; ?>
 
    <form action="updateProperty.php" method="post">
    Address: <input type='text' name='address' id='address'  value="<?php echo $address; ?>"/><br/>
    Number of Rooms: <input type='text' name='number_of_rooms' id='number_of_rooms'  value="<?php echo $number_of_rooms; ?>"/><br/>
    Room Type: <input type='text' name='room_type' id='room_type'  value"<?php echo $room_type; ?>" /><br/>
    Price:  <input type='text' name='price' id='price'  value"<?php echo $price; ?>" /><br/>
    <input type="submit" value="Update Property" name="submit-updateProperty" />
    </form>
    <form action="propertyInfo.php" method="post">
    <input type="submit" value="Back" name="backProperty" />
    </form>
</body>
</html>