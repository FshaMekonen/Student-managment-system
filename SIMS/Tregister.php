<?php
require("connection.php"); // database connection

if (isset($_POST['register'])) {
    $firstname  = $_POST['firstname'];
    $lastname   = $_POST['lastname'];
    $username   = $_POST['username'];
    $password   = $_POST['password'];
    $Faculity = $_POST['department'];

    $query = "INSERT INTO teacher ( firstname, lastname, username, password, department)
            VALUES ('$firstname','$lastname','$username','$password','$Faculity')";

 if (mysqli_query($conn, $query)) {
    echo "Registration Successful!";
    header("location: login.html");
    exit();
} else {
    echo "Registration Failed!";
    exit();
}
}
?>
