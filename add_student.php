<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="add_student.css">
    <title>add student</title>
</head>
<body>
     <div class="container">
        <div class="nav">
            <h1 class="s-name">HITBAMAS</h1>
            
   
             <div class="ll">
              
                 <input type="file" accept="image/*"  width="300px" placeholder="Logo" class="logo" id="ima">
                 <img src="" id="image-preview" alt="">

   
            
             </div>
         </div>
         <form action="add_studentt.php" method="post">

         <div class="container_body">
        

             <div class="bod_left">

                 <label for="name">name</label>
                 <input type="text" name="name" placeholder="name">
                 <br>
                 <label for="email">email</label>
                 <input type="email" name="email" placeholder="email">
                 <br>
                 <label for="phone">phone</label>
                 <input type="phone" name="phone" placeholder="phone number">
                 <br>
                 <label for="program">program:</label>
                 <select class="program" name="program" id="program">

                    <option value="hnd_1" selected>HND 1</option>
                    <option value="hnd_2">HND 2</option>
                    <option value="hnd_3">HND 3</option>
                 </select>

                   <br>
                <label for="department">department:</label>
                <select class="department" name="department" id="department">

                    <option value="software" selected>software engineering</option>
                    <option value="network">Network and security</option>
                    <option value="mechanics">mechanics engineering</option>
                    <option value="civil">civil engineering</option>
                    <option value="accounting">Accounting</option>
                    <option value="project">Project management</option>
                    <option value="logistic">logistic and transport</option>
                    <option value="Banking">Banking and finance</option>
                    <option value="human">Human resource</option>
                    <option value="education">education</option>
                    <option value="nursing">nursing</option>
                    <option value="medical_lab">medical lab</option>
                    <option value="midwiffery">midwiffery</option>
                    
                 </select>


             </div>
             <div class="bod_right">

                
                <div class="ll">

                    <label for="picture">picture:</label>
                    <input type="file" accept="image/*" name="picture"  width="300px" placeholder="Logo" class="logo" id="ima">
                    <img src="" id="image-preview" alt="">
            
                     
                      </div>
                      <Label for="parent">parent or gardian contact:</Label>
                      <input type="number" name="p_number" placeholder="phone number">

                      <br>
                      <Label for="Matricule">Matricule:</Label>
                      <input type="text" name="Matricule" placeholder="Matricule">

                      <br>
                      <a href="mark_attendance.php"><button type="submit">add student</button></a>
                
             </div>

         </div>
     
     </div>
     </form>

<script src="add_student.js"></script>
</body>
</html>