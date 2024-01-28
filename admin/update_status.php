<?php
// update_status.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db_connection.php';

    $orderGroupId = $_POST['orderGroupId'];
    $newStatus = $_POST['newStatus'];

    // Prepare and execute the SQL update statement to update the status
    $updateSql = "UPDATE orders SET status = ? WHERE order_group_id = ?";
    $updateStmt = $db->prepare($updateSql);
    $updateStmt->bind_param("si", $newStatus, $orderGroupId);
    $updateStmt->execute();

    // Check if the query was successful
    if ($updateStmt->affected_rows > 0) {
        // Status updated successfully
        http_response_code(200);
    } else {
        // Error updating status
        http_response_code(500); // Internal Server Error
    }

    // Close statements and the database connection
    $updateStmt->close();
    $db->close();
} else {
    // Invalid request method
    http_response_code(400); // Bad Request
}
?>
