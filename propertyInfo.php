<?php 
 
require_once 'global.inc.php';
 
//check to see if they're logged in
if(!isset($_SESSION['logged_in'])) {
    header("Location: index.php");
}
//if(!isset($_SESSION['property_id'])) {
//    header("Location: viewproperties.php");
//}
//get the user object from the session
$property_id = $_SESSION['property_id'];
$property_info = mysql_query("SELECT * FROM Property WHERE property_id = $property_id");
$feature_info = mysql_query("SELECT * FROM Feature WHERE property_id = $property_id");
$property_bookings = mysql_query("SELECT * FROM Booking WHERE property_id = $property_id and status = 'Confirmed'");
$property_owner = mysql_query("SELECT * FROM Member WHERE member_id = (SELECT owner_id FROM Property WHERE property_id = $property_id)");
$property_comments = mysql_query("SELECT * FROM Comment inner join Member on commenting_member_id = member_id WHERE property_id = $property_id");

if(isset($_POST['backProperties'])) { 
    header("Location: viewproperties.php");
}
if(isset($_POST['updateProp'])) { 
    header("Location: viewproperties.php");
}
if(isset($_POST['bookProp'])) { 
    header("Location: viewproperties.php");
}
if(isset($_POST['comment'])) { 
    header("Location: makeComment.php");
}
if(isset($_POST['delete'])) { 
    $sql = "UPDATE Property SET is_deleted = 1 where property_id = $property_id";
    $sql_comment = "UPDATE Comment SET is_deleted = 1 where property_id = $property_id";
    $sql_booking = "UPDATE Booking SET is_deleted = 1 where property_id = $property_id";
    mysql_query($sql) or die(mysql_error());
    mysql_query($sql_comment) or die(mysql_error());
    mysql_query($sql_booking) or die(mysql_error());
    header("Location: viewproperties.php");
}

?>
 
<html>
<head>
    <title>Qbnb | Update Profile</title>
</head>
<body>
    <h1>Property Information</h1>
    <?php
    
    $property = mysql_fetch_assoc($property_info);
    extract($property);
    echo "<br />Address: $address - Number of Rooms: $number_of_rooms - Room Type: $room_type - Price: $price <br />";
    
    $owner = mysql_fetch_assoc($property_owner);
    extract($owner);
    $owner_id = $member_id;
    echo "<br/> Owned By: $FName $LName<br />";
    if(mysql_num_rows($feature_info) != 0){
        echo "<h2> Features</h2>";
        while($features = mysql_fetch_assoc($feature_info)){
            extract($features);
            echo "<br/> $feature<br />";
        }
    }
    else{
        echo "<h2> No available features</h2>";
    }
    if(mysql_num_rows($property_bookings) == 0){
        echo "<h2> No current bookings</h2>";
    }
    else{
        echo "<h2> Unavailable during the weeks starting on these dates:</h2>";
        while($bookings = mysql_fetch_assoc($property_bookings)){
            extract($bookings);
            echo "<br/> $start_date<br />";
        }
    }
     if(mysql_num_rows($property_comments) == 0){
        echo "<h2> No current comments</h2>";
    }
    else{
    echo "<h2> Comments:</h2>";
    while($comments = mysql_fetch_assoc($property_comments)){
        extract($comments);
        echo "<br/> On $Date, $FName $LName said: $text<br />";
    }
    }
        
    $member = unserialize($_SESSION['member_id']);
    if($member->member_id == $owner_id){
        echo"<form name='options' id='options' action='updateProperty.php' method='post'>
<input type='submit' name='updateProp' id='updateProp' value='Update Property' /> 
</form>";
        echo "<form name='options' id='options' action='viewproperties.php' method='post'>";
        echo "<input type='submit' name='delete' id='delete' value='Delete Property' /></form>"; 
    }
    else{
        echo"<form name='options' id='options' action='Book.php' method='post'>
<input type='submit' name='bookProp' id='bookProp' value='Book Property' /> 
</form>";;
    }
    ?>
  
<form name='options' id='options' action='makeComment.php' method='post'>
<input type='submit' name='comment' id='comment' value='Comment' /> 
</form>


<form name='options' id='options' action='viewproperties.php' method='post'>
<input type='submit' name='backProperties' id='backProperties' value='Back' /> 
</form>

 
</body>
</html>