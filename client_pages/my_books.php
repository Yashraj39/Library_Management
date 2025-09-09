<?php

session_start();
require '../includes/conn.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location:login.php");
    exit;
}

$username = $_SESSION['username'];
$book_issued = "SELECT * FROM `student_id_password` WHERE `username`='$username' ";
$res_book_issued = $conn->query($book_issued);

$issue_date;
$return_date;

if ($res_book_issued && $res_book_issued->num_rows == 1) {

    $get_book_data = $res_book_issued->fetch_assoc();
    $title = $get_book_data['book_issued'];
    $issue_date = $get_book_data['issue_date'];
    $return_date = $get_book_data['return_date'];

    $get_book_info = "SELECT * FROM `library`.`book_details` WHERE `title` = '$title' ";
    $res = $conn->query($get_book_info);

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
    <link rel="stylesheet" href="../styles/mybooks.css">
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
                        <a class="nav-link active" href="my_books.php">My Books</a>
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

    <div class="space" style="height:55px"></div>

    <div class="book-details">

        <div class="book-detail-container">

        <?php if(isset($res) && $res->num_rows>0): ?>

            <?php while ($row = $res->fetch_assoc()): ?>

                <div class="book-detail-card">
                    <div class="book-detail-img">
                        <img src="../images/Book_Images/<?php echo $row['image'] ?>" alt="Book Cover">
                    </div>
                    <div class="book-detail-info">
                        <h2><?php echo $row['title'] ?></h2>
                        <p><strong>Author : </strong><?php echo $row['author'] ?></p>
                        <p><strong>Description : </strong><?php echo $row['description'] ?></p>
                        <p><strong>Category : </strong><?php echo $row['category'] ?></p>
                        <p><strong>Issue Date : </strong><?php echo date('d-m-Y',strtotime($issue_date)) ?></p>
                        <p><strong>Return Date : </strong><?php echo date('d-m-Y',strtotime($return_date)) ?></p>
                    </div>
                </div>

            <?php endwhile; ?>

        <?php else: ?>

                <h2 style="text-align:center;">Book not borrowed yet!<br>Visit the library and borrow the Book.</h2>

        <?php endif; ?>

        </div>

    </div>
</body>

</html>