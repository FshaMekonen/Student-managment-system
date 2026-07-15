<?php
session_start();
require("connection.php");

if (!isset($_SESSION['studentid'])) {
    header("Location: login.php");
    exit();
}

$studentid = $_SESSION['studentid'];
$success = "";
$error = "";

// Handle course registration
if (isset($_POST['register'])) {
    $courses = $_POST['courses'] ?? [];

    foreach ($courses as $courseid) {
        // Check if already registered
        $check = mysqli_query($conn, "SELECT * FROM student_courses WHERE studentid=$studentid AND courseid=$courseid");
        if (mysqli_num_rows($check) == 0) {
            mysqli_query($conn, "INSERT INTO student_courses (studentid, courseid) VALUES ($studentid, $courseid)");
        }
    }

    $success = "Courses registered successfully!";
}

// Load courses by year and semester
$year = $_POST['year'] ?? 2;
$semester = $_POST['semester'] ?? 1;

$result = mysqli_query($conn, "SELECT * FROM courses WHERE year=$year AND semester=$semester");
?>

<!DOCTYPE html>
<html>
<head>
    
    <title>Register course</title>
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

    <?php if ($success) echo "$success"; ?>
    <?php if ($error) echo "$error"; ?>

    <form method="POST">
        <label>Year:</label>
        <select name="year" onchange="this.form.submit()">
            <option value="2" <?php if($year==2) echo 'selected'; ?>>2nd Year</option>
            <option value="3" <?php if($year==3) echo 'selected'; ?>>3rd Year</option>
        </select>

        <label>Semester:</label>
        <select name="semester" onchange="this.form.submit()">
            <option value="1" <?php if($semester==1) echo 'selected'; ?>>Semester 1</option>
            <option value="2" <?php if($semester==2) echo 'selected'; ?>>Semester 2</option>
        </select>

        <h3>Available Courses:</h3>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <input type="checkbox" name="courses[]" value="<?php echo $row['courseid']; ?>">
            <?php echo $row['coursename']; ?><br>
        <?php endwhile; ?>

        <br>
        <button type="submit" name="register">Register Selected Courses</button>
    </form>
</div>

<footer class="footer">
    <p>&copy; 2025 Student Information Management System</p>
</footer>

</body>
</html>
