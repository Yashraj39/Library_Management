<?php

require '../includes/admin_session.php';
require '../includes/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['title'];

    $file_name = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $folder = '../images/Book_Images/' . $file_name;

    $author = $_POST['author'];
    $category = $_POST['category'];
    $stock = $_POST['stock'];
    $description = $_POST['description'];

    $book_insert = "INSERT INTO `library`.`book_details` VALUES ('$title','$file_name','$author','$category','$stock','$description')";

    if (move_uploaded_file($tempname, $folder)) {
        if ($conn->query($book_insert)) {
            echo "<script>alert('inserted')</script>";
        } else {
            echo "<script>alert('data insertion failed')</script>";
        }
    } else {
        echo "<script>alert('image upload failed')</script>";
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
    <link rel="stylesheet" href="../styles/addBooks.css">
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
                        <a class="nav-link" href="admin_home.php">Student Data</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="admin_books.php">Show Books</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="admin_add_books.php" id="booksDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
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

    <div class="add-book-form">
        <form method="POST" enctype="multipart/form-data" class="insert-form" id="insert-form">
            <h5>Insert Book Data</h5>
            <input class="form-control" name="title" type="text" placeholder="Title : " required>
            <input class="form-control" name="image" type="file" placeholder="Image : " required>
            <input class="form-control" name="author" type="text" placeholder="Author Name : " required>
            <select class="form-select" name="category" required>
                <option value="Computer Science">Computer Science</option>
                <option value="Short Stories">Short Stories</option>
                <option value="Business Management">Business Management</option>
                <option value="Career Guidance">Career Guidance</option>
                <option value="Fantasy">Fantasy</option>
                <option value="Public Speaking">Public Speaking</option>
                <option value="Travel & Tourism">Travel & Tourism</option>
            </select>
            <input class="form-control" name="stock" type="text" placeholder="Stock : " required>
            <textarea class="form-control" name="description" rows="4" placeholder="Discription : "></textarea>
            <button type="submit" class="btn btn-success">Insert</button>
        </form>
    </div>

</body>

</html>