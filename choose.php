<?php
$db_servername = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "attendance";

$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all programs and departments from the database
$programs = ["HND 1", "HND 2", "HND 3"];
$departments = [
    "Software Engineering",
    "Network Engineering",
    "Civil Engineering",
    "Electrical Engineering",
    "Mechanical Engineering",
    "telecommunication ",
    "accounting",
    "LTM",
    "PROJECT management",
    "banking",
    "human resource",
    "nursing",
    "medical laboratory"

];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Program and Department</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        function loadDepartments() {
            const program = document.getElementById("program").value;
            const departmentSelect = document.getElementById("department");

            // Clear previous options
            departmentSelect.innerHTML = '<option value="">Select Department</option>';

            // Add departments based on the selected program
            const departments = <?= json_encode($departments) ?>;
            departments.forEach(dept => {
                const option = document.createElement("option");
                option.value = dept;
                option.textContent = dept;
                departmentSelect.appendChild(option);
            });
        }
    </script>


<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.container {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 80%;
    max-width: 800px;
}

label {
    display: block;
    margin: 10px 0 5px;
}

select, button {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

button {
    background-color: #007bff;
    color: #fff;
    border: none;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

</style>
</head>
<body>
    <div class="container">
        <h1>Select Program and Department</h1>
        <form action="mark_attendance.php" method="GET">
            <!-- Program Selection -->
            <label for="program">Select Program:</label>
            <select id="program" name="program" onchange="loadDepartments()" required>
                <option value="">Select Program</option>
                <?php foreach ($programs as $program) { ?>
                    <option value="<?= $program ?>"><?= $program ?></option>
                <?php } ?>
            </select>

            <!-- Department Selection -->
            <label for="department">Select Department:</label>
            <select id="department" name="department" required>
                <option value="">Select Department</option>
            </select>

          <a href="mark_attendance.php"> <button type="submit">Submit</button></a>
        </form>
    </div>
</body>
</html>