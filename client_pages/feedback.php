<?php

session_start();
require '../includes/conn.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location:login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD']=='POST') {



}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/home.css">
    <link rel="stylesheet" href="../styles/feedback.css">
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
                        <a class="nav-link" href="home.php">Books</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="my_books.php">My Books</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About Us</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link active" href="feedback.php">Feedback</a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown" style="display:flex;color:white;white-space:nowrap;">
                        <ul style="display:flex;justify-content:center;align-items:center;padding-right:10px;">
                            <?php echo $_SESSION['username'] ?>
                        </ul>
                        <a class="nav-link" role="button" data-bs-toggle="dropdown">
                            <img src="../images/Assets/settings_logo.png" alt="Settings" style="height: 24px;">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="client_logout.php">logout</a></li>
                            <li><a class="dropdown-item" href="admin_change_password.php">change password</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <div style="height:55px"></div>

    <div class="feedback-form">
        <div class="feedimg">
            <img src="../images/Assets/feedback.jpg">
        </div>
        <div style="width:100%;">
            <form method="POST">
                <input class="form-control" placeholder="Email" require>
                <input class="form-control" placeholder="Contact" minlength="10" maxlength="10" require>
                <textarea rows="5" class="form-control" placeholder="Write your thoughts here..." require></textarea>
                <button class="btn btn-primary" type="submit" onclick="alert('Feedback submitted successfully!')">Submit</button>
            </form>
        </div>
    </div>
</body>

</html>