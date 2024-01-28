<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php"); // Redirect to the login page if not logged in
    exit();
}

// Include the database connection
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if all necessary fields are set
    if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['category']) && isset($_POST['price'])) {
        $new_product_name = $_POST['name'];
        $new_product_description = $_POST['description'];
        $new_product_category = $_POST['category'];
        $new_product_price = $_POST['price'];
        
        // Image handling
        $targetDirectory = "../img/"; // Directory where images will be stored
        $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["image"]["size"] > 1500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                // File uploaded successfully, now insert product details into the database
                $image_name = basename($_FILES["image"]["name"]);
                $insert_query = "INSERT INTO menu_items (name, description, category, price, image) 
                                VALUES ('$new_product_name', '$new_product_description', '$new_product_category', '$new_product_price', '$image_name')";

                if ($db->query($insert_query) === TRUE) {
                    // Product added successfully
                    header("Location: products.php"); // Redirect to your products page after adding the product
                    exit();
                } else {
                    // If there's an error while adding the product
                    echo "Error: " . $insert_query . "<br>" . $db->error;
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        // Handle incomplete data scenario
        echo "Incomplete data";
    }
}
?>
