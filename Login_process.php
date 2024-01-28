<?php
session_start(); // Start the session

require_once('db_connection.php'); // Include the database connection script

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL query to retrieve user data based on username or email
    $sql = "SELECT user_id, password, user_type FROM users WHERE (username = ? OR email = ?)";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $stored_password = $row['password'];
        $user_type = $row['user_type'];

        // Verify the entered password with the hashed password stored in the database
        if (password_verify($password, $stored_password)) {
            $_SESSION['user_id'] = $row['user_id']; // Set user session ID

            // Redirect based on user type
            if ($user_type === 'admin') {
                header("Location: admin/admin.php"); // Redirect to admin page for admin users
                exit();
            } else {
                header("Location: index.php"); // Redirect to home page for regular users
                exit();
            }
        } else {
            $_SESSION['login_error'] = "Invalid password"; // Set error message for incorrect password
            header("Location: login.php"); // Redirect back to login page with error message
            exit();
        }
    } else {
        $_SESSION['login_error'] = "Invalid username/email"; // Set error message for incorrect username/email
        header("Location: login.php"); // Redirect back to login page with error message
        exit();
    }

    $stmt->close(); // Close the prepared statement
}

$db->close(); // Close the database connection
?>
