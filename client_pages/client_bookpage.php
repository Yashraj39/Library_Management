<?php
ob_start();
session_start();
require '../includes/conn.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location:login.php");
    exit;
}

$title = $_SESSION['title'];
$review_title = $_SESSION['title'];
$sql = "SELECT * FROM `library`.`book_details` WHERE `title`='$title' ";
$res_fetch_all = $conn->query($sql);

$name = $_SESSION['username'];
$my_review = "SELECT * FROM `library`.`review` WHERE `name` = '$name' AND `title`='$title'";
$res_my_review = $conn->query($my_review);

$method = $_POST['method'] ?? null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($method == "delete") {

        $delete = "DELETE FROM `library`.`review` WHERE `title`='$title' AND `name` = '$name' ";
        $deleted = $conn->query($delete);

        if ($deleted && $conn->affected_rows > 0) {
            echo "<script>alert('deleted');window.location.href='client_bookpage.php';</script>";
        } else {
            echo "<script>alert('error')</script>";
        }

    } else {

        if ($res_my_review && $res_my_review-> num_rows > 0) {
            $msg = "You've already added review on this book!";
        } else {
            $name = $_SESSION['username'];
            $review = $_POST['review'];
            $post_review = "INSERT INTO `library`.`review` VALUES ('$name','$review','$title') ";

            if ($conn->query($post_review)) {
                echo "<script>alert('review added');window.location.href='client_bookpage.php';</script>";
            } else {
                echo "<script>alert('Error occured!');</script>";
            }
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
    <link rel="stylesheet" href="../styles/home.css">
    <link rel="stylesheet" href="../styles/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/bookpage.css">
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

    <div class="space" style="height:55px"></div>

    <div class="book-details">

        <div class="book-detail-container">

            <?php while ($row = $res_fetch_all->fetch_assoc()): ?>

                <div class="book-detail-card">

                    <div class="show-info">
                        <div class="book-detail-img">
                            <img src="../images/Book_Images/<?php echo $row['image'] ?>" alt="Book Cover">
                        </div>
                        <div class="book-detail-info">
                            <h2><?php echo $row['title'] ?></h2>
                            <p><strong>Author : </strong><?php echo $row['author'] ?></p>
                            <p><strong>Description : </strong><?php echo $row['description'] ?></p>
                            <p><strong>Category : </strong><?php echo $row['category'] ?></p>
                            <p><strong>Stock : </strong><?php echo $row['stock'] ?></p>
                        </div>
                    </div>

                    <form method="POST">
                        <h5>Reviews</h5>
                        <textarea name="review" rows="4" class="form-control" placeholder="add your review here.."
                            id=""></textarea>
                        <div style="width:100%; display:flex ;justify-content: center; margin-top:20px;">
                            <button class="btn btn-primary" type="submit">submit</button>
                        </div>
                    </form>

                    <div class="reviews">

                        <?php if ($res_my_review && $res_my_review->num_rows > 0): ?>

                            <div class="my-review">

                                <div class="left">
                                    <?php
                                    while ($row = $res_my_review->fetch_assoc()):
                                        ?>

                                        <br>
                                        <h5><?php echo $row['name'] ?></h5>
                                        <p><?php echo $row['review'] ?></p>

                                        <?php
                                    endwhile;
                                    ?>
                                </div>

                                <form method="POST" class="right">
                                    <input type="hidden" name="method" value="delete">
                                    <button class="btn btn-delete" type="submit">
                                        <img class="delete-icon" src="../images/Assets/delete.png" alt="delete">
                                    </button>
                                </form>

                            </div>

                        <?php endif; ?>

                        <div>
                            <?php

                            $get_reviews = "SELECT * FROM `library`.`review` WHERE `title` = '$review_title' AND `name` != '$name'";
                            $res = $conn->query($get_reviews);
                            if ($res && $res->num_rows > 0) {

                                while ($row = $res->fetch_assoc()):

                                    ?>
                                    <div class="other-review">

                                    <br>
                                    <h5><?php echo $row['name'] ?></h5>
                                    <p><?php echo $row['review'] ?></p>

                                    </div>

                                    <?php
                                endwhile;
                            }
                            ?>
                        </div>
                    </div>

                </div>

            <?php endwhile; ?>

        </div>

    </div>

    <?php if (!empty($msg)): ?>
        <script>alert("<?php echo addslashes($msg); ?>");</script>
    <?php endif; ?>
</body>

</html>