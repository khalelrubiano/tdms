<?php
//SESSION START
if (!isset($_SESSION)) {
  session_start();
}

if (isset($_SESSION["loggedin"])) {
  header("location: dashboard.php");
  exit;
}

include_once 'navbar.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Homepage</title>

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
    <section class="hero is-link is-fullheight">
      <div class="hero-body">
        <div class="">
          <!--
          <p class="title">
            Fullheight Homepage
          </p>
          <p class="subtitle">
            Fullheight subtitle
          </p>-->
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

<!--EXTERNAL JAVASCRIPT
<script src="js/index.js"></script>
-->

<!--INTERNAL JAVASCRIPT-->
<script>
  clientTrackingBtn.classList.remove("is-hidden");

  signUpBtn.classList.remove("is-hidden");
  loginBtn.classList.remove("is-hidden");

  sideNavbarClass.style.display = "none";
  sideNavbarBurger.classList.add("is-hidden");
</script>

</html>