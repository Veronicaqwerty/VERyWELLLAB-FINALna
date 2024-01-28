<?php
session_start();
require_once('db_connection.php');

// Check if the user_id is provided via GET method
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Fetch user details from the database based on the user_id
    $sql = "SELECT * FROM users WHERE user_id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Additional Styles */
        body {
        font-family: Arial, sans-serif;
        background-image: url('../images/smoke.jpg');
       background-size: cover;
        background-repeat: repeat;
            margin: 0;
            padding: 0px;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
        }

        input[type="text"],
        input[type="email"],
        input[type="submit"] {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <h1>Edit User</h1>

    <form action="update_user.php" method="post">
        <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
        <input type="text" name="fname" value="<?= $user['fname'] ?>" placeholder="First Name">
        <input type="text" name="lname" value="<?= $user['lname'] ?>" placeholder="Last Name">
        <input type="email" name="email" value="<?= $user['email'] ?>" placeholder="Email">
        <input type="text" name="contact_number" value="<?= $user['contact_number'] ?>" placeholder="Contact Number">
        <input type="text" name="address" value="<?= $user['address'] ?>" placeholder="Address">
        <input type="text" name="user_type" value="<?= $user['user_type'] ?>" placeholder="User Type">
        <input type="submit" value="Update User">
    </form>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
<?php
    } else {
        echo "User not found";
    }

    $stmt->close();
}

$db->close();
?>
