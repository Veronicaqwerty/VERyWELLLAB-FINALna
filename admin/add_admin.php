<?php
session_start();
include 'db_connection.php'; // Ensure to include your database connection file

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php"); // Redirect to the login page if not logged in
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['fname'];
    $mi = $_POST['mi'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $contact_number = $_POST['contact_number'];
    $address = $_POST['address'];
    $password = $_POST['password'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Perform database insertion
    $sql = "INSERT INTO users (fname, mi, lname, gender, username, email, contact_number, address, user_type, password)
            VALUES ('$fname', '$mi', '$lname', '$gender', '$username', '$email', '$contact_number', '$address', 'admin', '$hashed_password')";

    if ($db->query($sql) === TRUE) {
        echo "New admin added successfully";
        header("Location: manage_users.php?show=admins"); // Change 'previous_page.php' to the appropriate page
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
}

// Close the database connection
$db->close();
?>
