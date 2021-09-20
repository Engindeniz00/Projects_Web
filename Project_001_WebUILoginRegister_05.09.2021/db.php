<?php
$db_host = "localhost";
$db_username = "root";
$db_password = "";

// create connection
$connection = new mysqli($db_host,$db_username,$db_password);

// checking connection if there is something wrong

if($connection->connect_error){
    die("Connection failed: ".$connection->connect_error);
}

$connection->set_charset("utf8");
//echo 'connection succesfully';
//echo '<hr>';
if(!mysqli_select_db($connection,"p004")){
    die("unable to select database".mysqli_error());
}











?>
