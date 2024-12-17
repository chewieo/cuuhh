<?php
ob_start(); // Start output buffering
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require('mysqli_connect.php');
    
    // Initialize variables
    $email = $password = '';

    // Validate email
    if (empty($_POST['username'])) {
        echo '<p class="error">Please input an email address.</p>';
    } else {
        $email = mysqli_real_escape_string($dbcon, trim($_POST['username']));
    }

    // Validate password
    if (empty($_POST['password'])) {
        echo '<p class="error">Please input a password.</p>';
    } else {
        $password = mysqli_real_escape_string($dbcon, trim($_POST['password']));
    }

    if ($email && $password) {
        // Query to retrieve user data
        $q = "SELECT users_id, fname, user_level, psword FROM users WHERE email = '$email'";
        $result = mysqli_query($dbcon, $q);

        if ($result && mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            // Debugging: Verify retrieved values
            // print_r($row); exit();

            // Verify password
            if (password_verify($password, $row['psword'])) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['users_id'] = $row['users_id'];
                $_SESSION['fname'] = $row['fname'];
                $_SESSION['user_level'] = (int) $row['user_level'];

                // Redirect based on user level
                if ($_SESSION['user_level'] === 1) {
                    header('Location: admin.php');
                } else {
                    header('Location: members.php');
                }
                exit();
            } else {
                echo '<p class="error">Incorrect password.</p>';
            }
        } else {
            echo '<p class="error">Email not found. Please register first.</p>';
        }

        // Free the result set
        if ($result) {
            mysqli_free_result($result);
        }
    } else {
        echo '<p class="error">Both fields are required.</p>';
    }

    // Close the database connection
    mysqli_close($dbcon);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>
