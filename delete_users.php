<?php
// Check if user ID is provided in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
} else {
    die('<p class="error">Invalid access. No user ID provided.</p>');
}

// Include the database connection
require('mysqli_connect.php');

// Prepare the SQL DELETE query
$q = "DELETE FROM users WHERE users_id = ?";
$stmt = $dbcon->prepare($q);
$stmt->bind_param('i', $id);

// Execute the query
if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        header('Location: register-view-users.php');
        exit();
    } else {
        echo '<p class="error">User not found or already deleted.</p>';
    }
} else {
    echo '<p class="error">An error occurred while attempting to delete the user.</p>';
}

// Close the statement and connection
$stmt->close();
mysqli_close($dbcon);
?>
