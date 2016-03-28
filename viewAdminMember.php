<?php

require_once 'global.inc.php';
$member = unserialize($_SESSION['member_id']);
$member_view_id = $_SESSION['member_view_id'];
// $mesmber_view_id = $member_view->member_id;
$supplierBookings = mysql_query("SELECT booking.status, booking.start_date, property.address 
FROM Booking INNER JOIN Member on Booking.booking_member_id = Member.member_id 
INNER JOIN Property on Booking.property_id = property.property_id WHERE property.owner_id = $member_view_id");
$supplierRatings = mysql_query("SELECT Comment.rating, member.FName, member.LName, property.address
FROM Comment 
INNER JOIN Member on Comment.commenting_member_id = member.member_id
INNER JOIN Property on Comment.property_id = Property.property_id
WHERE property.owner_id = $member_view_id");
$consumerBookings = mysql_query("SELECT booking.status, booking.start_date, property.address 
FROM Booking INNER JOIN Member on Booking.booking_member_id = Member.member_id 
INNER JOIN Property on Booking.property_id = property.property_id 
WHERE Booking.booking_member_id = $member_view_id");
$consumerRatings = mysql_query("SELECT Comment.rating, member.FName, member.LName, property.address
FROM Comment 
INNER JOIN Member on Comment.commenting_member_id = member.member_id
INNER JOIN Property on Comment.property_id = Property.property_id
WHERE Comment.commenting_member_id = $member_view_id");


if(isset($_POST['viewmember'])) { 
    $_SESSION['member_view_id'] = $_POST['viewmember'];
    header("Location: viewAdminMember.php");
}
// Delete the profile
if(isset($_POST['delete'])) { 
    $sql_member = "UPDATE Member SET is_deleted = 1 WHERE member_id = $member_view_id";
    $sql_property = "UPDATE Property SET is_deleted = 1 WHERE owner_id = $member_view_id";
    $sql_booking = "UPDATE Booking SET is_deleted = 1 WHERE booking_member_id = $member_view_id";
    $sql_comment = "UPDATE Comment SET is_deleted = 1 WHERE commenting_member_id = $member_view_id";
    mysql_query($sql_member) or die(mysql_error());
    mysql_query($sql_property) or die(mysql_error());
    mysql_query($sql_booking) or die(mysql_error());
    mysql_query($sql_comment) or die(mysql_error());
    header("Location: viewAdminMembers.php");
}

if(isset($_POST['cancel'])) { 
    header("Location: adminProfile.php");
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Qbnb | Administrator</title>
    </head>
<body>
Welcome, Administrator <?php echo $member->FName; ?> <br/>
You are looking at the <?php echo $member_view_id; ?> profile.<br/>
<form action='adminDeleteMember.php' method='post'>
    <input type='submit' value='Delete Member' name='delete' /> 
</form>
<h1>Supply Activity:</h1>
<h2>Supply Booking:</h2>
<?php
 	echo "<form action='viewAdminMember.php' method='post'>";
 	while($supplierBooking = mysql_fetch_assoc($supplierBookings))
 	{
 		extract($supplierBooking);
 		echo "<br />Status: $status Start Date: $start_date Address: $address<br />";
     }
    echo "<h2>Supply Rating:</h2>";
    while($supplierRating = mysql_fetch_assoc($supplierRatings))
 	{
 		extract($supplierRating);
 		echo "<br />Rating: $rating Name: $FName $LName Address: $address<br />";
 	}
    echo "<h1>Consumer Activity:</h2>";
    echo "<h2>Consumer Bookings:</h2>";
    while($consumerBooking = mysql_fetch_assoc($consumerBookings))
 	{
 		extract($consumerBooking);
 		echo "<br />Status: $status Start Date: $start_date Address: $address<br />";
     }
    echo "<h2>Consumer Rating:</h2>";
    while($consumerRating = mysql_fetch_assoc($consumerRatings))
 	{
 		extract($consumerRating);
 		echo "<br />Rating: $rating Name: $FName $LName Address: $address<br />";
 	} 
    
 	echo "<input type='submit' value='Cancel' name='cancel' /></form>";
 	?>
</body>

</html>

