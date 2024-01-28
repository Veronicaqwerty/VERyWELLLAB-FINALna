<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
session_start(); // Starting a session for user login
?>

<!-- Login Form -->
<div class="box">
    <h2>Login Form</h2>
    <form action="login_process.php" method="post">
        <!-- Input fields for username and password -->
        <div class="inputBox">
            <input type="text" name="username" required>
            <label>Email or Phone</label>
        </div>
        <div class="inputBox space">
            <!-- Password field with show/hide functionality -->
            <input type="password" name="password" id="passwordField" required>
            <label>Password</label>
            <span class="show">SHOW</span>
            <i class="togglePassword fas fa-eye"></i>
        </div>

        <!-- Display error message if login fails -->
        <?php
        if (isset($_SESSION['login_error'])) {
            echo '<div style="background-color: #f8d7da; color: #721c24; padding: 10px; text-align: center;">' . $_SESSION['login_error'] . '</div>';
            unset($_SESSION['login_error']); // Clear the error message after displaying it
        }
        ?>

        <!-- Forgot password link -->
        <div class="pass">
            <a href="forgotpass.php">Forgot Password?</a>
        </div>
        <div class="field">
            <!-- Login button -->
            <input type="submit" value="LOGIN">
        </div>
    </form>

    <!-- Signup link for new users -->
    <div class="signup">
        Don't have an account?
        <a href="registration.php">Signup Now</a>
    </div>
</div>

<script>
    // Show/hide password functionality
    const pass_field = document.querySelector('input[name="password"]');
    const showBtn = document.querySelector('.show');

    showBtn.addEventListener('click', function() {
        if (pass_field.type === "password") {
            pass_field.type = "text";
            showBtn.textContent = "HIDE";
            showBtn.style.color = "#3498db";
        } else {
            pass_field.type = "password";
            showBtn.textContent = "SHOW";
            showBtn.style.color = "#222";
        }
    });

    // Toggle password visibility with eye icon
    const passwordField = document.getElementById('passwordField');
    const togglePassword = document.querySelector('.togglePassword');

    togglePassword.addEventListener('click', function () {
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);

        // Change eye icon based on password visibility
        this.classList.toggle('fa-eye-slash');
    });
</script>

</body>
</html>
<style>
        body {
            margin: 0;
            padding: 0;
            background: url(img/bgf.jpg);
            background-size: cover;
            font-family: sans-serif;
        }

        .box {
            position: absolute;
            top: 50%;
            right: 30%;
            transform: translate(-50%, -50%);
            width: 25rem;
            padding: 2.5rem;
            box-sizing: border-box;
            background: rgba(0, 0, 0, 0.6);
            border-radius: 0.625rem;
        }

        .box h2 {
            margin: 0 0 1.875rem;
            padding: 0;
            color: #fff;
            text-align: center;
        }

        .box .inputBox {
    position: relative;
    text-align: center; /* Center-align text within the inputBox */
}

.box .inputBox input {
    width: 100%;
    padding: 0.625rem 0;
    font-size: 1rem;
    color: #fff;
    letter-spacing: 0.062rem;
    margin-bottom: 1.875rem;
    border: none;
    border-bottom: 0.065rem solid #fff;
    outline: none;
    background: transparent;
    text-align: center; /* Center-align text inside the input */
}

.box .inputBox label {
    position: absolute;
    top: -2rem; /* Adjust the label's position above the input */
    left: 0;
    padding: 0.625rem 0;
    font-size: 1rem;
    color: #fff;
    pointer-events: none;
    transition: 0.5s;
}

.box .inputBox .togglePassword {
    position: absolute;
    top: 1rem; /* Adjust the eye icon's position */
    right: 0.5rem;
    color: #000; /* Set the eye icon color to black */
    cursor: pointer;
}

        .box .inputBox input:focus ~ label,
        .box .inputBox input:valid ~ label,
        .box .inputBox input:not([value=""]) ~ label {
            top: -2.125rem;
            left: 0;
            color: #03a9f4;
            font-size: 0.75rem;
        }

        .box input[type="submit"] {
            border: none;
            outline: none;
            color: #fff;
            background-color: #03a9f4;
            padding: 0.625rem 1.25rem;
            cursor: pointer;
            border-radius: 0.312rem;
            font-size: 1rem;
        }

        .box input[type="submit"]:hover {
            background-color: #1cb1f5;
        }
    </style>
