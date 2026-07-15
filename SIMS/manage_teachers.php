<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.html");
    exit();
}
?>
<html>
    <head>
         <link rel="stylesheet" href="style.css">
    </head>
    <body>

    <div class="nav">
    <a href="update_teacher.php">update teachers</a>
    <a href="add_teacher.php">add teachers</a>
    <a href="logout.php">Logout</a>
</div>
<footer class="footer">
    <p>&copy; 2025 Student Information Management System</p>
</footer>
</body>
</html>
