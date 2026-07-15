<?php
session_start();
require("connection.php");

if (isset($_SESSION['adminid'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM student WHERE studentid=$id");
$row = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $firstname  = $_POST['firstname'];
    $lastname   = $_POST['lastname'];
    $username   = $_POST['username'];
    $department = $_POST['department'];
    $year       = $_POST['year'];

    mysqli_query($conn, "UPDATE student SET 
        firstname='$firstname',
        lastname='$lastname',
        username='$username',
        department='$department',
        year='$year'
        WHERE studentid=$id");

    header("Location: manage_students.php");
}
?>

<h2>Edit Student</h2>
<form method="post">
    First Name: <input type="text" name="firstname" value="<?= $row['firstname']; ?>"><br>
    Last Name: <input type="text" name="lastname" value="<?= $row['lastname']; ?>"><br>
    Username: <input type="text" name="username" value="<?= $row['username']; ?>"><br>
    Department: <input type="text" name="department" value="<?= $row['department']; ?>"><br>
    Year: <input type="number" name="year" value="<?= $row['year']; ?>"><br>
    <button name="update">Update</button>
</form>
