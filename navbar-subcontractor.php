<?php
//SESSION START
if (!isset($_SESSION)) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--JQUERY CDN-->
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <!--AJAX CDN-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--BULMA CDN-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <!--FONTAWESOME CDN-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!--NAVBAR CSS-->
    <link rel="stylesheet" href="navbar.css">

    <!--INTERNAL CSS-->
    <style>

    </style>
</head>

<body>
    <!--NAVBAR-->
    <nav class="navbar has-background-white has-shadow is-fixed-top">
        <div class="navbar-brand">

            <a class="navbar-burger" id="sideNavbarBurger" style="margin-left: 0;">
                <span></span>
                <span></span>
                <span></span>
            </a>

            <a href="index.php" class="navbar-item">
                <figure class="image">
                    <img src="assets/test_logo_2.png" alt="SITE LOGO" width="100%" style="max-height: 80px;">
                </figure>
            </a>

            <a class="navbar-burger" id="navbarBurger">
                <span></span>
                <span></span>
                <span></span>
            </a>
        </div>

        <div class="navbar-menu" id="navbarLinks">
            <div class="navbar-start">
                <a class="navbar-item is-hidden" id="clientTrackingBtn"> TRACK SHIPMENT </a>
            </div>

            <div class="navbar-end">
                <a class="navbar-item has-text-weight-bold is-hidden" id="userAccountBtn"> <?php echo $_SESSION["username"]; ?> </a>
                <div class="navbar-item">
                    <div class="buttons">
                        <a class="button is-link is-rounded is-hidden" id="signUpBtn"> <i class="fas fa-user-plus mr-3"></i><strong>Sign Up</strong> </a>
                        <a class="button has-background-grey-lighter is-rounded is-hidden" id="loginBtn"><i class="fas fa-sign-in-alt mr-3"></i><strong> Login </strong></a>
                        <a class="button is-link is-inverted is-rounded is-hidden" id="userBtn">username</a>
                        <a class="button has-background-dark is-rounded has-text-white is-hidden" id="logoutBtn"><i class="fas fa-sign-out-alt mr-3"></i><strong> Logout </strong></a>
                    </div>
                </div>
            </div>
        </div>

    </nav>

    <!--SIDE NAVBAR-->
    <div class="sideNavbarClass has-background-white box" id="sideNavbar">

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
                <li><a id="shipmentGroupBtn" class="is-hidden">Shipment</a></li>
            </ul>

            <ul class="menu-list">
                <li><a id="payslipBtn" class="is-hidden">Payslip</a></li>
            </ul>

            <ul class="menu-list">
                <li><a id="shipmentIndividualBtn" class="is-hidden">Shipment</a></li>
            </ul>

            <p class="menu-label" id="manageLabel">
                Manage
            </p>

            <ul class="menu-list">
                <li><a id="vehicleBtn" class="is-hidden">Vehicle</a></li>
                <li><a id="accountBtn" class="is-hidden">Account</a></li>
            </ul>

        </aside>

    </div>
</body>

<!--EXTERNAL JAVASCRIPT-->
<script src="js/navbar-subcontractor.js"></script>

<!--INTERNAL JAVASCRIPT-->
<script>

</script>

</html>