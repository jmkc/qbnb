<?php
require_once 'global.inc.php';
$data = mysql_query("SELECT * FROM Property");
if (mysql_num_rows($data) > 0){
    for($i = 0; $i < mysql_num_rows($data); $i++){
        $row = mysql_fetch_row($data);
        echo "Address: ", $row[1], " Number of Rooms: ", $row[2], " Room Type: ", $row[3], " Price: ", $row[4],"\r";
    }
}
else{
    echo "No results";
}
?>