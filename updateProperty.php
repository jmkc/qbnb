<?php 
 
require_once 'global.inc.php';
 
//check to see if they're logged in
if(!isset($_SESSION['logged_in'])) {
    header("Location: index.php");
}
 
//get the user object from the session
$data['property_id'] = $_SESSION['property_id'];
 
//$properties = "Select * from Property WHERE property_id = $property_id";
//initialize php variables used in the form
$number_of_rooms = "";
$room_type = "";
$price = "";

//check to see that the form has been submitted
if(isset($_POST['submit-updateProperty'])) { 
 
    //retrieve the $_POST variables
    $number_of_rooms = $_POST['number_of_rooms'];
    $room_type = $_POST['room_type'];
    $price = $_POST['price'];

    $data['number_of_rooms'] = $number_of_rooms;
    $data['room_type'] = $room_type;
    $data['price'] = $price;
    
    echo $data['number_of_rooms'];
    echo $data['room_type'];
    echo $data['price'];
    
    $updateProperty = new Property($data);
    $updateProperty->save();
    header("Location: propertyInfo.php");
    $message = "Settings Saved<br/>";
}

if(isset($_POST['addFeature'])) { 
 
    //retrieve the $_POST variables
    $feature = $_POST['feature'];
    $property_id = $_SESSION['property_id'];
    $featureData['feature'] = $feature;
    $featureData['property_id']= $property_id;
    $db->insert($featureData, 'Feature');
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
    <h1>Update Property</h1>
    <h2>Update Property Info</h2>
    <form action="updateProperty.php" method="post">
    Number of Rooms: <input type='text' name='number_of_rooms' id='number_of_rooms'  value="<?php echo $number_of_rooms; ?>"/><br/>
    Room Type: <input type='text' name='room_type' id='room_type'  value="<?php echo $room_type; ?>" /><br/>
    Price:  <input type='text' name='price' id='price'  value="<?php echo $price; ?>" /><br/>
    <input type="submit" value="Update Property" name="submit-updateProperty" /><br/><br/>
    <h2>Update Property Features</h2>
    Feature: <input type='text' name='feature' id='feature'  value="" /><br/>
    <input type="submit" value="Add Additonal Feature" name="addFeature" /><br/>
    </form>
    <form action="propertyInfo.php" method="post">
    <input type="submit" value="Back" name="backProperty" />
    </form>
</body>
</html>