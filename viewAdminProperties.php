<!DOCTYPE HTML>

<?php
	require_once 'global.inc.php';
	if(!isset($_SESSION['logged_in']))
	{
		header("Location: index.php");
		die();
	}
	
	if(isset($_POST['backBtn'])) 
	{ 
		header("Location: adminProfile.php");
		die();
	}
	
	// if(isset($_POST['deleteProperty']))
	// {
	// 	$property_id = $_POST['deleteProperty'];
	// 	$sql = "UPDATE Property SET is_deleted = 1 where property_id = $property_id";
	// 	$sql_comment = "UPDATE Comment SET is_deleted = 1 where property_id = $property_id";
	// 	$sql_booking = "UPDATE Booking SET is_deleted = 1 where property_id = $property_id";
	// 	mysql_query($sql);
	// 	mysql_query($sql_comment);
	// 	mysql_query($sql_booking);
	// 	header("Location: viewAdminProperties.php");
	// 	// die();
	// }
    if(isset($_POST['deleteProperty'])) {
    $property_id = $_POST['deleteProperty'];
    $sql2 = "Update Property SET is_deleted = 1 where property_id = $property_id";
    mysql_query($sql2);// or die(mysql_error());
     
   //header("Location: viewadminProperties.php");
    }

	if(isset($_POST['viewproperty'])) { 
    $_SESSION['property_view_id'] = $_POST['viewproperty'];
    header("Location: viewAdminProperty.php");
    }
	$member = unserialize($_SESSION['member_id']);
	$allProperties =mysql_query("SELECT * from Property natural join district inner join Member  
    where property.owner_id = member.member_id and property.is_deleted = 0");
    $allPropertiesdelete =mysql_query("SELECT * from Property natural join district inner join Member  
    where property.owner_id = member.member_id and property.is_deleted = 1");
?>

<html>
	<head>	
		<title> Qbnb | Admin Properties</title>
	</head>
	<body>
        <h1>View All Properties</h1>
        <?php 
        echo "<h2>Active Properties</h2>";
        while($property = mysql_fetch_assoc($allProperties))
 	    {
 		extract($property);
        echo "<form action='viewAdminProperties.php' method='post'>";
 		echo "<br />Address: $address <br />Number of Rooms: $number_of_rooms Room Type: $room_type 
         <br /> Price: $price  <br /> District: $district_name <br />Owner: $FName $LName<br /> ";
 		echo "View Property:<input type='submit' value=$property_id name='viewproperty' /></form><br/>";         
 	    }
         echo "<h2>Deleted Properties</h2>";
          while($property = mysql_fetch_assoc($allPropertiesdelete))
 	    {
 		extract($property);
        echo "<form action='viewAdminProperties.php' method='post'>";
 		echo "<br />Address: $address <br />Number of Rooms: $number_of_rooms Room Type: $room_type 
         <br /> Price: $price  <br /> District: $district_name <br />Owner: $FName $LName<br /> ";
 		echo "View Property:<input type='submit' value=$property_id name='viewproperty' /></form><br/>";
        // echo "<form action='viewAdminProperties.php' method='post'>
        // Delete Property: <input type='submit' value=$property_id name='deleteProperty' /></form><br />";
         
 	    }
 	    echo "<br/>";
 	    ?>
        <form action='adminProfile.php' method='post'>
             <input type='submit' value='Back' name='back' />
        </form>
	</body>
</html>