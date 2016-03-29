<?php 
require_once 'global.inc.php';

if(isset($_POST['addPOI'])) { 
 
    //retrieve the $_POST variables
    $poi = $_POST['poi'];
    $data['poi'] = $poi;
    $district_id = $_POST['district_id'];
    $data['district_id'] = $district_id;
    $db->insert($data, 'Points_of_Interest');
    
   
}
 
if(isset($_POST['back'])) { 
    header("Location: adminProfile.php");
}

$allPOI = mysql_query("SELECT * FROM Points_of_Interest natural join District");

?>


<html>
<head>
    <title>Qbnb | Add POI</title>
</head>
<body>
<?php
 	while($onePOI= mysql_fetch_assoc($allPOI))
 	{
 		extract($onePOI);
 		echo "<br />District: $district_name POI: $points_of_interest<br />";
 	}
 	?>
 
    <form action="newPOI.php" method="post">
    Point of Interest: <input type='text' name='poi' id='poi'  value=""/><br/>
    District: <select name="district_id">
  <option value="1">Uptown</option>
  <option value="2">Waterfront</option>
  <option value="3">Rosedale</option>
  <option value="4">Chinatown</option>
  <option value="5">Midtown</option>
</select>
<br/>
    <input type="submit" value="Add Point of Interes" name="addPOI" />
    <input type='submit' value='Back' name='back' /></form>
    </form>
</body>
</html>

