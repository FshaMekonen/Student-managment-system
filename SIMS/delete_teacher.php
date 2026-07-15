<?php
session_start();
require("connection.php");

if (isset($_SESSION['adminid'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM teacher WHERE teacherid=$id");

header("Location: manage_teachers.php");
exit();
