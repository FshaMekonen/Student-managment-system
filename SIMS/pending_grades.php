<?php
session_start();
require("connection.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['teacherid'])) {
    header("Location: login.html");
    exit();
}

/* Submit SINGLE grade to HOD */
if (isset($_GET['submit'])) {
    $gradeid = (int)$_GET['submit'];
    mysqli_query($conn, "
        UPDATE grades 
        SET status='Submitted_to_HOD' 
        WHERE gradeid='$gradeid' 
        AND status IN ('Pending','Rejected')
    ");
    header("Location: pending_grades.php");
    exit();
}

/* Fetch Pending OR Rejected grades */
$grades = mysqli_query($conn, "
    SELECT g.*, s.firstname, s.lastname, c.coursename
    FROM grades g
    JOIN student s ON g.studentid = s.studentid
    JOIN courses c ON g.courseid = c.courseid
    WHERE g.status IN ('Pending','Rejected')
");
?>

<link rel="stylesheet" href="styl.css">

<div class="nav">
    <a href="entry_grade.php">Entry Grade</a>
    <a href="pending_grades.php">Pending Grades</a>
    <a href="logout.php">Logout</a>
</div>

<table border="1" width="100%">
<tr>
    <th>Student</th>
    <th>Course</th>
    <th>Assessment</th>
    <th>Quiz</th>
    <th>Final</th>
    <th>Total</th>
    <th>Grade</th>
    <th>Status</th>
    <th>Action</th>
</tr>

<?php while ($grade = mysqli_fetch_assoc($grades)) { ?>
<tr>
    <td><?= $grade['firstname']." ".$grade['lastname']; ?></td>
    <td><?= $grade['coursename']; ?></td>
    <td><?= $grade['assessment']; ?></td>
    <td><?= $grade['quiz']; ?></td>
    <td><?= $grade['final_exam']; ?></td>
    <td><?= $grade['total']; ?></td>
    <td><?= $grade['grade']; ?></td>

    <td>
        <?php
        if ($grade['status'] == 'Rejected') {
            echo "<span style='color:red;'>Rejected</span>";
        } elseif ($grade['status'] == 'Pending') {
            echo "<span style='color:orange;'>Pending</span>";
        }
        ?>
    </td>

    <td>
        <a href="edit_grade.php?id=<?= $grade['gradeid']; ?>">Edit</a>
        <?php if ($grade['status']=='Pending' || $grade['status']=='Rejected'): ?>
            | <a href="?submit=<?= $grade['gradeid']; ?>"
                 onclick="return confirm('Submit this grade to HOD?')">Submit</a>
        <?php endif; ?>
    </td>
</tr>
<?php } ?>
</table>

<footer class="footer">
    <p>&copy; 2025 Student Information Management System</p>
</footer>
