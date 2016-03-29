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
	
	if(isset($_POST['deleteProperty']))
	{
		$property_id = $_POST['deleteProperty'];
		$sql = "UPDATE Property SET is_deleted = 1 where property_id = $property_id";
		$sql_comment = "UPDATE Comment SET is_deleted = 1 where property_id = $property_id";
		$sql_booking = "UPDATE Booking SET is_deleted = 1 where property_id = $property_id";
		mysql_query($sql);
		mysql_query($sql_comment);
		mysql_query($sql_booking);
		header("Location: viewAdminProperties.php");
		die();
	}
	
	$member = unserialize($_SESSION['member_id']);
	$allProperties = $db->select('property', 1);
	
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
			$property_id = $shit;
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
		<form name='delete' action='viewAdminProperties.php' method='post'>
		<?php
			echo "<input type='submit' value=$property_id name='deleteProperty' />";
		?>
		
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