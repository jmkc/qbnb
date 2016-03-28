<?php

$host = "localhost";
$username = "Assignment1";
$password = "cmpe332!";
$db_name = "QBnB";

try 
{
    $con = new mysqli($host,$username,$password, $db_name);
}
catch(Exception $exception)
{
    echo "Connection error: " . $exception->getMessage();
}
?>