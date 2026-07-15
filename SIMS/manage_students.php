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
        <a href="view_all_grades.php">View Grades</a>
    <a href="update_student.php">update Students</a>
    <a href="add_student.php">add students</a>
    <a href="logout.php">Logout</a>
</div>
<footer class="footer">
    <p>&copy; 2025 Student Information Management System</p>
</footer>
</body>
</html>
