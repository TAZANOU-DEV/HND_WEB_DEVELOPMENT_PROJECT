<?php
// Database connection
$db_servername = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "attendance";

$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $program = $_POST["program"];
    $department = $_POST["department"];
    $parent_contact = $_POST["p_number"];
    $matricule = $_POST["Matricule"];

    // Handle file upload (picture)
    $target_dir = "uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $file_name = basename($_FILES["picture"]["name"]);
    $target_file = $target_dir . time() . "_" . $file_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is an image
    $check = getimagesize($_FILES["picture"]["tmp_name"]);
    if ($check === false) {
        die("File is not an image.");
    }

    // Validate file format
    if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
        die("Only JPG, JPEG, PNG, and GIF files are allowed.");
    }

    // Move uploaded file to target directory
    if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
        // Insert student data into the database
        $sql = "INSERT INTO add_student (name, email, tell, program, department, parent_contact, matricule, picture) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss", $name, $email, $phone, $program, $department, $parent_contact, $matricule, $target_file);

        if ($stmt->execute()) {
            echo "<p>Student added successfully!</p>";
        } else {
            echo "<p>Error: " . $stmt->error . "</p>";
        }

        $stmt->close();
    } else {
        echo "<p>File upload failed.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="add_student.css">
    <title>Add Student</title>
</head>
<body>
    <div class="container">
        <div class="nav">
            <h1 class="s-name">HITBAMAS</h1>
            <div class="ll">
                <input type="file" accept="image/*" width="300px" placeholder="Logo" class="logo" id="ima">
                <img src="" id="image-preview" alt="">
            </div>
        </div>

        <form action="add_student.php" method="post" enctype="multipart/form-data">
            <div class="container_body">
                <div class="bod_left">
                    <label for="name">Name:</label>
                    <input type="text" name="name" placeholder="Name" required>
                    <br>
                    <label for="email">Email:</label>
                    <input type="email" name="email" placeholder="Email" required>
                    <br>
                    <label for="phone">Phone:</label>
                    <input type="tel" name="phone" placeholder="Phone Number" required>
                    <br>
                    <label for="program">Program:</label>
                    <select class="program" name="program" id="program" required>
                        <option value="hnd_1" selected>HND 1</option>
                        <option value="hnd_2">HND 2</option>
                        <option value="hnd_3">HND 3</option>
                    </select>
                    <br>
                    <label for="department">Department:</label>
                    <select class="department" name="department" id="department" required>
                        <option value="software" selected>Software Engineering</option>
                        <option value="network">Network and Security</option>
                        <option value="mechanics">Mechanics Engineering</option>
                        <option value="civil">Civil Engineering</option>
                        <option value="accounting">Accounting</option>
                        <option value="project">Project Management</option>
                        <option value="logistic">Logistic and Transport</option>
                        <option value="Banking">Banking and Finance</option>
                        <option value="human">Human Resource</option>
                        <option value="education">Education</option>
                        <option value="nursing">Nursing</option>
                        <option value="medical_lab">Medical Lab</option>
                        <option value="midwiffery">Midwifery</option>
                    </select>
                </div>

                <div class="bod_right">
                    <div class="ll">
                        <label for="picture">Picture:</label>
                        <input type="file" accept="image/*" name="picture" width="300px" placeholder="Logo" class="logo" id="ima" required>
                        <img src="" id="image-preview" alt="">
                    </div>
                    <label for="parent">Parent or Guardian Contact:</label>
                    <input type="number" name="p_number" placeholder="Phone Number" required>
                    <br>
                    <label for="Matricule">Matricule:</label>
                    <input type="text" name="Matricule" placeholder="Matricule" required>
                    <br>
                    <button type="submit">Add Student</button>
                </div>
            </div>
        </form>
    </div>

    <script src="add_student.js"></script>
</body>
</html>

<?php
$conn->close();
?>