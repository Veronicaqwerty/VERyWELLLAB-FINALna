<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <title>Responsive Registration Form | CodingLab</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="background-image: url('img/bg0.jpg');
    background-size: cover; /* Adjust the image size to cover the entire background */
    background-repeat: no-repeat; /* Prevent the image from repeating */
    background-attachment: fixed; /* Fixed position when scrolling */;">
    <header>
        <?php include 'nav.php'; ?>
    </header>
  <div class="container">
    <div class="content">
      <h1 style="color: white; text-align: center; margin-bottom: 20px;">Register Now</h1>
      <form action="register_process.php" method="post" style="margin-top: 20px;">
        <form action="register_process.php" method="post">
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Last Name</span>
                    <input type="text" name="lname" placeholder="Enter your last name" required>
                </div>
                <div class="input-box">
                    <span class="details">Middle Name</span>
                    <input type="text" name="mi" placeholder="Enter your middle name" required>
                </div>
                <div class="input-box">
                    <span class="details">First Name</span>
                    <input type="text" name="fname" placeholder="Enter your first name" required>
                </div>
                <!-- Include name attributes for other fields -->
                <div class="input-box">
                    <span class="details">Username</span>
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="input-box">
                    <span class="details">Email</span>
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="input-box">
                    <span class="details">Contact Number</span>
                    <input type="text" name="contact_number" placeholder="Contact Number" required>
                </div>
                <div class="input-box">
                    <span class="details">Address</span>
                    <input type="text" name="address" placeholder="Address" required>
                </div>
                <div class="input-box">
                    <span class="details">Password</span>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="input-box">
                    <span class="details">Confirm Password</span>
                    <input type="password" name="confirm_password" placeholder="Confirm your password" required>
                </div>
            </div>
<div class="gender-details">
  <span class="gender-title">Gender</span>
  <div class="category">
    <div class="input-box">
      <input type="radio" name="gender" id="male" value="male" style="display: inline-block; width: auto;">
      <label for="male" style="display: inline-block; margin-right: 10px;">Male</label>
    </div>
    <div class="input-box">
      <input type="radio" name="gender" id="female" value="female" style="display: inline-block; width: auto;">
      <label for="female" style="display: inline-block; margin-right: 10px;">Female</label>
    </div>
    <div class="input-box">
      <input type="radio" name="gender" id="not-say" value="not_say" style="display: inline-block; width: auto;">
      <label for="not-say" style="display: inline-block;">Prefer not to say</label>
    </div>
  </div>
</div>



          <!-- <div class="input-box">
    <span class="details">Register as Admin?</span>
    <input type="radio" id="admin-yes" name="admin" value="yes" style="display: inline-block; width: auto;">
    <label for="admin-yes" style="display: inline-block; margin-right: 10px;">Yes</label>
    <input type="radio" id="admin-no" name="admin" value="no" checked style="display: inline-block; width: auto;">
    <label for="admin-no" style="display: inline-block;">No</label>
</div> -->

        </div>

        <div class="button" style="text-align: center; margin-top: 20px;">
    <input type="submit" value="Register" style="padding: 10px 20px; background-color: #03a9f4; color: #fff; border: none; border-radius: 5px; cursor: pointer; font-size: 16px;">
</div>

      </form>
    </div>
  </div>

</body>
</html>
