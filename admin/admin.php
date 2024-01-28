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
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
</head>
<body>

<?php include 'nav.php'; ?>

<div class="container">
    <div class="admin-header text-center">
        <h1>Welcome to the Admin Panel</h1>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
<style>
        /* Custom styles */
        body {
            font-family: Arial, sans-serif;
            background-image: url('../images/bg5.jpg');
       background-size: cover;
        background-repeat: repeat;
            margin: 0;
            padding: 0px;
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transform: translate3d(0, 0, 0); /* Adding 3D transformation */
            transition: transform 0.3s ease; /* Adding a subtle animation */
        }

        .admin-header h1 {
            margin-bottom: 20px;
            text-transform: uppercase; /* Uppercase text */
        }

        .admin-content {
            margin-top: 30px;
        }
    </style>