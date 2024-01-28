<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php"); // Redirect to the login page if not logged in
    exit();
}

include 'db_connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Menu Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
    <!-- Site Metas -->
    <title>VERyWELL</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- color -->
    <link id="changeable-colors" rel="stylesheet" href="css/colors/orange.css" />
    <!-- Modernizer -->
    <script src="js/modernizer.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="..." crossorigin="anonymous">

</head>
<body>
<header>
        <?php include 'nav.php'; ?>
    </header>

<div class="container">
<br><br>
    <form method="POST" action="add_product.php">
    <button type="submit" class="btn btn-primary rounded-pill px-4 py-2">Add Product</button>
</form>


    <!-- Category Selection -->
<div class="mb-4 text-center"> <!-- Center align the buttons -->
    <button class="btn btn-light category-btn" data-category="All">
        All<br><i class="fas fa-th"></i>
    </button>
    <button class="btn btn-light category-btn" data-category="Appetizer">
        Appetizer<br><i class="fas fa-utensils"></i>
    </button>
    <button class="btn btn-light category-btn" data-category="Main">
        Main Course<br><i class="fas fa-utensil-spoon"></i>
    </button>
    <button class="btn btn-light category-btn" data-category="Dessert">
        Dessert<br><i class="fas fa-birthday-cake"></i>
    </button>
    <button class="btn btn-light category-btn" data-category="Beverage">
        Beverage<br><i class="fas fa-cocktail"></i>
    </button>
</div>

    
</div>
<?php 


// Implement update functionality to save changes to the database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['item_id']) && isset($_POST['name']) && isset($_POST['description']) && isset($_POST['category']) && isset($_POST['price'])) {
        $item_id = $_POST['item_id'];
        $new_product_name = $_POST['name'];
        $new_product_description = $_POST['description'];
        $new_product_category = $_POST['category'];
        $new_product_price = $_POST['price'];
        
        // Update the database with the new details
        $update_query = "UPDATE products 
                        SET name = '$new_product_name', 
                            description = '$new_product_description', 
                            category = '$new_product_category', 
                            price = '$new_product_price' 
                        WHERE id = $item_id";

        if ($db->query($update_query) === TRUE) {
            // Fetch the updated product details after the successful update
            $updated_product = fetchProductDetails($item_id);

            if ($updated_product) {
                // Echo the updated product details in JSON format
                echo json_encode($updated_product);
            } else {
                echo json_encode(['error' => 'Product not found']); // Handle case where product is not found
            }
        } else {
            echo json_encode(['error' => 'Error updating record: ' . $db->error]);
        }
    } else {
        echo json_encode(['error' => 'Incomplete data']); // Handle incomplete data scenario
    }
}
?>




    <div class="container">
    <?php
    $query = "SELECT * FROM menu_items";
    $result = $db->query($query);

    if ($result->num_rows > 0) {
        echo '<div class="row" id="menuItems">'; // Start of the row
        while ($row = $result->fetch_assoc()) {
echo '<div class="col-md-4">'; // Product card container
echo '<div class="card menu-item rounded ' . $row['category'] . '">';
echo '<img src="../img/' . $row['image'] . '" class="card-img-top" alt="' . $row['name'] . '">';
echo '<div class="card-body">';
echo '<div class="product-details">'; // Wrap product details
echo '<h5 class="card-title">' . $row['name'] . '</h5>';
echo '<p class="card-text">' . $row['description'] . '</p>';
echo '<p class="card-text">Category: ' . $row['category'] . '</p>';
echo '<p class="card-text">Price: $' . $row['price'] . '</p>';
echo '</div>';
echo '<div class="edit-fields" style="display: none;">'; // Editable fields initially hidden
echo '<input type="text" class="form-control name" value="' . $row['name'] . '">';
echo '<textarea class="form-control description">' . $row['description'] . '</textarea>';
echo '<input type="text" class="form-control category" value="' . $row['category'] . '">';
echo '<input type="number" class="form-control price" value="' . $row['price'] . '">';
echo '<button class="btn btn-primary save-btn">Save</button>';
echo '</div>';
echo '<button class="btn btn-warning edit-btn">Edit</button>';
echo '<form method="POST" action="delete_product.php">';
echo '<input type="hidden" name="item_id" value="' . $row['item_id'] . '">';
echo '<button type="submit" class="btn btn-danger delete-btn" name="delete">Delete</button>';
echo '</form>';
echo '</div>';
echo '</div>';
echo '</div>';

        }
        echo '</div>'; // End of the row
    } else {
        echo "No products available.";
    }
    ?>
