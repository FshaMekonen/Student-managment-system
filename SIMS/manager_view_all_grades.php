<?php
session_start();
require("connection.php");

if (isset($_SESSION['adminid'])) {
    header("Location: login.html");
    exit();
}

// Fetch all grades ordered by student and gradeid
$sql = "
    SELECT 
        g.gradeid,
        s.studentid,
        s.firstname AS s_fname,
        s.lastname  AS s_lname,
        c.coursename,
        g.assessment,
        g.quiz,
        g.final_exam,
        g.total,
        g.grade,
        g.status
    FROM grades g
    JOIN student s ON g.studentid = s.studentid
    JOIN courses c ON g.courseid = c.courseid
    ORDER BY s.studentid, g.gradeid DESC
";

$result = mysqli_query($conn, $sql);

// Prepare an array grouped by student
$students = [];
while ($row = mysqli_fetch_assoc($result)) {
    $students[$row['studentid']][] = $row;
}
?>

<link rel="stylesheet" href="styl.css">

<div class="nav">
    <a href="manager_view_students.php">All Students</a>
    <a href="manager_view_teachers.php">All Teachers</a>
    <a href="manager_view_all_grades.php">All Grades</a>
    <a href="logout.php">Logout</a>
</div>

<table border="1" width="100%">
<tr>
    <th>Student ID</th>
    <th>Student Name</th>
    <th>Course</th>
    <th>Assessment</th>
    <th>Quiz</th>
    <th>Final</th>
    <th>Total</th>
    <th>Grade</th>
    <th>Status</th>
</tr>

<?php foreach ($students as $studentid => $grades): ?>
    <?php $rowspan = count($grades); ?>
    <?php foreach ($grades as $index => $grade): ?>
    <tr>
        <?php if ($index == 0): ?>
            <td rowspan="<?= $rowspan ?>"><?= $grade['studentid'] ?></td>
            <td rowspan="<?= $rowspan ?>"><?= $grade['s_fname'] . ' ' . $grade['s_lname'] ?></td>
        <?php endif; ?>
        <td><?= $grade['coursename'] ?></td>
        <td><?= $grade['assessment'] ?></td>
        <td><?= $grade['quiz'] ?></td>
        <td><?= $grade['final_exam'] ?></td>
        <td><?= $grade['total'] ?></td>
        <td><?= $grade['grade'] ?></td>
        <td>
            <?php
           
            if ($grade['status'] == 'Approved') echo "<span style='color:green;'>Approved</span>";
            
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
<?php endforeach; ?>

</table>

<footer class="footer">
    <p>&copy; 2025 Student Information Management System</p>
</footer>
