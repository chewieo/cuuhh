<!doctype html>
<html lang="en">
<head>
    <title>Edit User Info</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Edit User Information</h2>
    <?php 
    // Check if user ID is provided in the URL
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = intval($_GET['id']);
    } else {
        echo '<p class="error">Invalid access. No user ID provided.</p>';
        exit();
    }

    // Include the database connection
    require('mysqli_connect.php');

    // Handle the form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);

        if (!empty($name) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $q = "UPDATE users SET fname = ?, email = ? WHERE users_id = ?";
            $stmt = $dbcon->prepare($q);
            $stmt->bind_param('ssi', $name, $email, $id);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo '<p>User information updated successfully.</p>';
            } else {
                echo '<p class="error">No changes made or update failed.</p>';
            }
            $stmt->close();
        } else {
            echo '<p class="error">Please provide valid inputs for all fields.</p>';
        }
    }

    // Retrieve current user data
    $q = "SELECT fname, email FROM users WHERE users_id = ?";
    $stmt = $dbcon->prepare($q);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($name, $email);
    $stmt->fetch();
    $stmt->close();
    ?>
    <form action="edit_users.php?id=<?= $id ?>" method="post">
        <p>Name: <input type="text" name="name" value="<?= htmlspecialchars($name) ?>" required></p>
        <p>Email: <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required></p>
        <button type="submit">Update</button>
    </form>
</body>
</html>
