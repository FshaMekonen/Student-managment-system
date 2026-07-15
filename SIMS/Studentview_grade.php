<?php
session_start();
require("connection.php");

if (!isset($_SESSION['studentid'])) {
    header("Location: login.html");
    exit();
}

$studentid = $_SESSION['studentid'];

// JOIN grades with course table to get coursename
$result = mysqli_query($conn, "
    SELECT g.*, c.coursename 
    FROM grades g
    JOIN courses c ON g.courseid = c.courseid
    WHERE g.studentid = '$studentid'
");
?>

<link rel="stylesheet" href="styl.css">
<div class="nav">
    <a href="Studentview_grade.php">view grade</a>
    <a href="register_course.php">register course</a>
    <a href="profile.php">profile</a>
    <a href="logout.php">Logout</a>
</div>

<table border="1" cellpadding="8">
<tr>
    <th>Course</th>
    <th>Assessment</th>
    <th>Quiz</th>
    <th>Final Exam</th>
    <th>Total (100)</th>
    <th>Grade</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?php echo $row['coursename']; ?></td>
    <td><?php echo $row['assessment']; ?></td>
    <td><?php echo $row['quiz']; ?></td>
    <td><?php echo $row['final_exam']; ?></td>
    <td><?php echo $row['total']; ?></td>
    <td><?php echo $row['grade']; ?></td>
</tr>
<footer class="footer">
    <p>&copy; 2025 Student Information Management System</p>
</footer>
<?php } ?>
</table>
