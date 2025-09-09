<?php

require '../includes/admin_session.php';
require '../includes/conn.php';

if (isset($_POST['btn-book'])) {

    $_SESSION['title'] = $_POST['title'];
    header("Location:admin_bookpage.php");
    exit;

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
    <link rel="stylesheet" href="../styles/showBooks.css">
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

    <div class="space"></div>

    <?php

    $categories = ["Computer Science", "Short Stories", "Business Management", "Career Guidance", "Fantasy", "Public Speaking", "Travel & Tourism"];

    foreach ($categories as $category) {

        $sql = "SELECT * FROM `library`.`book_details` WHERE category='$category' ";
        $res = $conn->query($sql);

        if ($res && $res->num_rows > 0) {

            echo "<div class='category-section'>";
            echo "<h1 class='category-title'>$category</h1>";
            echo "<div class='slider'>";


            while ($row = $res->fetch_assoc()) {

                ?>

                <form class="card" method="POST">

                    <div class="imageWrapper">
                        <img class="bookImg" src="../images/Book_Images/<?php echo $row['image'] ?>" alt="Book Image">
                    </div>

                    <input type='hidden' name='title' value='<?php echo $row['title']; ?>'>

                    <h3 class="bookTitle"><?php echo $row['title'] ?></h3>
                    <p class="bookAuthor"><?php echo $row['author'] ?></p>
                    <button class="btn btn-dark" type="submit" name="btn-book">Explore</button>

                </form>

            <?php }
        }
        echo "</div>";
        echo "</div>";
    } ?>

</body>

</html>