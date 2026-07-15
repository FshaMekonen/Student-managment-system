<?php
session_start();
if (!isset($_SESSION['studentid'])) {
    header("Location: login.html");
    exit();
}
?>
 <link rel="stylesheet" href="styl.css">
<div class="nav">
    <a href="Studentview_grade.php">view grade</a>
    <a href="register_course.php">register course</a>
    <a href="profile.php">profile</a>
    <a href="logout.php">Logout</a>
</div>
<footer class="footer">
    <p>&copy; 2025 Student Information Management System</p>
</footer>