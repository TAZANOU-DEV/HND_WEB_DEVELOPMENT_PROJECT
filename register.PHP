<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <title>Register</title>
</head>
<body>
    <div class="hg">
      <div class="container">

       <form  method="post" action="regidter.php">
         <label for="school_name">school name:</label>
         <input type="text" class="name" name="name" placeholder="Hitbamas">
         <br>
         <label for="email">email:</label>
         <input type="email" class="email" name="email" placeholder="Hitbamas@gmail.com">
         <br>
         <label for="password">password:</label>
         <input type="password" class="password" id="pass" name="password" placeholder="********">
         <br>
         <label for="confirm_password">confirm_password:</label>
         <input type="password" class="c_password"  id="c_pass" name="c_password" placeholder="********">
         <br>
         <a href="home.php"><button type="submit" onclick="regist()" class="register">Register</button></a>
         <p>Already have an account? <a href="login.php">login</a></p>



       </form>

      </div>
    </div>


<script>


function regist(){
    let ps = document.getElementById('pass');
    let cps = document.getElementById('c_pass');

    if(ps !== cps ){
        alert("password do not match");
         event.preventDefault();
        return false;
    }
    else{ 
        return true;
    }
    
}
</script>
</body>
</html>