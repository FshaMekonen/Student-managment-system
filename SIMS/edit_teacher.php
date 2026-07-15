<?php
session_start();
require("connection.php");

if (isset($_SESSION['adminid'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM teacher WHERE teacherid=$id");
$row = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $firstname = $_POST['firstname'];
    $lastname  = $_POST['lastname'];
    $username  = $_POST['username'];
    $computing = $_POST['department'];

    mysqli_query($conn, "UPDATE teacher SET
        firstname='$firstname',
        lastname='$lastname',
        username='$username',
        department='$computing'
        WHERE teacherid=$id");

    header("Location: manage_teachers.php");
    exit();
}
?>

<h2>Edit Teacher</h2>
<form method="post">
    First Name: <input type="text" name="firstname" value="<?= $row['firstname']; ?>"><br>
    Last Name: <input type="text" name="lastname" value="<?= $row['lastname']; ?>"><br>
    Username: <input type="text" name="username" value="<?= $row['username']; ?>"><br>
    department: <input type="text" name="department" value="<?= $row['department']; ?>"><br>
    <button name="update">Update</button>
</form>
