<?php

$db_servername = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "attendance";

$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);

if($conn->connect_error){
    die("connection failed:" . $conn->connect_error);
}

$sql = "SELECT * FROM add_student";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mark_attendance.css">
    <title>mark attendance</title>
</head>
<body>

<div class="container">

<div class="nav">
         <h1 class="s-name">HITBAMAS</h1>
         

          <div class="ll">



           
        <input type="file" accept="image/*"  width="300px" placeholder="Logo" class="logo" id="ima">
        <img src="" id="image-preview" alt="">

           <span class="j">
        <img  src="/icons/home page icon/2849812_menu_multimedia_bars_media_icon.svg" alt=""  class="drop_down" onclick="toggle_dropdown2()" >
           </span>
    

         
          </div>
      </div>

      <div class="body">

        <?php while ($row = $result->fetch_assoc()) { ?>
           

            <div class="names">
                <div class="data1">
        
           <h3> <?= $row["matricule"] ?></h3>
           <h3 class="h33"> <?= $row["name"] ?></h3>
                </div>

                <div class="btn">

                <button>present</button>
                <button class="orange">late</button>
                <button class="red">absent</button>
                </div>

            </div>
        
        <?php } ?>
    

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
        // Ensure the script runs after the DOM is fully loaded
        document.addEventListener("DOMContentLoaded", function() {
            // Create a new Date object
            const today = new Date();

            // Format the date as desired
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const formattedDate = today.toLocaleDateString('en-US', options);

            // Insert the formatted date into the HTML element with id "date"
            document.getElementById('date').textContent = formattedDate;
        });
    </script>
    
</body>
</html>

<?php $conn->close(); ?>

 