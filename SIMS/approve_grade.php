<?php
session_start();
require("connection.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

/* Approve or Reject grade */
if (isset($_GET['action']) && isset($_GET['gradeid'])) {
    $gradeid = (int)$_GET['gradeid'];
    $action  = $_GET['action'];

    if ($action === 'approve') {
        mysqli_query($conn, "UPDATE grades SET status='Approved' WHERE gradeid=$gradeid");
    } elseif ($action === 'reject') {
        mysqli_query($conn, "UPDATE grades SET status='Rejected' WHERE gradeid=$gradeid");
    }
}

/* HOD sees only submitted grades */
$sql = "SELECT * FROM grades WHERE status='Submitted_to_HOD'";
$result = mysqli_query($conn, $sql);
?>

<link rel="stylesheet" href="styl.css">

<div class="nav">
    <a href="approve_grade.php">Approve Grades</a>
    <a href="view_courses.php">View Courses</a>
    <a href="logout.php">Logout</a>
</div>

<table border="1">
<tr>
    <th>Student ID</th>
    <th>Course ID</th>
    <th>Assessment</th>
    <th>Quiz</th>
    <th>Final</th>
    <th>Total</th>
    <th>Grade</th>
    <th>Action</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?= $row['studentid'] ?></td>
    <td><?= $row['courseid'] ?></td>
    <td><?= $row['assessment'] ?></td>
    <td><?= $row['quiz'] ?></td>
    <td><?= $row['final_exam'] ?></td>
    <td><?= $row['total'] ?></td>
    <td><?= $row['grade'] ?></td>
    <td>
        <a href="?action=approve&gradeid=<?= $row['gradeid'] ?>">Approve</a> | 
        <a href="?action=reject&gradeid=<?= $row['gradeid'] ?>"
           onclick="return confirm('Are you sure you want to reject this grade?');">Reject</a>
    </td>
</tr>
<?php } ?>
</table>
