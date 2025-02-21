<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>  
<body>
    <div class="login">

    <div class="container">

        <form action="loginn.php"method="post" >
            <label class="em" for="email">Email:</label>
            <input type="email" class="email" name="email" placeholder="example@gmail.com" required >
<br>

            <label for="password">Password:</label>
            <input type="password" class="password" name="password" placeholder="******" required>
<br>
           <a href="home.php"> <button type="submit" class="button">Login</button></a>

            <P>Don't have an account? <a class="register" href="register.php">register</a></P>

        </form>
        
    </div>
    </div>
    
</body>
</html>