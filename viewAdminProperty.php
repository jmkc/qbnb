<?php

require_once 'global.inc.php';
$member = unserialize($_SESSION['member_id']);
$message = "";
$property_view_id = $_SESSION['property_view_id'];
// $mesmber_view_id = $member_view->member_id;
$property_info = mysql_query("Select * from Property WHERE property_id = $property_view_id");
$propertyBookings = mysql_query("SELECT booking.status, booking.start_date, member.FName, member.LName  
FROM Booking INNER JOIN Member on Booking.booking_member_id = Member.member_id 
WHERE property_id = $property_view_id");
$propertyRatings = mysql_query("SELECT Comment.rating, member.FName, member.LName
FROM Comment 
INNER JOIN Member on Comment.commenting_member_id = member.member_id
WHERE property_id = $property_view_id");

if(isset($_POST['viewproperty'])) { 
    $_SESSION['member_view_id'] = $_POST['viewmember'];
    header("Location: viewAdminMember.php");
}
// Delete the profile
if(isset($_POST['delete'])) { 
    $sql_property = "UPDATE Property SET is_deleted = 1 WHERE property_id = $property_view_id";
    $sql_booking = "UPDATE Booking SET is_deleted = 1 WHERE property_id = $property_view_id";
    mysql_query($sql_property);// or die(mysql_error());
    mysql_query($sql_booking);// or die(mysql_error());
    // $message = "DELETED";
    header("Location: viewAdminProperties.php");
}

if(isset($_POST['cancel'])) { 
    header("Location: viewAdminProperties.php");
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Qbnb | Administrator</title>
    </head>
<body>
<!--<?php echo $message ?>-->
Welcome, Administrator <?php echo $member->FName; ?> <br/>
<form  method='post'>
    <input type='submit' value='Delete Property' name='delete' /> 
</form>
<h1>Accodmodation Activity:</h1>

<?php
    if ((mysql_num_rows($propertyBookings)!=0) || (mysql_num_rows($propertyRatings)!=0)){
 	echo "<form action='viewAdminMember.php' method='post'>";}
 	if (mysql_num_rows($propertyBookings)!=0){
         echo "<h2>Accomodation Booking:</h2>";
          while($propertyBooking = mysql_fetch_assoc($propertyBookings))
 	    {
 		extract($propertyBooking);
         echo "<br />Name: $FName $LName";
 		echo "<br />Status: $status";
        echo "<br />Start Date: $start_date";
     }
     }
    if (mysql_num_rows($propertyRatings)!=0){
    echo "<h2>Accomodation Rating:</h2>";
    while($propertyRating = mysql_fetch_assoc($propertyRatings))
 	{
 		extract($propertyRating);
 		echo "<br />Name: $FName $LName";
 		echo "<br />Rating: $rating";
 	}
    }
 	echo "<input type='submit' value='Cancel' name='cancel' /></form>";
 	
     ?>
</body>

</html>

