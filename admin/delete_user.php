<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php"); // Redirect to the login page if not logged in
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    require_once('db_connection.php');

    // Prepare and execute a SQL DELETE query
    $delete_query = "DELETE FROM users WHERE user_id = ?";
    $stmt = $db->prepare($delete_query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // User deleted successfully
        header("Location: manage_users.php"); // Redirect back to user management page
        exit();
    } else {
        // Error in deletion
        echo "Error deleting user.";
    }

    $stmt->close();
    $db->close();
} else {
    echo "Invalid request.";
}
?>
