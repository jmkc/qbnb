<!DOCTYPE HTML>
<html>
    <head>
        <title>Administrator</title>
    </head>
<body>

	
<?php
	require_once 'global.inc.php';
	$member = unserialize($_SESSION['member_id']);
	$allProperties = $db->select('property', 1);

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
if(isset($_POST['viewAdminPropertiesBtn']) && isset($_SESSION['member_id'])){
    include_once 'config/connection.php'; 
    header("Location: viewAdminProperties.php");
	die();
 }
if(isset($_POST['viewAdminMembersBtn']) && isset($_SESSION['member_id'])){
    include_once 'config/connection.php'; 
	header("Location: viewAdminMembers.php");
	die();
 }
if(isset($_POST['viewPOIBtn']) && isset($_SESSION['member_id'])){
	include_once 'config/connection.php';
	header("Location: viewAdminPOI.php");
	die();
}
?>

Welcome, Administrator <?php echo $member->FName; ?> <br/>
<form name='options' id='options' action='profile.php' method='post'>
    <table border='0'>
		<tr>
            <td></td>
            <td>
                <input type='submit' name='viewAdminPropertiesBtn' id='viewAdminPropertiesBtn' value='Properties' /> 
            </td>
        </tr>
         <tr>
            <td></td>
            <td>
                <input type='submit' name='viewAdminMembersBtn' id='viewAdminMembersBtn' value='Members' /> 
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' name='viewPOIBtn' id='viewPOIBtn' value='Points of Interest' /> 
            </td>
        </tr>
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

