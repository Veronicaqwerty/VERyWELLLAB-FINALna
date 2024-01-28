<nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark" style="background-color: #8B4513; font-size: 18px;">
    <a class="navbar-brand" href="#" style="color: #fff; font-weight: bold; font-size: 44px;"><b><i>VERyWELL</i></b></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon" style="background-color: #fff;"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'admin.php') ? 'active' : ''; ?>">
                <a class="nav-link" href="admin.php" style="color: #fff;">
                    <i class="fa fa-home"></i> Dashboard <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'manage_users.php') ? 'active' : ''; ?>">
                <a class="nav-link" href="manage_users.php" style="color: #fff;">
                    <i class="fa fa-users"></i> Manage Users
                </a>
            </li>
            <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'products.php') ? 'active' : ''; ?>">
                <a class="nav-link" href="products.php" style="color: #fff;">
                    <i class="fa fa-users"></i> Products
                </a>
            </li>
            <!-- Add more navigation links for different admin functionalities -->
        </ul>
        <ul class="navbar-nav ">
            <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'logout.php') ? 'active' : ''; ?>">
                <a class="nav-link" href="logout.php" style="color: #fff;">
                    <i class="fa fa-sign-out"></i> Logout
                </a>
            </li>
        </ul>
    </div>
</nav>
