<?php
session_start();
require("connection.php");

if (isset($_SESSION['adminid'])) {
    header("Location: login.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM teacher");
?>
 <link rel="stylesheet" href="style.css">
    <div class="nav">
    <a href="update_teacher.php">update teachers</a>
    <a href="add_teacher.php">add teachers</a>
    <a href="logout.php">Logout</a>
</div>

<table border="1">
<tr>
    <th>ID</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Username</th>
    <th>Computing</th>
    <th>Action</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?= $row['teacherid']; ?></td>
    <td><?= $row['firstname']; ?></td>
    <td><?= $row['lastname']; ?></td>
    <td><?= $row['username']; ?></td>
    <td><?= $row['computing']; ?></td>
    <td>
        <a href="edit_teacher.php?id=<?= $row['teacherid']; ?>">Edit</a> |
        <a href="delete_teacher.php?id=<?= $row['teacherid']; ?>"
           onclick="return confirm('Delete this teacher?')">Delete</a>
    </td>
</tr>
<?php } ?>
</table>
