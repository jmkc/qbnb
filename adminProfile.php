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
    // include_once 'config/connection.php'; 
	header("Location: viewAdminMembers.php");
	// die();
 }
if(isset($_POST['viewPOIBtn']) && isset($_SESSION['member_id'])){
	include_once 'config/connection.php';
	header("Location: viewAdminPOI.php");
	die();
}
?>

Welcome, Administrator <?php echo $member->FName; ?> <br/>
<form name='options' id='options' action='viewAdminProperties.php' method='post'>
    <input type='submit' name='viewAdminPropertiesBtn' id='viewAdminPropertiesBtn' value='Properties' /></form>
    <form name='options' id='options' action='viewAdminMembers.php' method='post'>
    <input type='submit' name='viewAdminMembersBtn' id='viewAdminMembersBtn' value='Members' /></form>
    <form name='options' id='options' action='profile.php' method='post'>
    <input type='submit' name='viewPOIBtn' id='viewPOIBtn' value='Points of Interest' /></form>
    <form name='options' id='options' action='profile.php' method='post'>
    <input type='submit' name='logoutBtn' id='logoutBtn' value='Log Out' /></form>
    <form name='options' id='options' action='profile.php' method='post'>
    <input type='submit' name='backBtn' id='backBtn' value='Back' /></form>
</form>
</body>

</html>

