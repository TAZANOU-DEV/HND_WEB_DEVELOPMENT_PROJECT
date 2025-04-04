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

    <form action="home.php" method="post">
    <label class="em" for="email">Email:</label>
    <input type="email" class="email" name="email" placeholder="example@gmail.com" required>
    <br>

    <label for="password">Password:</label>
    <input type="password" class="password" name="password" placeholder="******" required>
    <br>

    <button type="submit" class="button">Login</button>
</form>

<p>Don't have an account? <a class="register" href="register.php">Register</a></p>

    </div>
    </div>
    
</body>
</html>