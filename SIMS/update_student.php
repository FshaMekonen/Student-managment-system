<?php
session_start();
require("connection.php");

if (isset($_SESSION['adminid'])) {
    header("Location: login.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM student");
?>
<html>
    <body>
         <link rel="stylesheet" href="style.css">

    <div class="nav">
    <a href="update_student.php">update Students</a>
    <a href="add_student.php">add students</a>
    <a href="logout.php">Logout</a>
</div>

<table border="1">
<tr>
    <th>ID</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Username</th>
    <th>Department</th>
    <th>Year</th>
    <th>Action</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?= $row['studentid']; ?></td>
    <td><?= $row['firstname']; ?></td>
    <td><?= $row['lastname']; ?></td>
    <td><?= $row['username']; ?></td>
    <td><?= $row['department']; ?></td>
    <td><?= $row['year']; ?></td>
    <td>
        <a href="edit_student.php?id=<?= $row['studentid']; ?>">Edit</a> |
        <a href="delete_student.php?id=<?= $row['studentid']; ?>"
           onclick="return confirm('Delete this student?')">Delete</a>
    </td>
</tr>
<?php } ?>
</table>
<footer class="footer">
    <p>&copy; 2025 Student Information Management System</p>
</footer>
</body>
</html>
