<?php
session_start();
require("connection.php");

// Ensure student is logged in
if (!isset($_SESSION['studentid'])) {
    header("Location: login.php");
    exit();
}

$studentid = $_SESSION['studentid'];
$success = "";
$error = "";

// Handle password update
if (isset($_POST['update_password'])) {
    $current = mysqli_real_escape_string($conn, $_POST['current_password']);
    $new = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirm = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    // Fetch current password from database
    $sql = "SELECT password FROM student WHERE studentid='$studentid'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Check current password
    if ($current != $row['password']) {
        $error = "Current password is incorrect!";
    } elseif ($new != $confirm) {
        $error = "New password and confirm password do not match!";
    } else {
        // Update password
        // Optional: hash password for security
        // $new = password_hash($new, PASSWORD_DEFAULT);
        $update_sql = "UPDATE student SET password='$new' WHERE studentid='$studentid'";
        if (mysqli_query($conn, $update_sql)) {
             header("Location: profile.php");
    exit();
            $success = "Password updated successfully!";

        } else {
            $error = "Error updating password!";
        }
    }
}
?>
<link rel="stylesheet" href="styl.css">
   
<!-- Password Update Form -->
<form method="POST">
    <label>Current Password:</label><br>
    <input type="password" name="current_password" required><br><br>

    <label>New Password:</label><br>
    <input type="password" name="new_password" required><br><br>

    <label>Confirm New Password:</label><br>
    <input type="password" name="confirm_password" required><br><br>

    <button type="submit" name="update_password">Update Password</button>
</form>
<footer class="footer">
    <p>&copy; 2025 Student Information Management System</p>
</footer>
<?php
if ($success) echo "<p style='color:green;'>$success</p>";
if ($error) echo "<p style='color:red;'>$error</p>";
?>
