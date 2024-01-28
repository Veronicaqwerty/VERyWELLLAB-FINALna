<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to the login page if not logged in
    exit();
}

include 'db_connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Menu</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
    <!-- Site Metas -->
    <title>VERy WELL</title>
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
    
</head>
<body>
    
    <header>
        <?php include 'nav.php'; ?>
    </header>

    <div class="container mt-4">
        <h1>Menu</h1>

        <!-- Category Selection -->
        <div class="mb-4">
    <button class="btn btn-dark category-btn" data-category="Appetizer">
        Appetizer<br><i class="fas fa-utensils"></i>
    </button>
    <button class="btn btn-dark category-btn" data-category="Main">
        Main Course<br><i class="fas fa-utensil-spoon"></i>
    </button>
    <button class="btn btn-dark category-btn" data-category="Dessert">
        Dessert<br><i class="fas fa-birthday-cake"></i>
    </button>
    <button class="btn btn-dark category-btn" data-category="Beverage">
        Beverage<br><i class="fas fa-cocktail"></i>
    </button>
    <button class="btn btn-dark category-btn" data-category="All">
        All<br><i class="fas fa-th"></i>
    </button>
</div>


    <div class="row" id="menuItems">
    <?php
    $query = "SELECT * FROM menu_items";
    $result = $db->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="col-md-3 ' . $row['category'] . ' menu-item">'; // Add 'menu-item' class
            echo '<div class="card mb-3">';
            echo '<img src="img/' . $row['image'] . '" class="card-img-top" alt="' . $row['name'] . '">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $row['name'] . '</h5>';
            echo '<p class="card-text">' . $row['description'] . '</p>';
            echo '<p class="card-text">Category: ' . $row['category'] . '</p>';
            echo '<p class="card-text">Price: $' . $row['price'] . '</p>';
            echo '<form action="add_to_cart.php" method="post">';
            echo '<input type="hidden" name="item_id" value="' . $row['item_id'] . '">';
            echo '<button type="submit" class="add-to-cart">Add to Cart</button>';
            echo '</form>';
            echo '</div></div>';
            echo '</div>';
        }
    } else {
        echo "No menu items available.";
    }
    ?>
</div>

    </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
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
        background-image: url('images/smoke.jpg');
       background-size: 100% 100%;
        background-repeat: repeat;
    }
        .menu-item {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
            min-height: 350px; /* Set a minimum height for consistency */
        }
        .menu-item img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
            max-height: 200px; /* Limit image height */
        }
        .add-to-cart {
            background-color: black;
            color: #fff;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin: 10px auto; /* Center button */
        }
        .add-to-cart:hover {
            background-color: #756558;
        }
    </style>
