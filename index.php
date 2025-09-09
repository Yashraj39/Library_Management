<?php

require 'includes/conn.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = $_POST['username'];
    $sid = $_POST['sid'];

    $alreadyExists = "SELECT `sid` FROM `library`.`register` WHERE  `sid`='$sid' ";
    $checkUser = "SELECT `sid`,`username` FROM `library`.`student_id_password` WHERE `sid`='$sid' AND `username`='$username' ";
    $checkeExistance = $conn->query($alreadyExists);
    $checkedUser = $conn->query($checkUser);

    if ($checkeExistance && $checkeExistance->num_rows === 1) {
        echo "<script>alert('user already exists');</script>";
    } else {
        $password = md5($_POST['password']);
        $confirmPassword = md5($_POST['confirm-password']);

        if ($password != $confirmPassword) {
            echo "<script>alert('password did not matched');</script>";
        } else if ($checkedUser && $checkedUser->num_rows === 1) {
            $sql = "INSERT INTO `register`(`username`, `sid`, `password`) VALUES ('$username','$sid','$password')";
            if ($conn->query($sql)) {
                echo "<script>alert('Registered successfully'); window.location.href='login.php';</script>";
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "<script>alert('User not found!!')</script>";
        }
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <form id="registerform" method="POST">
            <h1>Regsiter</h1>
            <div class="input-box">
                <input type="text" name="username" placeholder="Username" required>
                <small class="msg">Enter fisrt and middle name exactly as on your college ID card (e.g. Desai
                    Manan)</small>
            </div>
            <div class="input-box">
                <input type="text" name="sid" placeholder="Sid" minlength="8" maxlength="8" required>
                <small class="msg">Enter as 2025 + your roll number (e.g. 301 → 20250301)</small>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" minlength="6" maxlength="6" required>
            </div>
            <div class="input-box">
                <input type="password" name="confirm-password" placeholder="Confirm password" minlength="6"
                    maxlength="6" required>
            </div>

            <button type="submit" class="submit">Register</button>

            <div class="register">
                <p>Already have an account? <a id="reg" href="login.php">Login</a></p>
            </div>
        </form>
    </div>
</body>

</html>