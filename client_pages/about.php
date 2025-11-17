<?php
session_start();
require '../includes/conn.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location:login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>About Us - College Library</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/about.css">
    <link rel="stylesheet" href="../styles/home.css">
    <link rel="stylesheet" href="../styles/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
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
                        <a class="nav-link active" href="about.php">About Us</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link" href="feedback.php">Feedback</a>
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
                            <li><a class="dropdown-item" href="user_change_password.php">change password</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <div class="space"></div>

    <div class="container-fluid">

        <div class="info">

            <img class="boy" src="../images/Assets/boy.png" alt="">

            <div>
                <h2>What We Offer</h2>
                <ul>
                    <li>Thousands of books covering Computer Science, Engineering, Literature, and more.</li>
                    <li>Easy book issue/return tracking through our online system.</li>
                    <li>Category-wise search and detailed descriptions.</li>
                    <li>Student-friendly interface with secure login and registration.</li>
                </ul>
            </div>

        </div>

        <div class="our-vision">
            <h2>Our Vision</h2>
            <ul>
                <li>We aim to become a knowledge hub that supports creativity, research, and lifelong learning through
                    technology-driven services.</li>
                <li>
                    Through continuous improvement and integration of modern tools, we strive to bridge the gap between
                    traditional libraries and digital education. We envision a future where our library becomes the
                    cornerstone
                    of academic excellence and personal growth for every student.
                </li>
            </ul>
        </div>

        <div class="contact">

            <div>
                <h2>Contact</h2>
                <p><strong>Email:</strong> bca_amroli@rediffmail.com</p>
                <p><strong>Phone:</strong> 0261 - 2495643</p>
                <p><strong>Address:</strong> PROF. VB.SHAH Sutex Bank College of Computer Applications & Science, Amroli
                    , Surat, Gujarat, India</p>
            </div>

            <img class="boy" id="boy2" src="../images/Assets/boy2.png" alt="">



        </div>

    </div>

    <footer style="background-color: #448fffff; padding: 20px; text-align: center; margin-top: 50px;">
        <p>&copy; <?php echo date("Y"); ?> College Library. All rights reserved.</p>
        <p>Developed by BCA Students with ❤️ and Code.</p>
    </footer>

</body>

</html>