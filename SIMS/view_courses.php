<?php
session_start();
require("connection.php");

if (!isset($_SESSION['headid'])) {
    header("Location: login.php");
    exit();
}

// Fetch all courses with assigned teacher (if any)
$sql = "SELECT c.courseid, c.coursename, c.year, c.semester, c.credithour,
               t.firstname AS teacher_first, t.lastname AS teacher_last
        FROM courses c
        LEFT JOIN teacher_course tc ON c.courseid = tc.courseid
        LEFT JOIN teacher t ON tc.teacherid = t.teacherid
        ORDER BY c.courseid DESC";

$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
?>
<link rel="stylesheet" href="styl.css">
<div class="nav">
    <a href="approve_grade.php">Approve Grades</a>
    <a href="view_courses.php">View Courses</a>
    <a href="logout.php">Logout</a>
</div>
<table border="1">
<tr>
    <th>Course ID</th>
    <th>Course Name</th>
    <th>Year</th>
    <th>Semester</th>
    <th>Credit Hour</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?= $row['courseid'] ?></td>
    <td><?= htmlspecialchars($row['coursename']) ?></td>
    <td><?= $row['year'] ?></td>
    <td><?= $row['semester'] ?></td>
    <td><?= $row['credithour'] ?></td>
   
<footer class="footer">
    <p>&copy; 2025 Student Information Management System</p>
</footer>
<?php } ?>
</table>
