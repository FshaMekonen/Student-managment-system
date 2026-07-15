<?php
session_start();
require("connection.php");

// Check if student is logged in
if (!isset($_SESSION['studentid'])) {
    header("Location: login.php");
    exit();
}

$studentid = $_SESSION['studentid'];

// Fetch student info from database
$sql = "SELECT * FROM student WHERE studentid = '$studentid'";
$result = mysqli_query($conn, $sql);
$student = mysqli_fetch_assoc($result);
?>
<div class="center-link">
    <a href="update_profile.php">Update profile</a>
</div>

<!DOCTYPE html>
<html>
<head>
    <title>Student Profile</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
 
<div class="nav">
 <a href="Studentview_grade.php">view grade</a>
    <a href="register_course.php">register course</a>
    <a href="profile.php">profile</a>
    <a href="logout.php">Logout</a>
</div>

<div class="section">
    <h2></h2>

    <div class="card">
        <p><strong>Student ID:</strong> <?php echo $student['studentid']; ?></p>
        <p><strong>First Name:</strong> <?php echo $student['firstname']; ?></p>
        <p><strong>Last Name:</strong> <?php echo $student['lastname']; ?></p>
        <p><strong>Username:</strong> <?php echo $student['username']; ?></p>
        <p><strong>Department:</strong> <?php echo $student['department']; ?></p>
        <p><strong>Year:</strong> <?php echo $student['year']; ?></p>
    </div>
</div>

<footer class="footer">
    <p>&copy; 2025 Student Information Management System</p>
</footer>

</body>
</html>
