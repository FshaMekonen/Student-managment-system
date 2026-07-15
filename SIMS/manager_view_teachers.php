<?php
session_start();
require("connection.php");

// Check if manager is logged in
if (isset($_SESSION['managerid'])) {
    header("Location: login.html");
    exit();
}

// Fetch all teachers
$teachers = mysqli_query($conn, "SELECT * FROM teacher ORDER BY teacherid DESC");
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
    <th>Teacher ID</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Username</th>
    <th>Department</th>
</tr>

<?php while ($t = mysqli_fetch_assoc($teachers)) { ?>
<tr>
    <td><?= $t['teacherid']; ?></td>
    <td><?= $t['firstname']; ?></td>
    <td><?= $t['lastname']; ?></td>
    <td><?= $t['username']; ?></td>
    <td><?= $t['department']; ?></td>
</tr>
<footer class="footer">
    <p>&copy; 2025 Student Information Management System</p>
</footer>
<?php } ?>
</table>
