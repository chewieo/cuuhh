<?php
session_start();
if (!isset($_SESSION['user_level']) || $_SESSION['user_level'] !== 1) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <?php include 'nav_admin.php'; ?>

    <h1>Welcome to the Admin Dashboard</h1>
    <ul>
        <li><a href="register-view-users.php">View Users</a></li>
        <li><a href="register.php">Add User</a></li>
        <li><a href="edit_users.php">Edit Users</a></li>
        <li><a href="delete_users.php">Delete Users</a></li>
    </ul>

    <a href="logout.php">Logout</a>
</body>
</html>
