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





$conn = new mysqli("localhost", "root", "", "attendance");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request is POST and contains required fields
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['student_name']) && isset($_POST['status'])) {
    $student_id = $_POST['student_name'];
    $status = $_POST['status'];

    // Check if the student already has an attendance record for today
    $sql = "SELECT id FROM attendance WHERE student_name= ? AND date = CURDATE()";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Update existing record
        $update = "UPDATE attendance SET status = ? WHERE student_name = ? AND date = CURDATE()";
        $stmt = $conn->prepare($update);
        $stmt->bind_param("si", $status, $student_id);
        $stmt->execute();
    } else {
        // Insert new attendance record
        $insert = "INSERT INTO attendance (student_name, status, date) VALUES (?, ?, CURDATE())";
        $stmt = $conn->prepare($insert);
        $stmt->bind_param("is", $student_id, $status);
        $stmt->execute();
    }

    echo json_encode(["success" => true]);
}

$conn->close();


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
                            <button class="green" onclick="markAttendance(this, \'present\')">Present</button>
                            <button class="orange" onclick="markAttendance(this, \'late\')">Late</button>
                            <button class="red" onclick="markAttendance(this, \'absent\')">Absent</button>
                             

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
        <div class="status" onclick="showStudents('present')">
        <span class="label">Present</span>
        <span id="present-count" class="value">0</span>
    </div>
    <div class="status1" onclick="showStudents('late')">
        <span class="label">Late</span>
        <span id="late-count" class="value">0</span>
    </div>
    <div class="status2" onclick="showStudents('absent')">
        <span class="label">Absent</span>
        <span id="absent-count" class="value">0</span>
    </div>
</div>


<div id="student-list" class="student-list">
    <h2 id="list-title"></h2>
    <ul id="student-names"></ul>
</div>


    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const today = new Date();
            document.getElementById('date').textContent = today.toDateString();
        });

        function markAttendance(button, status) {
    let studentDiv = button.closest(".names");
    let studentId = studentDiv.getAttribute("data-id"); // Ensure each student div has a data-id

    let currentStatus = studentDiv.getAttribute("data-status");
    if (currentStatus === status) return;

    // Update UI
    if (currentStatus) {
        document.getElementById(currentStatus + "-count").textContent--;
    }
    document.getElementById(status + "-count").textContent++;
    studentDiv.setAttribute("data-status", status);

    // Reset button styles
    let buttons = studentDiv.querySelectorAll(".btn button");
    buttons.forEach(btn => btn.classList.remove("active"));
    button.classList.add("active");

    // Send data to PHP using Fetch API
    fetch("mark_attendance.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `student_id=${studentId}&status=${status}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log("Attendance updated successfully");
        }
    })
    .catch(error => console.error("Error:", error));
}


function showStudents(status) {
        let studentList = document.getElementById('student-list');
        let listTitle = document.getElementById('list-title');
        let studentNames = document.getElementById('student-names');

        listTitle.textContent = status.charAt(0).toUpperCase() + status.slice(1) + " Students";
        studentNames.innerHTML = ""; // Clear previous list

        document.querySelectorAll(".names").forEach(student => {
            if (student.getAttribute("data-status") === status) {
                let name = student.querySelector(".h33").textContent;
                let li = document.createElement("li");
                li.textContent = name;
                studentNames.appendChild(li);
            }
        });

        studentList.classList.add("show");
    }


    </script>
</body>
</body>
</html>

<?php
if (isset($stmt)) {
    $stmt->close();
}

?>