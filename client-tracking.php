<?php
//SESSION START
if (!isset($_SESSION)) {
    session_start();
}

include_once 'navbar.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

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
        @media (min-width: 1000px) {

            .hero-body {
                background-image: url("assets/home.jpg");
                background-color: #cccccc;
                background-size: cover !important;
            }
        }

        @media (max-width: 1000px) {

            .hero-body {
                background-image: url("assets/home-mobile.jpg");
                background-color: #cccccc;
                background-size: cover !important;
            }
        }
    </style>
</head>

<body>
    <div class="mainAlt">
        <section class="hero has-background-white is-fullheight">
            <div class="hero-body">

                <div class="container">

                    <div class="columns is-centered">
                        <div class="column is-5-tablet is-4-desktop is-3-widescreen">

                            <div class="box has-background-white-ter">

                                <div class="field mb-5">
                                    <label for="" class="label">Shipment Number</label>
                                    <div class="control has-icons-left">
                                        <input type="text" placeholder="Enter shipment number here" class="input is-rounded" name="shipmentNumber" id="shipmentNumber">
                                        <span class="icon is-small is-left">
                                            <i class="fa-solid fa-hashtag"></i>
                                        </span>
                                    </div>
                                    <p class="help" id="shipmentNumberHelp"></p>
                                </div>

                                <div class="field has-text-centered mt-4">
                                    <button class="button is-info has-text-white is-rounded" name="submitBtn" id="submitBtn">
                                        <i class="fa-solid fa-magnifying-glass mr-3"></i>Search
                                    </button>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>
        <footer class="footer">
            <div class="content has-text-centered">
                <p>
                    <strong>2021IT01</strong>
                </p>
            </div>
        </footer>
    </div>
</body>

<!--EXTERNAL JAVASCRIPT-->
<script src="js/client-tracking.js"></script>

<!--INTERNAL JAVASCRIPT-->
<script>
    clientTrackingBtn.classList.remove("is-hidden");

    signUpBtn.classList.remove("is-hidden");
    loginBtn.classList.remove("is-hidden");

    sideNavbarClass.style.display = "none";
    sideNavbarBurger.classList.add("is-hidden");
</script>

</html>