<?php

require '../includes/admin_session.php';
require '../includes/conn.php';

$sql = "SELECT * FROM `library`.`book_details` ORDER BY `title` ASC";
$res = $conn->query($sql);

$method = $_POST['method'] ?? null;
$conformUpdate = false;
$conformDelete = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $oldtitle = $_SESSION['oldtitle'] ?? null;

    if ($method == "update") {
        $title = $_POST['title'];
        $sql = "SELECT * FROM `library`.`book_details` WHERE `title` LIKE '%$title%'";
        $res = $conn->query($sql);
        $row = $res->fetch_assoc();
        $_SESSION['oldtitle'] = $row['title'];
        $res->data_seek(0);

        if ($res && $res->num_rows == 1) {
            $conformUpdate = true;
        } else if ($res && $res->num_rows>0) {
            echo "<script>alert('Multiple book found!'); window.location.href='admin_update_books.php';</script>";
            exit;
        } else {
            echo "<script>alert('Book not found!'); window.location.href='admin_update_books.php';</script>";
            exit;
        }
    }

    if ($method == "delete") {
        $title = $_POST['title'];
        $sql = "SELECT * FROM `library`.`book_details` WHERE `title` LIKE '%$title%'";
        $res = $conn->query($sql);
        $row = $res->fetch_assoc();
        $_SESSION['oldtitle'] = $row['title'];
        $res->data_seek(0);

        if ($res && $res->num_rows == 1) {
            $conformDelete = true;
        } else if ($res && $res->num_rows>0) {
            echo "<script>alert('Multiple book found!'); window.location.href='admin_update_books.php';</script>";
            exit;
        } else {
            echo "<script>alert('Book not found!'); window.location.href='admin_update_books.php';</script>";
            exit;
        }
    }

    if ($method == 'conformUpdate') {
        $title = $_POST['title'];

        $file_name = $_FILES['image']['name'];
        $tempname = $_FILES['image']['tmp_name'];
        $folder = '../images/Book_Images/' . $file_name;

        $author = $_POST['author'];
        $description = $_POST['description'];
        $category = $_POST['category'];
        $stock = (int) $_POST['stock'];

        $get_old = "SELECT * FROM `library`.`book_details` WHERE title='$oldtitle' ";
        $res = $conn->query($get_old);
        $row = $res->fetch_assoc();

        if ($title == "")
            $title = $row['title'];
        if ($author == "")
            $author = $row['author'];
        if ($description == "")
            $description = $row['description'];
        if ($category == "")
            $category = $row['category'];
        if ($stock === 0)
            $stock = (int) $row['stock'];

        if ($file_name != "") {

            if (move_uploaded_file($tempname, $folder)) {
                $book_update = "UPDATE `library`.`book_details` SET title='$title', author='$author', description='$description', category='$category', stock=$stock, image='$file_name' WHERE title='$oldtitle'";
                if ($conn->query($book_update)) {
                    echo "<script>alert('inserted')</script>";
                } else {
                    echo "<script>alert('data insertion failed')</script>";
                }
            } else {
                echo "<script>alert('image upload failed')</script>";
            }

        } else {

            $book_update = "UPDATE `library`.`book_details` SET title='$title', author='$author', description='$description', category='$category', stock=$stock WHERE title='$oldtitle'";
            if ($conn->query($book_update)) {
                echo "<script>alert('inserted')</script>";
            } else {
                echo "<script>alert('data insertion failed')</script>";
            }

        }

        header("Location:admin_update_books.php");
        exit;
    }

    if ($method == 'conformDelete') {
        $oldtitle = $_SESSION['oldtitle'] ?? null;

        if ($oldtitle) {

            $image = "SELECT * FROM `library`.`book_details` WHERE title='$oldtitle' ";
            $res = $conn->query($image);
            $row = $res->fetch_assoc();

            $old_iamge_path = "../images/Book_Images/" . $row['image'];

            if (file_exists($old_iamge_path)) {
                unlink($old_iamge_path);
            }

            $sql = "DELETE FROM `library`.`book_details` WHERE `title` = '$oldtitle'";
            $conn->query($sql);
        }
        header("Location:admin_update_books.php");
        exit;
    }

    if ($method == 'search') {
        $title = $_POST['title'];
        $sql = null;

        if (!empty($title)) {
            $sql = "SELECT * FROM `library`.`book_details` WHERE `title` LIKE '%$title%'";
        } else {
            echo "<script>alert('Enter book title!'); window.location.href='admin_update_books.php';</script>";
            exit;
        }

        $res = $conn->query($sql);

        if (!$res) {
            echo "<script>alert('Book not found!'); window.location.href='admin_update_books.php';</script>";
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Book Details</title>
    <link rel="stylesheet" href="../styles/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/home.css">
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
                        <a class="nav-link dropdown-toggle active" href="admin_update_books" id="booksDropdown"
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

    <div class="space" style="height: 80px;"></div>

    <div class="action-buttons container my-4">
        <div class="row g-2 justify-content-center">
            <div class="col-12 col-sm-6 col-md-3">
                <button class="btn btn-success w-100" onclick=" window.location.href='admin_update_books.php' ">Show
                    Book</button>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <button class="btn btn-warning w-100" onclick="update()">Update</button>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <button class="btn btn-danger w-100" onclick="Delete()">Delete</button>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <button class="btn btn-dark w-100" onclick="search()">Search</button>
            </div>
        </div>
    </div>

    <form method="POST" class="update-form" id="update-form">
        <h5>Update Book</h5>
        <input type="hidden" name="method" value="update">
        <input class="form-control" name="title" type="text" placeholder="Enter Title to Update">
        <button type="submit" class="btn btn-warning">Find</button>
    </form>

    <form method="POST" enctype="multipart/form-data" class="conformUpdate-form" id="conformUpdate-form">
        <h5>Confirm Update</h5>
        <input type="hidden" name="method" value="conformUpdate">
        <input class="form-control" name="title" type="text" placeholder="Enter New Title">
        <input class="form-control" name="author" type="text" placeholder="Enter New Author">
        <input class="form-control" name="description" type="text" placeholder="Enter New Description">
        <select class="form-select" name="category">
            <option disabled selected value="">--Select Value--</option>
            <option value="Computer Science">Computer Science</option>
            <option value="Short Stories">Short Stories</option>
            <option value="Business Management">Business Management</option>
            <option value="Career Guidance">Career Guidance</option>
            <option value="Fantasy">Fantasy</option>
            <option value="Public Speaking">Public Speaking</option>
            <option value="Travel & Tourism">Travel & Tourism</option>
        </select>
        <input class="form-control" name="stock" type="number" placeholder="Enter New Stock">
        <input class="form-control" name="image" type="file" placeholder="Enter New Image Filename">
        <button type="submit" class="btn btn-warning">Update</button>
    </form>

    <form method="POST" class="delete-form" id="delete-form">
        <h5>Delete Book</h5>
        <input type="hidden" name="method" value="delete">
        <input class="form-control" name="title" type="text" placeholder="Enter Title to Delete">
        <button type="submit" class="btn btn-danger">Find</button>
    </form>

    <form method="POST" class="conformDelete-form" id="conformDelete-form">
        <h5>Confirm Delete</h5>
        <input type="hidden" name="method" value="conformDelete">
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>

    <form method="POST" class="search-form" id="search-form">
        <h5>Search Book</h5>
        <input type="hidden" name="method" value="search">
        <input class="form-control" name="title" type="text" placeholder="Enter Book Title">
        <input class="form-control" name="author" type="text" placeholder="Enter Author">
        <button type="submit" class="btn btn-dark">Find</button>
    </form>

    <div class="container mb-5">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Stock</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $res->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['title']; ?></td>
                            <td><?php echo $row['author']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td><?php echo $row['category']; ?></td>
                            <td><?php echo (int) $row['stock']; ?></td>
                            <td>
                                <img src="../images/Book_Images/<?php echo htmlspecialchars($row['image']); ?>"
                                    alt="Book Image" style="height: 60px; object-fit: contain;">
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        window.onload = function () {
            <?php if ($conformUpdate): ?>
                conformUpdate();
            <?php elseif ($conformDelete): ?>
                conformDelete();
            <?php endif; ?>
        };
    </script>

</body>

<script>
    function update() {
        toggleForm('update-form');
    }
    function Delete() {
        toggleForm('delete-form');
    }
    function search() {
        toggleForm('search-form');
    }
    function conformUpdate() {
        toggleForm('conformUpdate-form');
    }
    function conformDelete() {
        toggleForm('conformDelete-form');
    }
    function toggleForm(showId) {
        const forms = document.querySelectorAll('form');
        forms.forEach(f => f.style.display = 'none');
        document.getElementById(showId).style.display = 'flex';
    }
</script>

</html>