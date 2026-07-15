<?php
session_start();
require("connection.php");

if (isset($_SESSION['adminid'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['save'])) {
    $firstname  = $_POST['firstname'];
    $lastname   = $_POST['lastname'];
    $username   = $_POST['username'];
    $password   = $_POST['password']; // for now plain text
    $department = $_POST['department'];
    $year       = $_POST['year'];

    mysqli_query($conn, "INSERT INTO student 
        (firstname, lastname, username, password, department, year) 
        VALUES ('$firstname','$lastname','$username','$password','$department','$year')");

    header("Location: manage_students.php");
}
?>
 <link rel="stylesheet" href="style.css">

    <div class="nav">
    <a href="update_student.php">update Students</a>
    <a href="add_student.php">add students</a>
    <a href="logout.php">Logout</a>
</div>
<form method="post">
    First Name: <input type="text" name="firstname" required><br>
    Last Name: <input type="text" name="lastname" required><br>
    Username: <input type="text" name="username" required><br>
    Password: <input type="text" name="password" required><br>
    Department: <input type="text" name="department" required><br>
    Year: <input type="number" name="year" required><br>
    <button name="save">Save</button>
</form>
<footer class="footer">
    <p>&copy; 2025 Student Information Management System</p>
</footer>