
<?php
//PART OF NEW SYSTEM
if (!isset($_SESSION)) {
    session_start();
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">



</head>

<body>
    <nav class="navbar has-background-white has-shadow">

        <div class="navbar-brand">
            <a href="index.php" class="navbar-item">
                <!-- <img src="assets/aljur.jpg" alt="SITE LOGO" style="max-height: 60px;"> -->
                <figure class="image">
                    <!-- <img src="assets/test_logo_2.png" alt="SITE LOGO" width="100%" style="max-height: 80px;"> -->
                    <img src="assets/test_logo_2.png" alt="SITE LOGO" width="100%" style="max-height: 80px;">
                </figure>
            </a>

            <a class="navbar-burger" id="burger">
                <span></span>
                <span></span>
                <span></span>
            </a>
        </div>

        <div class="navbar-menu" id="nav-links">
            <div class="navbar-start">
                <!--
                    <a href="login.php" class="navbar-item" id="login_btn"> LOGIN </a>
                    <a href="sign-up.php" class="navbar-item" id="signup_btn"> SIGN UP </a>
                    <a href="manage-account.php" class="navbar-item" id="account_btn"> MANAGE ACCOUNT </a>
                    -->
                <a href="index.php" class="navbar-item is-hidden" id="shipmentBtn"> SHIPMENT </a>
                <a href="tracking.php" class="navbar-item is-hidden" id="trackingBtn"> CLIENT </a>
                <!--VEHICLES AND -->
                <a href="billing.php" class="navbar-item is-hidden" id="billingBtn"> BILLING </a>
                <a href="payslip.php" class="navbar-item is-hidden" id="payslipBtn"> PAYSLIP </a>
                <a href="client-tracking.php" class="navbar-item is-hidden" id="clientTrackingBtn"> TRACK SHIPMENT </a>

                <div class="navbar-item has-dropdown is-hoverable has-text-black">
                    <a class="navbar-link is-hidden" id="manageBtn"> MANAGE </a>

                    <div class="navbar-dropdown">
                        <a href="manage-account.php" class="navbar-item is-hidden" id="accountBtn"> ACCOUNT </a>
                        <a href="manage-vehicle.php" class="navbar-item is-hidden" id="vehicleBtn"> VEHICLE </a>
                    </div>
                </div>
            </div>

            <div class="navbar-end">
                <a href="view-account.php" class="navbar-item has-text-weight-bold is-hidden" id="userBtn"> <?php echo $_SESSION["username"]; ?> </a>
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
    <script src="js/navbar.js"></script>
</body>

</html>