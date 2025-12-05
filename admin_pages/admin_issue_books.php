<?php

require '../includes/admin_session.php';
require '../includes/conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = $_POST['title'];
    $username = $_POST['username'];
    $issue_date = date('Y-m-d');
    $return_date = date('Y-m-d', strtotime($issue_date . ' +30 days'));

    $get_book = "SELECT * FROM `library`.`book_details` WHERE `title`='$title'";
    $res_get_book = $conn->query($get_book);

    if ($res_get_book && $res_get_book->num_rows == 1) {

        $row = $res_get_book->fetch_assoc();
        $stock = (int) $row['stock'] - 1;

        if ($stock <= 0) {
            echo "<script>alert('Not in stock');window.location.href='admin_issue_books.php';</script>";
            exit;
        }

        $get_user = "SELECT * FROM `student_id_password` WHERE `username` = '$username'";
        $res_get_user = $conn->query($get_user);

        if ($res_get_user && $res_get_user->num_rows == 1) {

            $row = $res_get_user->fetch_assoc();

            if ($row['book_issued'] != null) {
                echo "<script>alert('Already issued');window.location.href='admin_issue_books.php';</script>";
                exit;
            }

            $set_stock = "UPDATE `library`.`book_details` SET `stock` = '$stock' WHERE `title`='$title' ";
            $issue_book = "UPDATE `library`.`student_id_password` SET `book_issued` = '$title',`issue_date` = '$issue_date',`return_date`='$return_date' WHERE `username`='$username' ";
            $conn->query($set_stock);
            $conn->query($issue_book);

            echo "<script>alert('Book Assigned');window.location.href='admin_issue_books.php';</script>";
            exit;

        } else {

            echo "<script>alert('User not found');window.location.href='admin_issue_books.php';</script>";
            exit;

        }

    } else {

        echo "<script>alert('Book not found');window.location.href='admin_issue_books.php';</script>";
        exit;

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
    <link rel="stylesheet" href="../styles/issuepage.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img class="logo" src="../images/Assets/logo.png" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav d-flex justify-content-center w-100 gap-5">
                    <li class="nav-item">
                        <a class="nav-link" href="admin_home.php">Student Data</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="admin_books.php">Show Books</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="admin_add_books.php" id="booksDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Manage Books
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="admin_add_books.php">Add Books</a></li>
                            <li><a class="dropdown-item" href="admin_update_books.php">Book Tools</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="admin_add_books.php" id="booksDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Issue/Return Book</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="admin_issue_books.php">Issue Book</a></li>
                            <li><a class="dropdown-item" href="admin_return_books.php">Return Book</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link" role="button" data-bs-toggle="dropdown">
                            <img src="../images/Assets/settings_logo.png" alt="Settings" style="height: 24px;">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="admin_logout.php">logout</a></li>
                            <li><a class="dropdown-item" href="admin_change_password.php">change password</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="space"></div>

    <div class="add-book-form">
        <form method="POST" class="assign-form" id="assign-form">
            <h5>Assign Book</h5>
            <input class="form-control" name="username" type="text" placeholder="Student Name : " required>
            <input class="form-control" name="title" type="text" placeholder="Book Title : " required>
            <button type="submit" class="btn btn-success">assign</button>
        </form>
    </div>

</body>

</html>