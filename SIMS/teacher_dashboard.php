<?php
session_start();
if (!isset($_SESSION['teacherid'])) {
    header("Location: login.html");
    exit();
}
?>
 <link rel="stylesheet" href="styl.css">
<div class="nav">
<div class="nav">
    <a href="entry_grade.php">Entry Grade</a>
    <a href="pending_grades.php">Pending Grades</a>
    <a href="logout.php">Logout</a>
</div>
<footer class="footer">
    <p>&copy; 2025 Student Information Management System</p>
</footer>