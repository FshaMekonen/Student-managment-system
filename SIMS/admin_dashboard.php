<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.html");
    exit();
}
?>
<html>
    <head>
         <link rel="stylesheet" href="styl.css">
    </head>
    <body>
  <div class="nav">
    <a href="manager_view_students.php">All Students</a>
    <a href="manager_view_teachers.php">All Teachers</a>
    <a href="manager_view_all_grades.php"> All Grades</a>
    <a href="logout.php">Logout</a>
</div>
</body>
</html>
