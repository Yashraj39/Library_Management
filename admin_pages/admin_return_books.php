<?php

require '../includes/admin_session.php';
require '../includes/conn.php';

$sql = "SELECT * FROM `library`.`student_id_password` WHERE `return_date` IS NOT NULL ORDER BY `return_date` ASC";
$res = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $username = $_POST['delete_username'];

    $get_title = "SELECT `book_issued` FROM `library`.`student_id_password` WHERE `username` = '$username'";
    $res_title = $conn->query($get_title);

    $clear_issue = "UPDATE `library`.`student_id_password` SET `book_issued` = NULL, `issue_date` = NULL, `return_date` = NULL WHERE `username` = '$username'";
    
    if ($conn->query($clear_issue) && $res_title->num_rows==1) {

        $row = $res_title->fetch_assoc();
        $title = $row['book_issued'];

        $stock_update = "UPDATE `library`.`book_details` SET `stock` = `stock` + 1  WHERE `title` = '$title'";
        $conn->query($stock_update);
        echo "<script>alert('Book returned successfully'); window.location.href='admin_return_books.php';</script>";
        exit;
    } else {
        echo "<script>alert('Error while returning book');</script>";
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
    <link rel="stylesheet" href="../styles/returnpage.css">
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
                        <a class="nav-link dropdown-toggle active" href="admin_add_books.php" id="booksDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">Issue/Return Book</a>
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

    <div class="container my-4" id="student-table">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Username</th>
                        <th>Book Issued</th>
                        <th>Issue Date</th>
                        <th>Return Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $res->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['book_issued']; ?></td>
                            <td><?php echo date('d-m-Y', strtotime($row['issue_date'])); ?></td>
                            <td><?php echo date('d-m-Y', strtotime($row['return_date'])); ?></td>
                            <td>
                                <form method="POST" action=""
                                    onsubmit="return confirm('Are you sure to return this book?');">
                                    <input type="hidden" name="delete_username" value="<?php echo $row['username']; ?>">
                                    <button type="submit" name="delete" class="btn btn-danger btn-sm">Return</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>