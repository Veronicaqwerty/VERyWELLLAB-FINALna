<?php
include 'db_connection.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $item_id = $_POST['item_id'];

    // Prepare and execute the SQL DELETE query
    $delete_query = "DELETE FROM menu_items WHERE item_id = $item_id";

    if ($db->query($delete_query) === TRUE) {
        // Redirect to the product management page after successful deletion
        header("Location: products.php");
        exit();
    } else {
        echo "Error deleting record: " . $db->error;
    }
}
?>
