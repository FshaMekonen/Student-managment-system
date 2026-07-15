<?php
require "connection.php";

if (isset($_POST["submit"])) {

    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $fullname = $_POST["fullname"];

    $stmt = $conn->prepare(
        "INSERT INTO admin (username, password, fullname) VALUES (?,?,?)"
    );
    $stmt->bind_param("sss", $username, $password, $fullname);

    if ($stmt->execute()) {
        echo "Admin registered successfully";
    } else {
        echo "Error: username already exists";
    }
}
?>
<!DOCTYPE html>
<html>
<body>

<h2>Admin Registration</h2>

<form method="POST">
    <input type="text" name="username" placeholder="Username" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <input type="text" name="fullname" placeholder="Full Name" required><br><br>
    <button type="submit" name="submit">Register</button>
</form>

</body>
</html>
