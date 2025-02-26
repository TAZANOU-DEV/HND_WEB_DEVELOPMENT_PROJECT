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

// Get the selected program and department from the form submission
$program = isset($_POST['program']) ? $_POST['program'] : '';
$department = isset($_POST['department']) ? $_POST['department'] : '';

// Fetch students for the selected program and department
if (!empty($program) && !empty($department)) {
    $sql = "SELECT * FROM add_student WHERE program = ? AND department = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $program, $department);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // If no program or department is selected, fetch all students (or handle as needed)
    $sql = "SELECT * FROM add_student";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mark_attendance.css">
    <title>Mark Attendance</title>
</head>
<body>
    <div class="container">
        <div class="nav">
            <h1 class="s-name">HITBAMAS</h1>
            <div class="ll">
                <input type="file" accept="image/*" width="300px" placeholder="Logo" class="logo" id="ima">
                <img src="" id="image-preview" alt="">
                <span class="j">
                    <img src="/icons/home page icon/2849812_menu_multimedia_bars_media_icon.svg" alt="" class="drop_down" onclick="toggle_dropdown2()">
                </span>
            </div>
        </div>

        <!-- Form to select program and department -->
        <form method="POST" action="mark_attendance.php">
            <label for="program">Program:</label>
            <select name="program" id="program" required>
                <option value="hnd_1">HND 1</option>
                <option value="hnd_2">HND 2</option>
                <option value="hnd_3">HND 3</option>
            </select>

            <label for="department">Department:</label>
            <select name="department" id="department" required>
                <option value="software">Software Engineering</option>
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

            <button type="submit">Show Students</button>
        </form>

        <h2><?= ucfirst($program) ?> - <?= ucfirst($department) ?></h2>

        <div class="body">
            <?php
            if (isset($result) && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '
                    <div class="names">
                        <div class="data1">
                            <h3>' . $row["matricule"] . '</h3>
                            <h3 class="h33">' . $row["name"] . '</h3>
                        </div>
                        <div class="btn">
                            <button class="green">Present</button>
                            <button class="orange">Late</button>
                            <button class="red">Absent</button>
                        </div>
                    </div>';
                }
            } else {
                echo "<p>No students found for the selected program and department.</p>";
            }
            ?>
        </div>

        <hr>

        <h1 id="date"></h1>

        <div class="contain">
            <div class="status">
                <span class="label">Present</span>
                <span class="value">00</span>
            </div>
            <div class="status1">
                <span class="label">Late</span>
                <span class="value">00</span>
            </div>
            <div class="status2">
                <span class="label">Absent</span>
                <span class="value">00</span>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const today = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const formattedDate = today.toLocaleDateString('en-US', options);
            document.getElementById('date').textContent = formattedDate;
        });
    </script>
</body>
</html>

<?php
if (isset($stmt)) {
    $stmt->close();
}
$conn->close();
?>