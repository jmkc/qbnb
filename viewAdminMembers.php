<?php

require_once 'global.inc.php';
$member = unserialize($_SESSION['member_id']);

if(isset($_POST['viewmember'])) { 
    $_SESSION['member_view_id'] = $_POST['viewmember'];
    header("Location: viewAdminMember.php");
}

$allMembers = mysql_query("SELECT * FROM Member");
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
    <h1>View all members</h1>
Welcome, Administrator <?php echo $member->FName; ?> <br/>
<?php
 	echo "<form action='viewAdminMembers.php' method='post'>";
 	while($membercurr = mysql_fetch_assoc($allMembers))
 	{
 		extract($membercurr);
 		echo "<br />Name: $FName $LName Faculty: $faculty<br />";
 		echo "View Member:<input type='submit' value=$member_id name='viewmember' /><br/>";
 	}
 	echo "<br/><input type='submit' value='Cancel' name='cancel' /></form>";
 	?>
</body>

</html>

