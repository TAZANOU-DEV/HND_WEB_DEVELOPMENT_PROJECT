<?php


// configuration
  $db_servername = "localhost";
  $db_username = "root";
  $db_password = "";
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
}

// validate user input


$name = mysqli_real_escape_string($conn, $name);
$email= mysqli_real_escape_string($conn, $email);
$password = mysqli_real_escape_string($conn, $password);

if(empty($errors)){
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
}
 

//insert dt in db

$stmt = $conn->prepare("INSERT INTO register (school_name, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $password);

if ($stmt->execute()) {
    echo "Registration successful!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();






?> 