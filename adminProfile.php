<!DOCTYPE HTML>
<html>
    <head>
        <title>Administrator</title>
    </head>
<body>
	<table border = "1" style="width:50%">
	
<?php
	require_once 'global.inc.php';
	$member = unserialize($_SESSION['member_id']);
	$allProperties = $db->select('property', 1);
?>

<?php


if(isset($_POST['logoutBtn']) && isset($_SESSION['member_id'])){
	include_once 'config/connection.php'; 
	$userTools = new UserTools();
    $userTools->logout();
	header("Location: index.php");
	die();
}
if(isset($_POST['backBtn']) && isset($_SESSION['member_id'])){
	include_once 'config/connection.php';
	header("Location: index.php");
	die();
}
?>

Welcome, Administrator <?php echo $member->FName; ?> <br/>
Properties: <br/>
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
<form name='options' id='options' action='profile.php' method='post'>
    <table border='0'>
        <tr>
            <td></td>
            <td>
                <input type='submit' name='logoutBtn' id='logoutBtn' value='Log Out' /> 
            </td>
        </tr>
		<tr>
            <td></td>
            <td>
                <input type='submit' name='backBtn' id='backBtn' value='Back' /> 
            </td>
        </tr>
    </table>
</form>
</body>

</html>

