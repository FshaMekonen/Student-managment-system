<?php
session_start();
if (!isset($_SESSION['headid'])) {
    header("Location: login.php");
    exit();
}
$dept = $_SESSION['department'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>HOD Dashboard</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>

<div class="nav">
    <a href="approve_grade.php">Approve Grades</a>
    <a href="view_courses.php">View Courses</a>
    <a href="logout.php">Logout</a>
</div>
</body>
</html>
