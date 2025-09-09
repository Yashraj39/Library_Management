<?php

require '../includes/admin_session.php';
require '../includes/conn.php';

$title = $_SESSION['title'];
$sql = "SELECT * FROM `library`.`book_details` WHERE `title`='$title' ";
$res = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/home.css">
    <link rel="stylesheet" href="../styles/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/adminbookpage.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>

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
                        <a class="nav-link" href="admin_home.php">Student Data</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="admin_books.php">Show Books</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="admin_update_books" id="booksDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Manage Books
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="booksDropdown">
                            <li><a class="dropdown-item" href="admin_add_books.php">Add Books</a></li>
                            <li><a class="dropdown-item" href="admin_update_books.php">Book Tools</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="admin_add_books.php" id="booksDropdown" role="button"
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

    <div class="space" style="height:55px"></div>

    <div class="book-details">

        <div class="book-detail-container">

            <?php while ($row = $res->fetch_assoc()): ?>

                <div class="book-detail-card">
                    <div class="book-detail-img">
                        <img src="../images/Book_Images/<?php echo $row['image'] ?>" alt="Book Cover">
                    </div>
                    <div class="book-detail-info">
                        <h2><?php echo $row['title']  ?></h2>
                        <p><strong>Author : </strong><?php echo $row['author']  ?></p>
                        <p><strong>Description : </strong><?php echo $row['description']  ?></p>
                        <p><strong>Category : </strong><?php echo $row['category']  ?></p>
                        <p><strong>Stock : </strong><?php echo $row['stock']  ?></p>
                    </div>
                </div>

            <?php endwhile; ?>

        </div>

    </div>
</body>

</html>