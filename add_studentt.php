<?php
 
 $db_servername = "localhost";
 $db_username = "root";
 $db_password = "";
 $db_name = "attendance";

 $errors = [];


 $conn = new mysqli($db_servername, $db_username, $db_password, $db_name);

 if($conn -> connect_error){

    die("connection failed:" . $conn->connect_error);
 }


 if($_SERVER["REQUEST_METHOD"] == "POST"){

 $name = $_POST["name"];
 $email = $_POST["email"];
 $phone  = $_POST["program"];
 $department = $_POST["department"];
 $p_number = $_POST["p_number"];


 }
 $target_dir = "uploads/";
 if(!file_exists($target_dir)){

    mkdir($target_dir, 0777, true);
 }

 $check = getimagesize($_FILES["picture"]["name"])
 $target_file = $target_dir . time() . "_" . $file_name;
 $uploadok = 1;
 $imagefiletype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

 $check = getimagesize($_FILES["picture"]["tmp_name"]);
    if($check === false){

        die("file is not an image");
    }

    if(!in_array($imagefiletype, ["jpg", "png", "jpeg", "gif"])){

        die("only jpg, jpeg, png, and gif files are allowed");


    }

    if(move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {

        $sql = "INSERT INTO add_student (name,email,tell,program,department,parent_contact,picture) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssissis", $name, $email, $tell, $program, $department, $parent_contact, $picture);

        if($stmt->execute()){

            echo"student registered successfully!";
        } else {

            echo "error:" .$stmt->error;
        }
    }else{

        echo "file upload failed.";
    }

    $conn->close();




 




?>