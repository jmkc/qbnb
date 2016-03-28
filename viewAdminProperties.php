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
		header("Location: profile.php");
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
		</tr>
	<?php


foreach ($allProperties as $value){
	?>
		<tr>
	<?php
	foreach ($value as $shit){
		?>
		<td>
		<?php
			echo $shit
		?>
		</td>
		<?php
	}
	?>
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