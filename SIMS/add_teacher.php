<?php
session_start();
require("connection.php");

if (isset($_SESSION['adminid'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['save'])) {
    $firstname = $_POST['firstname'];
    $lastname  = $_POST['lastname'];
    $username  = $_POST['username'];
    $password  = $_POST['password']; // plain text (can secure later)
    $computing = $_POST['computing'];

    mysqli_query($conn, "INSERT INTO teacher 
        (firstname, lastname, username, password, computing)
        VALUES ('$firstname','$lastname','$username','$password','$computing')");

    header("Location: manage_teachers.php");
    exit();
}
?>
<form method="post">
    First Name: <input type="text" name="firstname" required><br>
    Last Name: <input type="text" name="lastname" required><br>
    Username: <input type="text" name="username" required><br>
    Password: <input type="text" name="password" required><br>
    Computing: <input type="text" name="computing" required><br>
    <button name="save">Save</button>
</form>
    <link rel="stylesheet" href="style.css">
    <div class="nav">
    <a href="update_teacher.php">update teachers</a>
    <a href="add_teacher.php">add teachers</a>
    <a href="logout.php">Logout</a>
</div>