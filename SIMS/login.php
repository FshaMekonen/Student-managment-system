<?php
session_start();
require("connection.php");

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    /* ========== ADMIN LOGIN ========== */
    $sql = "SELECT * FROM admin WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if ($password === $row['password']) {
            $_SESSION['admin'] = $row['username'];
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "Admin password incorrect, write the correct password";
            exit();
        }
    }

    /* ========== HOD LOGIN ========== */
    $sql = "SELECT * FROM headde WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if ($password === $row['password']) {
            $_SESSION['headid'] = $row['headid'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['department'] = $row['department'];
            header("Location: hoddashboard.php");
            exit();
        } else {
            echo "HOD password incorrect, write the correct password";
            exit();
        }
    }

    /* ========== TEACHER LOGIN ========== */
    $sql = "SELECT * FROM teacher WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if ($password === $row['password']) {
            $_SESSION['teacherid'] = $row['teacherid'];
            header("Location: teacher_dashboard.php");
            exit();
        } else {
            echo "Teacher password incorrect, write the correct password";
            exit();
        }
    }

    /* ========== STUDENT LOGIN ========== */
    $sql = "SELECT * FROM student WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if ($password === $row['password']) {
            $_SESSION['studentid'] = $row['studentid'];
            header("Location: student_dashboard.php");
            exit();
        } else {
            echo "Student password incorrect, write the correct password";
            exit();
        }
    }

    /* ========== USERNAME NOT FOUND ========== */
    // If username is not found in any table
    echo "
        Username not found.<br>
        <a href='s_register.html'>Student Register</a><br>
        <a href='T_register.html'>Teacher Register</a><br>
        <a href='hodregister.html'>HOD Register</a>
    ";
}
?>
