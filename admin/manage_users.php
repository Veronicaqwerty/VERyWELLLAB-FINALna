<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php"); // Redirect to the login page if not logged in
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    

</head>
<body>
<?php include 'nav.php'; // Assuming 'nav.php' includes the navigation ?>

<br>
<div class="btn-group" role="group" aria-label="Show Users">
    <a href="?show=users" class="btn btn-outline-info">Regular Users</a>
    <a href="?show=admins" class="btn btn-outline-danger">Admins</a>

</div>

<?php

require_once('db_connection.php');

// Fetch the selected users based on the button clicked
if (isset($_GET['show'])) {
    $show = $_GET['show'];
} else {
    $show = 'users'; // Default to regular users
}

// Fetch users from the database based on the button clicked
if ($show === 'admins') {
    $sql = "SELECT * FROM users WHERE user_type = 'admin'";
} else {
    $sql = "SELECT * FROM users WHERE user_type = 'regular'";
}

$result = $db->query($sql);

// Display users in a table
if ($result->num_rows > 0) {
    echo "<h2>" . ucfirst($show) . "</h2>";
    echo "<table class='table table-striped'>
    <thead class='thead-dark'>
    <tr>
    <th>User ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Contact Number</th>
    <th>Address</th>
    <th>Actions</th>
    </tr>
    </thead>
    <tbody>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['user_id'] . "</td>";
        echo "<td>" . $row['fname'] . " " . $row['lname'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['contact_number'] . "</td>";
        echo "<td>" . $row['address'] . "</td>";
        echo "<td>
    <a class='btn btn-success' href='edit_user.php?user_id=" . $row['user_id'] . "'>Edit</a>
    <a class='btn btn-secondary' href='delete_user.php?user_id=" . $row['user_id'] . "'>Delete</a>
</td>";

        echo "</tr>";
    }
    echo "</tbody></table>";
    
} else {
    echo "<div class='alert alert-warning' role='alert'>No " . $show . " found</div>";
}
if ($show === 'admins') {
    echo <<<HTML
    <div class="admin-content">
    <button class="btn btn-primary" id="showAddAdminForm">Add Admin</button>
    
    <!-- Form to add an admin -->
    <div class="card mt-3" id="addAdminForm" style="display: none;">
        <div class="card-body">
            <h5 class="card-title">Add Admin</h5>
            <form method="post" action="add_admin.php"> <!-- Change 'add_admin.php' to your processing file -->
                <div class="form-group">
                    <label for="fname">First Name</label>
                    <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter first name">
                </div>
                <div class="form-group">
                    <label for="mi">Middle Initial</label>
                    <input type="text" class="form-control" id="mi" name="mi" placeholder="Enter middle initial">
                </div>
                <div class="form-group">
                    <label for="lname">Last Name</label>
                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter last name">
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="form-control" id="gender" name="gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Prefer not to say">Prefer not to say</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="contact_number">Contact Number</label>
                    <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Enter contact number">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter address">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                </div>

                <!-- can add more fields as needed -->

                <button type="submit" class="btn btn-primary">Add Admin</button>
                <button type="button" class="btn btn-secondary ml-2" id="closeAddAdminForm">Close</button>
            </form>
        </div>
    </div>
</div>
HTML;
} else {
    echo "<div></div>";
}
?>




<script>
    document.getElementById('showAddAdminForm').addEventListener('click', function() {
        // Show the add admin form
        const addAdminForm = document.getElementById('addAdminForm');
        addAdminForm.style.display = 'block';
    });

    document.getElementById('closeAddAdminForm').addEventListener('click', function() {
        // Hide the add admin form
        const addAdminForm = document.getElementById('addAdminForm');
        addAdminForm.style.display = 'none';
    });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
<style>
        body {
    font-family: Arial, sans-serif;
    background-image: url('../images/bg5.jpg');
    background-size: cover;
    background-repeat: repeat;
    margin: 0;
    padding: 0px;
    backdrop-filter: blur(5px); /* Adjust the blur strength as needed */
}


        /* Table styling */
.table {
  width: 100%;
  margin-bottom: 1rem;
  color: #fff; /* Changing text color to white */
  border-collapse: collapse; /* Collapsing borders for a cleaner look */
}

/* Header cells */
th, td {
  padding: 0.75rem;
  vertical-align: top;
  border-top: 1px solid #fff; /* Adjusting border color */
}

th {
  vertical-align: bottom;
  border-bottom: 2px solid #fff; /* Adjusting header bottom border */
}

/* Alternating row colors */
tbody tr:nth-of-type(odd) {
  background-color: rgba(255, 255, 255, 0.1); /* Lighter background color for odd rows */
}

/* Hover effect for rows */
tbody tr:hover {
  background-color: rgba(255, 255, 255, 0.2); /* Darker background on hover */
}

    </style>
