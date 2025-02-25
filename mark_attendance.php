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

    


    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>tell</th>
            <th>Program</th>
            <th>Department</th>
            <th>parent_contact</th>
            <th>Picture</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row["matricule"] ?></td>
            <td><?= $row["name"] ?></td>
            <td><?= $row["email"] ?></td>
            <td><?= $row["tell"] ?></td>
            <td><?= $row["program"] ?></td>
            <td><?= $row["department"] ?></td>
            <td><?= $row["parent_contact"] ?></td>
            <td><img src="<?= $row["picture"] ?>" width="100" height="100"></td>
        </tr>
        <?php } ?>
    </table>

</div>
    
</body>
</html>

<?php $conn->close(); ?>

 