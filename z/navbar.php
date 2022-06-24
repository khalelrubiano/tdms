<?php
ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="navbar.css">
</head>

<body>
    <nav class="navbar has-background-white has-shadow is-fixed-top">
        <div class="navbar-brand">

            <a class="navbar-burger" id="burger_2" style="margin-left: 0;">
                <span></span>
                <span></span>
                <span></span>
            </a>

            <a href="index.php" class="navbar-item">
                <figure class="image">
                    <img src="assets/test_logo_2.png" alt="SITE LOGO" width="100%" style="max-height: 80px;">
                </figure>
            </a>

            <a class="navbar-burger" id="burger_1">
                <span></span>
                <span></span>
                <span></span>
            </a>
        </div>

        <div class="navbar-menu" id="nav_links">
            <div class="navbar-start">
                <a href="client-tracking.php" class="navbar-item is-hidden" id="clientTrackingBtn"> TRACK SHIPMENT </a>
            </div>

            <div class="navbar-end">
                <a href="" class="navbar-item has-text-weight-bold is-hidden" id="userAccountBtn"> <?php echo $_SESSION["username"]; ?> </a>
                <div class="navbar-item">
                    <div class="buttons">
                        <a href="sign-up-home.php" class="button is-link is-rounded is-hidden" id="signupBtn"> <i class="fas fa-user-plus mr-3"></i><strong>Sign Up</strong> </a>
                        <a href="login.php" class="button has-background-grey-lighter is-rounded is-hidden" id="loginBtn"><i class="fas fa-sign-in-alt mr-3"></i><strong> Login </strong></a>
                        <a href="logout.php" class="button has-background-dark is-rounded has-text-white is-hidden" id="logoutBtn"><i class="fas fa-sign-out-alt mr-3"></i><strong> Logout </strong></a>
                    </div>
                </div>
            </div>
        </div>

    </nav>

    <!-- Side navigation -->
    <div class="sidenav_class has-background-white box" id="sidenav_id">

        <aside class="menu">
            <p class="menu-label">
                General
            </p>
            <ul class="menu-list">
                <li><a id="dashboardBtn">Dashboard</a></li>
            </ul>

            <p class="menu-label">
                Modules
            </p>
            <ul class="menu-list">
                <li><a id="shipmentBtn">Shipments</a></li>
            </ul>

            <p class="menu-label">
                Manage
            </p>
            <ul class="menu-list">
                <li>
                    <a>Default Users</a>
                    <ul>
                        <li><a id="defaultViewListBtn">View List</a></li>
                    </ul>
                </li>

                <li>
                    <a class="">Employees</a>
                    <ul>
                        <li><a id="employeesViewListBtn">View List</a></li>
                        <li><a id="employeesPermissionsBtn">Permissions</a></li>
                    </ul>
                </li>

                <li>
                    <a class="">Subcontractors</a>
                    <ul>
                        <li><a id="subcontractorsGroupsBtn">Groups</a></li>
                    </ul>
                </li>

            </ul>
        </aside>

    </div>

</body>

<script src="js/navbar.js"></script>

</html>