<?php
session_start();
require_once('db_connection.php');



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $contact_number = $_POST['contact_number'];
    $user_type = $_POST['user_type'];

    // Update user details in the database
    $sql = "UPDATE users SET fname = ?, lname = ?, email = ?, contact_number = ?, user_type = ? WHERE user_id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("sssssi", $fname, $lname, $email, $contact_number, $user_type, $user_id);
    $stmt->execute();

    if ($stmt->affected_rows === 1) {
        // User details updated successfully
        header("Location: manage_users.php");
    } else {
        echo "Failed to update user details";
    }

    $stmt->close();
}

$db->close();
?>
