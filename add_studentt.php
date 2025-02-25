<?php

$db_servername = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "attendance";

$errors = [];

// Connect to database
$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $tell = $_POST["p_number"]; // Fixed variable name
    $program = $_POST["program"];
    $department = $_POST["department"];
    $parent_contact = $_POST["p_number"]; // Assuming this is parent contact

    // Define upload directory
    $target_dir = "uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Check if file is uploaded
    if (isset($_FILES["picture"]) && !empty($_FILES["picture"]["name"])) {
        // Get file details
        $file_name = basename($_FILES["picture"]["name"]);
        $target_file = $target_dir . time() . "_" . $file_name;
        $uploadok = 1;
        $imagefiletype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file is an image
        $check = getimagesize($_FILES["picture"]["tmp_name"]);
        if ($check === false) {
            die("File is not an image.");
        }

        // Validate file format
        if (!in_array($imagefiletype, ["jpg", "png", "jpeg", "gif"])) {
            die("Only JPG, JPEG, PNG, and GIF files are allowed.");
        }

        // Move uploaded file to target directory
        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
            // Prepare and execute SQL query
            $sql = "INSERT INTO add_student (name, email, tell, program, department, parent_contact, picture) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssissss", $name, $email, $tell, $program, $department, $parent_contact, $target_file);

            if ($stmt->execute()) {
                echo "Student registered successfully!";
            } else {
                echo "Error: " . $stmt->error;
            }
        } else {
            echo "File upload failed.";
        }
    } else {
        // Handle the case where no file is uploaded
        $target_file = null; // or some default value
        // Prepare and execute SQL query without the picture
        $sql = "INSERT INTO add_student (name, email, tell, program, department, parent_contact) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssisss", $name, $email, $tell, $program, $department, $parent_contact);

        if ($stmt->execute()) {
            echo "Student registered successfully without a picture!";
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $conn->close();
}

?>