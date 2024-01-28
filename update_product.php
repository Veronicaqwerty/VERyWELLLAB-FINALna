<?php
session_start();
include 'db_connection.php';

function fetchProductDetails($productID) {
    global $db;
    $query = "SELECT * FROM menu_items WHERE item_id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $productID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['item_id'], $_POST['name'], $_POST['description'], $_POST['category'], $_POST['price'])) {
        $item_id = $_POST['item_id'];
        $new_product_name = $_POST['name'];
        $new_product_description = $_POST['description'];
        $new_product_category = $_POST['category'];
        $new_product_price = $_POST['price'];

        $update_query = $db->prepare("UPDATE menu_items SET name = ?, description = ?, category = ?, price = ? WHERE item_id = ?");
        $update_query->bind_param("ssssi", $new_product_name, $new_product_description, $new_product_category, $new_product_price, $item_id);

        if ($update_query->execute()) {
            $updated_product = fetchProductDetails($item_id);

            if ($updated_product) {
                echo json_encode($updated_product);
            } else {
                echo json_encode(['error' => 'Product not found']);
            }
        } else {
            echo json_encode(['error' => 'Error updating record: ' . $db->error]);
        }
    } else {
        echo json_encode(['error' => 'Incomplete data']);
    }
}
?>
