<?php
session_start();
require("connection.php");

if(!isset($_SESSION['headid'])){
    header("Location: login.php");
    exit();
}

$dept = $_SESSION['computing'] ?? '';
// Fetch teachers in department
$teachers = mysqli_query($conn, "SELECT * FROM teacher WHERE department='$dept'");
if(!$teachers){
    die("Teacher query failed: " . mysqli_error($conn));
}

// Fetch all courses
$courses = mysqli_query($conn, "SELECT * FROM courses ORDER BY courseid DESC");
if(!$courses){
    die("Course query failed: " . mysqli_error($conn));
}

// Handle form submission
$message = '';
if(isset($_POST['assign'])){
    $teacherid = $_POST['teacherid'];
    $courseid  = $_POST['courseid'];

    $check = mysqli_query($conn, "SELECT * FROM teacher_course WHERE teacherid='$teacherid' AND courseid='$courseid'");
    if(mysqli_num_rows($check) == 0){
        mysqli_query($conn, "INSERT INTO teacher_course (teacherid, courseid) VALUES ('$teacherid','$courseid')");
        $message = "Course assigned successfully!";
    } else {
        $message = "Course already assigned to this teacher.";
    }
}
?>

<link rel="stylesheet" href="style.css">

<div class="nav">
   <a href="hod_assign_course.php">Assign Course</a>
   <a href="approve_grade.php">Approve Grades</a>
   <a href="view_courses.php">View Courses</a>
   <a href="logout.php">Logout</a>
</div>
<p>Department: <b><?= htmlspecialchars($dept) ?></b></p>
<?php if($message) echo "<p style='color:green;'>$message</p>"; ?>

<form method="post">
    <label>Teacher:</label><br>
    <select name="teacherid" required>
        <option value="">-- Select Teacher --</option>
        <?php while($t = mysqli_fetch_assoc($teachers)) { ?>
            <option value="<?= $t['teacherid']; ?>"><?= htmlspecialchars($t['firstname'].' '.$t['lastname']); ?></option>
        <?php } ?>
    </select>
    <br><br>

    <label>Course:</label><br>
    <select name="courseid" required>
        <option value="">-- Select Course --</option>
        <?php while($c = mysqli_fetch_assoc($courses)) { ?>
            <option value="<?= $c['courseid']; ?>"><?= htmlspecialchars($c['coursename']); ?> (Year <?= $c['year']; ?> | Sem <?= $c['semester']; ?> | Credit <?= $c['credithour']; ?>)</option>
        <?php } ?>
    </select>
    <br><br>

    <button name="assign">Assign Course</button>
</form>

<br>
<a href="hod_view_assignments.php">View Assigned Courses</a>
