<?php

session_start();
require '../includes/conn.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location:login.php");
    exit;
}

if (isset($_POST['btn-book'])) {

    $_SESSION['title'] = $_POST['title'];
    header("Location:client_bookpage.php");
    exit;

}

$method = $_POST['method'] ?? null;
$search = false;

if ($method == 'search') {
    $title = $_POST['title'];
    if (!empty($title)) {
        $sql = "SELECT * FROM `library`.`book_details` WHERE `title` LIKE '%$title%'";
        $search_res = $conn->query($sql);
        $search = true;
    } else {
        echo "<script>alert('Enter book title!'); window.location.href='admin_update_books.php';</script>";
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

    <form method="POST" id="search-bar" style="margin-top:50px">
        <input type="hidden" name="method" value="search">
        <input class="form-control" name="title" id="title" type="text" placeholder="Enter Book Title">
        <button class="btn btn-primary" type="submit"><img src="../images/Assets/magnifying-glass.png"
                style="height:20px;" alt="search"></button>
    </form>

    <?php

    if ($search) {

        if ($search_res && $search_res->num_rows > 0) {

            echo "<div class='category-section'>";
            echo "<h1 class='category-title'>Search Result</h1>";
            echo "<div class='slider'>";

            while ($row = $search_res->fetch_assoc()) {

                ?>

                <form class="card" method="POST">

                    <div class="imageWrapper">
                        <img class="bookImg" src="../images/Book_Images/<?php echo $row['image'] ?>" alt="Book Image">
                    </div>

                    <input type='hidden' name='title' value='<?php echo $row['title']; ?>'>

                    <h3 class="bookTitle"><?php echo $row['title'] ?></h3>
                    <p class="bookAuthor"><?php echo $row['author'] ?></p>
                    <button class="btn btn-dark" type="submit" name="btn-book">show details</button>

                </form>

                <?php

            }

            echo "</div>";
            echo "</div>";

        } else {

            echo "<div style='text-align: center; width: 100%; margin-top: 100px;'><h2>Oops! Nothing matched your search.</h2></div>";

        }

    } else {

        ?>

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
                        <div class="book-info">
                            <h3 class="bookTitle"><?php echo $row['title'] ?></h3>
                            <p class="bookAuthor"><?php echo $row['author'] ?></p>
                        </div>
                        <button class="btn btn-dark" type="submit" name="btn-book">Explore</button>

                    </form>

                <?php }
            }
            echo "</div>";
            echo "</div>";
        }
    }

    ?>

</body>

</html>