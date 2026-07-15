<?php
session_start();
require("connection.php");

if (!isset($_SESSION['teacherid'])) {
    header("Location: login.html");
    exit();
}

$id = (int)$_GET['id'];

if (isset($_POST['update'])) {
    $a = (int)$_POST['assessment'];
    $q = (int)$_POST['quiz'];
    $f = (int)$_POST['final'];
    $total = $a + $q + $f;

    if ($total >= 90) $grade="A+";
    elseif ($total >= 80) $grade="A";
    elseif ($total >= 70) $grade="B";
    elseif ($total >= 60) $grade="C";
    else $grade="F";

    mysqli_query($conn, "
        UPDATE grades SET
        assessment='$a',
        quiz='$q',
        final_exam='$f',
        total='$total',
        grade='$grade'
        WHERE gradeid='$id' AND status='Pending'
    ");

    header("Location: pending_grades.php");
    exit();
}

$row = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM grades WHERE gradeid='$id'")
);
?>

<h2>Edit Grade</h2>

<form method="post">
Assessment: <input type="number" name="assessment" value="<?= $row['assessment']; ?>" max="30"><br><br>
Quiz: <input type="number" name="quiz" value="<?= $row['quiz']; ?>" max="20"><br><br>
Final: <input type="number" name="final" value="<?= $row['final_exam']; ?>" max="50"><br><br>

<button name="update">Update</button>
</form>
