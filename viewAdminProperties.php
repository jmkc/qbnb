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
	$member = unserialize($_SESSION['member_id']);
	$allProperties = $db->select('property', 1);
	
	// Deletes a property
	function deleteProperty($property_id){
		$sql = "UPDATE Property SET is_deleted = 1 where property_id = $property_id";
		$sql_comment = "UPDATE Comment SET is_deleted = 1 where property_id = $property_id";
		$sql_booking = "UPDATE Booking SET is_deleted = 1 where property_id = $property_id";
		mysql_query($sql) or die(mysql_error());
		mysql_query($sql_comment) or die(mysql_error());
		mysql_query($sql_booking) or die(mysql_error());
		header("Location: viewAdminProperties.php");
		die();
	}
	
?>

<html>
	<head>	
		<title> Qbnb | Admin Properties</title>
	</head>
	<body>
		<table border = "1" style="width:50%">
		<tr>
	<?php
foreach ($allProperties[0] as $key=>$value){
	?>
	<td>
	<?php
		echo $key
	?>
	</td>
	<?php
}
	?>
	<td>
		Delete
	</td>
		</tr>
	<?php


foreach ($allProperties as $value){
	?>
		<tr>
	<?php
	foreach ($value as $key=>$shit){
		if ($key == 'property_id'){
			$current_property_id = $key;
		}
		?>
		<td>
		<?php
			echo $shit
		?>
		</td>
		<?php
	}
	?>
	<td>
		<form name='delete' action='viewAdminProperties.php?deleteProperty=' method='post'>
			<input type="submit" name="DeleteBtn" value="Delete">
		</form>
		</td>
		</tr>
		
	<?php
	
}

?>
		</table>
		<form name='admin_properties' action='viewAdminProperties.php' method='post'>
			<table border='0'>
			<tr>
				<td>
					<input type='submit' name='backBtn' id='backBtn' value='Back' /> 
				</td>
			</table>
        </tr>
		</form>
	</body>
</html>