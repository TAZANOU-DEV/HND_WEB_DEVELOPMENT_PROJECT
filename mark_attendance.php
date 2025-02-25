<?php

$db_servername = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "attendance";

$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);

if($conn->connect_error){
    die("connection failed:" . $conn->connect_error);
}

$sql = "SELECT * FROM add_studdent";
$result = $conn->query($sql);

?>

 