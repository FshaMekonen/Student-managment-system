<?php
$conn = mysqli_connect("localhost", "root", "", "project")
  or  die("Connection Error: " . mysqli_connect_error());
// CHECK IF FORM IS SUBMITTED
if (isset($_POST['submit'])) {
    $firstname  = $_POST['firstname'];
    $lastname   = $_POST['lastname'];
    $username   = $_POST['username'];
    $password   = $_POST['password'];
    $department = $_POST['department'];
    $year   = $_POST['year']; 
$query = "INSERT INTO student ( firstname, lastname,username,password ,department,year )
          VALUES ('$firstname', '$lastname','$username','$password', '$department', '$year')";

    if (mysqli_query($conn, $query)) {
        echo "Student Registered Successfully!";
        header("location: login.html");
    } else {
        echo "Error: ";
    }
} 
?>

