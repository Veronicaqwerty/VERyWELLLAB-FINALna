<?php
require_once('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fname = $_POST['fname'];
    $mi = $_POST['mi'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $contact_number = $_POST['contact_number'];
    
    // Retrieve the admin choice from the form
    $admin = isset($_POST['admin']) ? $_POST['admin'] : 'no';
    
    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Set the default user type
    $user_type = $admin === 'yes' ? 'admin' : 'regular';

    // Prepare and execute the SQL statement using prepared statements
    $sql = "INSERT INTO users (fname, mi, lname, gender, username, email, password, address, contact_number, user_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("ssssssssss", $fname, $mi, $lname, $gender, $username, $email, $hashed_password, $address, $contact_number, $user_type);

    if ($stmt->execute()) {
    // Registration successful
    echo '<div style="background-color: #d4edda; color: #155724; padding: 10px;">Registration successful! Redirecting to login page...</div>';
    header("refresh:3;url=login.php"); // Redirect to login.php after 3 seconds
    exit(); // Stop further execution of the script
} else {
    // Error handling
    echo "Error: " . $stmt->error;
}
}


?>
