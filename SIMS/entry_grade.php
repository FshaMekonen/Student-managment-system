<?php
session_start();
require("connection.php");

if (!isset($_SESSION['teacherid'])) {
    header("Location: login.html");
    exit();
}

// Fetch students
$students = mysqli_query($conn, "SELECT * FROM student");

// Fetch courses
$courses = mysqli_query($conn, "SELECT * FROM courses");

// Handle grade entry
if (isset($_POST['save'])) {
    foreach ($_POST['studentid'] as $i => $studentid) {

        $courseid   = $_POST['courseid'][$i];
        $assessment = (int)$_POST['assessment'][$i];
        $quiz       = (int)$_POST['quiz'][$i];
        $final      = (int)$_POST['final'][$i];

        $total = $assessment + $quiz + $final;

        if ($total >= 90) $grade = "A+";
        elseif ($total >= 80) $grade = "A";
        elseif ($total >= 70) $grade = "B";
        elseif ($total >= 60) $grade = "C";
        else $grade = "F";

        mysqli_query($conn, "
            INSERT INTO grades
            (studentid, courseid, assessment, quiz, final_exam, total, grade, status)
            VALUES
            ('$studentid','$courseid','$assessment','$quiz','$final','$total','$grade','Pending')
        ");
    }

    echo "<p style='color:green; text-align:center;'>Grades saved as Pending</p>";
}
?>

<link rel="stylesheet" href="styl.css">
<div class="nav">
    <a href="entry_grade.php">Entry Grade</a>
    <a href="pending_grades.php">Pending Grades</a>
    <a href="logout.php">Logout</a>
</div>
<form method="post">
<table border="1" width="100%">
<tr>
    <th>Student</th>
    <th>Course</th>
    <th>Assessment (30)</th>
    <th>Quiz (20)</th>
    <th>Final (50)</th>
</tr>

<?php while ($s = mysqli_fetch_assoc($students)) { ?>
<tr>
    <td>
        <?= $s['firstname']." ".$s['lastname']; ?>
        <input type="hidden" name="studentid[]" value="<?= $s['studentid']; ?>">
    </td>

    <td>
        <select name="courseid[]" required>
            <?php mysqli_data_seek($courses, 0); ?>
            <?php while ($c = mysqli_fetch_assoc($courses)) { ?>
                <option value="<?= $c['courseid']; ?>">
                    <?= $c['coursename']; ?>
                </option>
            <?php } ?>
        </select>
    </td>

    <td><input type="text" name="assessment[]" max="30" required></td>
    <td><input type="text" name="quiz[]" max="20" required></td>
    <td><input type="text" name="final[]" max="50" required></td>
</tr>
<?php } ?>
</table>

<br>
<input type="submit" name="save" value="Save as Pending">
</form>
