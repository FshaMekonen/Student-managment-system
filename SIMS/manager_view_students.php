<?php
session_start();
require("connection.php");

// Check if manager is logged in
if (isset($_SESSION['managerid'])) {
    header("Location: login.html");
    exit();
}

// Fetch all students
$students = mysqli_query($conn, "SELECT * FROM student ORDER BY studentid DESC");
?>

<link rel="stylesheet" href="styl.css">
 <div class="nav">
    <a href="manager_view_students.php">All Students</a>
    <a href="manager_view_teachers.php">All Teachers</a>
    <a href="manager_view_all_grades.php"> All Grades</a>
    <a href="logout.php">Logout</a>
</div>
<table border="1" width="100%">
<tr>
    <th>Student ID</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Username</th>
    <th>Department</th>
    <th>Year</th>
</tr>

<?php while ($s = mysqli_fetch_assoc($students)) { ?>
<tr>
    <td><?= $s['studentid']; ?></td>
    <td><?= $s['firstname']; ?></td>
    <td><?= $s['lastname']; ?></td>
    <td><?= $s['username']; ?></td>
    <td><?= $s['department']; ?></td>
    <td><?= $s['year']; ?></td>
</tr>
<footer class="footer">
    <p>&copy; 2025 Student Information Management System</p>
</footer>
<?php } ?>
</table>
