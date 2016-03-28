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
?>

<html>
	<head>	
		<title> Qbnb | Admin Properties</title>
	</head>
	<body>
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