</div>

</div>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
$(document).ready(function() {
    $('.edit-btn').click(function() {
        const $productCard = $(this).closest('.menu-item');
        $productCard.find('.product-details').hide();
        $productCard.find('.edit-fields').show();
    });

    $('.save-btn').click(function() {
        const $productCard = $(this).closest('.menu-item');
        const item_id = $productCard.find('input[name="item_id"]').val();
        const name = $productCard.find('.edit-fields .name').val();
        const description = $productCard.find('.edit-fields textarea').val();
        const category = $productCard.find('.edit-fields .category').val();
        const price = $productCard.find('.edit-fields .price').val();

        // AJAX call to update_product.php
        $.ajax({
            type: 'POST',
            url: 'update_product.php',
            data: {
                item_id: item_id,
                name: name,
                description: description,
                category: category,
                price: price
            },
            dataType: 'json',
            success: function(response) {
                if (response.error) {
                    console.error('Update failed:', response.error);
                    // Handle the error - display a message or take necessary action
                } else {
                    // Update the product card with new details
                    $productCard.find('.product-details .card-title').text(response.name);
                    $productCard.find('.product-details .card-text:nth-child(2)').text(response.description);
                    $productCard.find('.product-details .card-text:nth-child(3)').text('Category: ' + response.category);
                    $productCard.find('.product-details .card-text:nth-child(4)').text('Price: $' + response.price);

                    // Hide the editable fields and show product details
                    $productCard.find('.edit-fields').hide();
                    $productCard.find('.product-details').show();
                }
            },
            error: function(xhr, status, error) {
                console.error('Update failed:', error);
                // Handle the error - display a message or take necessary action
            }
        });
    });





    // Category button click handling
     
        $('.category-btn').on('click', function() {
            let category = $(this).attr('data-category');

            // Remove 'active' class from all buttons and add to the clicked one
            $('.category-btn').removeClass('active');
            $(this).addClass('active');

            // Show or hide menu items based on category
            if (category === 'All') {
                $('#menuItems .menu-item').show();
            } else {
                $('#menuItems .menu-item').hide();
                $('#menuItems .' + category).show();
            }

            // Change background color based on category
            switch (category) {
                case 'Appetizer':
                    $('body').css('background-color', 'lightyellow');
                    break;
                case 'Main':
                    $('body').css('background-color', 'lightgreen');
                    break;
                case 'Dessert':
                    $('body').css('background-color', 'lightsalmon');
                    break;
                case 'Beverage':
                    $('body').css('background-color', 'lightblue');
                    break;
                default:
                    $('body').css('background-color', 'white');
                    break;
            }
        });
    });
</script>

</body>
</html>



<style>
        body {
    /* Additional Custom Styles */
    background-image: url('../images/bg5.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    
    /* Add blur effect to the background */
    -webkit-backdrop-filter: blur(5px); /* For Safari and older versions of Chrome */
    backdrop-filter: blur(5px);
}

        .menu-item {
    border: 1px solid #8B4513; /* Brown border */
    border-radius: 5px;
    padding: 15px;
    margin-bottom: 20px;
    min-height: 350px;
    opacity: 0; /* Set initial opacity to 0 for animation */
    animation: fadeIn 0.5s ease-in-out forwards; /* Add fade-in animation */
    text-align: center; /* Center align content */
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

.menu-item img {
    max-width: 100%;
    height: auto;
    display: block;
    margin: 0 auto;
    max-height: 200px;
}

.edit-btn,
.delete-btn {
    margin-top: 10px; /* Increase margin for better spacing */
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
}

.edit-btn {
    background-color: #000;
    color: #fff;
    margin-right: 5px;
}

.delete-btn {
    background-color: #fff;
    color: #000;
    border: 1px solid #000;
}

.edit-fields {
    display: none;
}

    </style>
