<?php 

    require 'includes/conn.php';
    session_start();

    if($_SERVER['REQUEST_METHOD']==="POST"){

        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql = "SELECT * FROM `library`.`register` WHERE `username`='$username' AND `password`='$password' ";
        $res = $conn->query($sql);

        if($res && $res->num_rows==1){
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            echo "<script>alert('login successfull'); window.location.href='client_pages/home.php'</script>";
        } else {
            echo "<script>alert('login failed');</script>";
        }

    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>

    <div class="wrapper">
        <form id="loginform" method="POST">
            <h1>Student Login</h1>
            <div class="input-box">
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" minlength="6" maxlength="6" required>
            </div>

            <div class="remember-me">
                <label><input id="check" type="checkbox" name="remember"> Remember me</label>
                <a id="pw" href="#">Forgot password?</a>
            </div>
            
            <button type="submit" class="submit">Login</button>

            <div class="register">
                <p>Don't have an account? <a id="reg" href="index.php">Register</a></p>
            </div>               
        </form>
    </div>
    
</body>
</html>
