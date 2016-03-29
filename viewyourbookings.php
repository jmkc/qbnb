<?php 
 
require_once 'global.inc.php';
 
//check to see if they're logged in
if(!isset($_SESSION['logged_in'])) {
    header("Location: index.php");
}
$member = unserialize($_SESSION['member_id']);
$yourBookings = mysql_query("SELECT * FROM Booking inner join Property on Booking.property_id = Property.property_id inner join Member on owner_id = Member.member_id WHERE 
booking_member_id = $member->member_id and Booking.is_deleted = 0");


if(isset($_POST['cancel'])) { 
    header("Location: profile.php");
}
if(isset($_POST['deleteBooking'])) {
    $booking_id = $_POST['deleteBooking'];
    $sql2 = "Update Booking SET is_deleted = 1 where booking_id = $booking_id";
    mysql_query($sql2);// or die(mysql_error()); 
   header("Location: viewyourbookings.php");
}

if(isset($_POST['Search'])) { 
    $query = "SELECT * FROM Booking inner join Property on Booking.property_id = Property.property_id inner join Member on owner_id = Member.member_id WHERE 
    booking_member_id = $member->member_id and Booking.is_deleted = 0";
    if(!empty($_POST['status']) and $_POST['status'] != "All"){
        $status = $_POST['status'];
        //$message = $message."Viewing acommodations with $num_rooms rooms<br/>";
        $query .= " and status = '". $status . "'";
    } 
    $yourBookings = mysql_query($query);
}

?>
<html>
<head>
    <title>Qbnb | View Your Bookings</title>
</head>
<body>
    <h1>View Your Bookings</h1>
 	<?php
 	echo "<form action='viewyourbookings.php' method='post'>";
    if(mysql_num_rows($yourBookings) != 0){
 	while($booking = mysql_fetch_assoc($yourBookings))
 	{
 		extract($booking);
        if ($is_deleted == 0){
 		echo "<br />Status: $status<br />Address: $address <br /> Number of Rooms: $number_of_rooms - Room Type: $room_type - Price: $price - Owner: $FName $LName - Move In Date: $start_date <br />";
 		$sql = "select * from Points_Of_Interest where district_id = $district_id";
        echo "Points of Interest:";
        $POIs = mysql_query($sql);
        while ($POI = mysql_fetch_assoc($POIs)){
            extract($POI);
            echo "$points_of_interest<br \>";
        }
        
        
        echo "Delete Booking: <input type='submit' value=$booking_id name='deleteBooking' /><br/>";
        }
 	}
    }
    else{
        echo "You have no current confirmed bookings<br/>";
    }
    ?>
    <h1> Search For Bookings</h1>
    <form action="viewyourbookings.php" method="post">
    Status: <select name="status">
   <option value="All">All</option>     
  <option value="Confirmed">Confirmed</option>
  <option value="Unconfirmed">Unconfirmed</option>
  <option value="Denied">Denied</option>
    </select>
    <br/>
    
    <?php
    echo "<input type='submit' value='Search' name='Search' /><br/><br/></form>";
 	echo "<form action='viewyourbookings.php' method='post'>
     <input type='submit' value='Cancel' name='cancel' /></form>";
 	?>
</body>
</html>
