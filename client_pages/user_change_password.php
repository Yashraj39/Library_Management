<?php

require '../includes/conn.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $old_password = md5($_POST['old-password']);
    $username =$_SESSION['username'];
    $get_old_pass = "SELECT * FROM `library`.`register` WHERE `password` = '$old_password' AND `username` ='$username' ";
    $res = $conn->query($get_old_pass);

    if ($res && $res->num_rows == 1) {

        $new_pass = md5($_POST['new-password']);
        $change_password = "UPDATE `library`.`register` SET `password` = '$new_pass' WHERE `password` = '$old_password' AND `username` ='$username'";

        if ($conn->query($change_password)) {
            echo "<script>alert('password updated');</script>";
        }

    } else {

        echo "<script>alert('wrong password!!');</script>";

    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/change_pass.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img class="logo" src="../images/Assets/logo.png" alt="logo" style="height: 40px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav d-flex justify-content-center w-100 gap-5">

                    <li class="nav-item">
                        <a class="nav-link active" href="home.php">Books</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="my_books.php">My Books</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About Us</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link" href="feedback.php">Feedback</a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link" role="button" data-bs-toggle="dropdown">
                            <img src="../images/Assets/settings_logo.png" alt="Settings" style="height: 24px;">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="client_logout.php">logout</a></li>
                            <li><a class="dropdown-item" href="user_change_password.php">change password</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <form method="POST" enctype="multipart/form-data" class="insert-form" id="insert-form">
        <h5>Change password</h5>
        <input class="form-control" name="old-password" type="text" placeholder="Old Password : " required>
        <input class="form-control" name="new-password" type="text" placeholder="New Password : " required>
        <button type="submit" class="btn btn-success">Change</button>
    </form>
</body>

</html>