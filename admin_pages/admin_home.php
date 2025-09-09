<?php

require '../includes/admin_session.php';
require '../includes/conn.php';

$sql = "SELECT * FROM `library`.`student_id_password` ORDER BY `username` ASC";
$res = $conn->query($sql);

$method = $_POST['method'] ?? null;
$conformUpdate = false;
$conformDelete = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($method == "insert") {

        $username = $_POST['username'];
        $sid = (int) $_POST['sid'];

        if ($sid === 0 || empty($username)) {
            echo "<script>alert('Value cant be empty!'); window.location.href='admin_home.php';</script>";
            exit;
        }

        $sql = "INSERT INTO `library`.`student_id_password` (`sid`,`username`) VALUES ('$sid','$username')";
        if ($conn->query($sql)) {
            header("Location:admin_home.php");
            exit;
        }
    }

    $oldsid = $_SESSION['oldsid'] ?? null;

    if ($method == "update") {

        $sid = (int) $_POST['sid'];
        $_SESSION['oldsid'] = $sid;
        $sql = "SELECT * FROM `library`.`student_id_password` WHERE `sid` LIKE '%$sid%'";
        $res = $conn->query($sql);

        if ($res && $res->num_rows == 1) {
            $conformUpdate = true;
        } else {
            echo "<script>alert('SID not found!'); window.location.href='admin_home.php';</script>";
            exit;
        }
    }

    if ($method == "delete") {

        $sid = (int) $_POST['sid'];
        $_SESSION['oldsid'] = $sid;
        $sql = "SELECT * FROM `library`.`student_id_password` WHERE `sid`='$sid'";
        $res = $conn->query($sql);

        if ($res && $res->num_rows == 1) {
            $conformDelete = true;
        } else {
            echo "<script>alert('SID not found!'); window.location.href='admin_home.php';</script>";
            exit;
        }
    }

    if ($method == 'conformUpdate') {

        $sid = (int) $_POST['sid'];
        $username = $_POST['username'];
        if ($sid == 0 && empty($username)) {
            echo "<script>alert('Value cant be empty!'); window.location.href='admin_home.php';</script>";
            exit;
        } else if ($sid === 0) {
            $check = $conn->query("SELECT * FROM `library`.`student_id_password` WHERE `username`='$username' ");
            if ($check && $check->num_rows > 0) {
                echo "<script>alert('Username already exists!'); window.location.href='admin_home.php';</script>";
                exit;
            }
            $sql = "UPDATE `library`.`student_id_password` SET `username`='$username' WHERE `sid`='$oldsid' ";
        } else if (empty($username)) {
            $check = $conn->query("SELECT * FROM `library`.`student_id_password` WHERE `sid`='$sid'");
            if ($check && $check->num_rows > 0) {
                echo "<script>alert('SID already exists!'); window.location.href='admin_home.php';</script>";
                exit;
            }
            $sql = "UPDATE `library`.`student_id_password` SET `sid` = '$sid' WHERE `sid`='$oldsid' ";
        } else
            $sql = "UPDATE `library`.`student_id_password` SET `sid` = '$sid',`username`='$username' WHERE `sid`='$oldsid' ";
        $res = $conn->query($sql);
        header("Location:admin_home.php");
        exit;
    }

    if ($method == 'conformDelete') {

        $oldsid = $_SESSION['oldsid'] ?? null;

        if ($oldsid) {
            $sql = "DELETE FROM `library`.`student_id_password` WHERE `sid` = '$oldsid'";
            $conn->query($sql);
        }

        header("Location:admin_home.php");
        exit;
    }

    if ($method == 'search') {

        $sid = (int) $_POST['sid'];
        $username = $_POST['username'];
        $sql = null;

        if ($sid !== 0) {
            $sql = "SELECT * FROM `library`.`student_id_password` WHERE `sid` LIKE '%$sid%'";
        } else if (!empty($username)) {
            $sql = "SELECT * FROM `library`.`student_id_password` WHERE `username` LIKE '%$username%'";
        } else {
            echo "<script>alert('Enter username or SID!'); window.location.href='admin_home.php';</script>";
            exit;
        }

        $res = $conn->query($sql);

        if (!$res) {
            echo "<script>alert('Data not found!'); window.location.href='admin_home.php';</script>";
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
    <title>Admin Home</title>
    <link rel="stylesheet" href="../styles/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/home.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        form {
            display: none;
            flex-direction: column;
            gap: 10px;
        }
    </style>
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
                        <a class="nav-link active" href="admin_home.php">Student Data</a>
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
                        <a class="nav-link dropdown-toggle" href="admin_add_books.php" id="booksDropdown"
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

    <div class="space" style="height: 80px;"></div>

    <div class="container my-4">
        <div class="row g-2 justify-content-center">
            <div class="col-12 col-sm-6 col-md-3">
                <button class="btn btn-success w-100" onclick="insert()">Insert Data</button>
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

    <form method="POST" class="insert-form" id="insert-form">
        <h5>Insert Data</h5>
        <input type="hidden" name="method" value="insert">
        <input class="form-control" name="sid" type="text" placeholder="Enter SID:" minlength="8" maxlength="8" required>
        <input class="form-control" name="username" type="text" placeholder="Enter Username:" required>
        <button type="submit" class="btn btn-success">Insert</button>
    </form>

    <form method="POST" class="update-form" id="update-form">
        <h5>Update Data</h5>
        <input type="hidden" name="method" value="update">
        <input class="form-control" name="sid" type="text" placeholder="Enter SID of data to update :" minlength="8" maxlength="8" required>
        <button type="submit" class="btn btn-warning">Find</button>
    </form>

    <form method="POST" class="conformUpdate-form" id="conformUpdate-form">
        <h5>Conform Update Data</h5>
        <input type="hidden" name="method" value="conformUpdate">
        <input class="form-control" name="sid" type="text" placeholder="Enter New SID:" minlength="8" maxlength="8">
        <input class="form-control" name="username" type="text" placeholder="Enter New Username:">
        <button type="submit" class="btn btn-warning">Update</button>
    </form>

    <form method="POST" class="delete-form" id="delete-form">
        <h5>Delete Data</h5>
        <input type="hidden" name="method" value="delete">
        <input class="form-control" name="sid" type="text" placeholder="Enter SID of data to delete :" minlength="8" maxlength="8" required>
        <button type="submit" class="btn btn-danger">Find</button>
    </form>

    <form method="POST" class="conformDelete-form" id="conformDelete-form">
        <h5>Conform Delete Data</h5>
        <input type="hidden" name="method" value="conformDelete">
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>

    <form method="POST" class="search-form" id="search-form">
        <h5>Search</h5>
        <input type="hidden" name="method" value="search">
        <input class="form-control" name="sid" type="text" placeholder="Enter SID :">
        <input class="form-control" name="username" type="text" placeholder="Enter Username :">
        <button type="submit" class="btn btn-dark">Find</button>
    </form>

    <div class="container my-4" id="student-table">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>SID</th>
                        <th>Username</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $res->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['sid'] ?></td>
                            <td><?php echo $row['username'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <style>
        form {
            display: none;
            flex-direction: column;
            gap: 10px;
        }
    </style>

    <script>
        window.onload = function () {
            <?php if ($conformUpdate): ?>
                conformUpdate();
            <?php elseif ($conformDelete): ?>
                conformDelete();
            <?php endif; ?>
        };

        function insert() { toggleForm('insert-form'); }
        function update() { toggleForm('update-form'); }
        function Delete() { toggleForm('delete-form'); }
        function search() { toggleForm('search-form'); }
        function conformUpdate() { toggleForm('conformUpdate-form'); }
        function conformDelete() { toggleForm('conformDelete-form'); }

        function toggleForm(showId) {
            const forms = document.querySelectorAll('form');
            forms.forEach(f => f.style.display = 'none');
            document.getElementById(showId).style.display = 'flex';
        }
    </script>


</body>

</html>