<?php

// configuration
  $db_servername = "localhost";
  $db_username = "username";
  $db_password = "password";
  $db_name = "attendance";

// connect database

$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);

//check connection

if($conn->connect_error){
    die("connection failed:" . $conn->connect_error);
}

// process the form data
if ($_SERVER["REQUEST_METHOD"] == "POST"  ){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $c_password =$_POST["password"];
}

// validate user input


$name = mysqli_real_escape_string($conn, $name);
$email= mysqli_real_escape_string($conn, $email);
$password = mysqli_real_escape_string($conn, $password);
$c_password = mysqli_real_escape_string($conn, $c_password);

//insert dt in db

$stmt = $conn->prepare("INSERT INTO register (name, email, password, c_password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $password, $c_password);

if ($stmt->execute()) {
    echo "Registration successful!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();






?> 