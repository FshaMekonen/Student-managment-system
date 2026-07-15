<?php
// hod_register.php
// Start session if needed
session_start();
require("connection.php");
// Get form data
$name = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];
$department = $_POST['department'];

// Optional: Hash the password for security
$password = $_POST['password'];

// Insert into database
$sql = "INSERT INTO headde ( name, username, password, department) 
        VALUES ('$name', '$username', '$password', '$department')";

if (mysqli_query($conn, $sql)) {
    echo "HOD registered successfully!";
    echo "<br><a href='hod_register.html'>Back</a>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
