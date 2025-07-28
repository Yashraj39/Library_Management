<?php

require 'includes/conn.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `library`.`admin_login` WHERE `username`='$username' AND `password`='$password' ";
    $res = $conn->query($sql);

    if ($res && $res->num_rows === 1) {
        $_SESSION['admin_loggedin'] = true;
        echo "<script>alert('login successfull!');window.location.href='admin_pages/admin_home.php';</script>";
        exit;
    } else {
        echo "<script>alert(wrong username or password!');</script>";
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
            <h1>Admin Login</h1>
            <div class="input-box">
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" minlength="8" maxlength="8" required>
            </div>

            <div class="remember-me">
                <label><input id="check" type="checkbox" name="remember"> Remember me</label>
                <a id="pw" href="#">Forgot password?</a>
            </div>

            <button type="submit" class="submit">Login</button>

            <div class="register">
                <p>Login as student? <a id="reg" href="login.php">Login</a></p>
            </div>
        </form>
    </div>

</body>

</html>