<?php
//SESSION START
if (!isset($_SESSION)) {
  session_start();
}

/*
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["shipmentAccess"] === 'No') {
    header("location: dashboard-default.php");
    exit;
}
*/

include_once 'navbar.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign-up</title>

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
    /*
    @media (min-width: 1000px) {
      .is-child {
        width: 500px;
      }
    }

    
    @media (max-width: 1000px) {
      .is-child {
        min-width: 300px;
      }
    }
*/
    .is-parent {
      align-items: center !important;
    }

    .is-child:hover {
      background-color: hsl(217, 71%, 45%);
      color: white;
    }
  </style>
</head>

<body>
  <div class="mainAlt">
    <section class="hero is-fullheight-with-navbar">
      <div class="hero-body">
        <div class="container has-text-centered">
          <!-- classless div used for making the subtitle start on new line-->
          <p class="title mb-6">
            Sign-up as:
          </p>
          <div class="tile is-ancestor has-text-centered">
            <div class="tile is-parent is-vertical">
              <div class="tile title button is-child has-text-centered box is-4 is-rounded" id="signupCompanyBtn"> Company </div>
              <div class="tile title button is-child has-text-centered box is-4 is-rounded" id="signupSubcontractorBtn"> Subcontractor </div>
              <div class="tile title button is-child has-text-centered box is-4 is-rounded" id="signupUserBtn"> User </div>
            </div>
          </div>
        </div> <!-- classless div used for making the subtitle start on new line-->
      </div>
    </section>

    <footer class="footer">
      <div class="content has-text-centered">
        <p>
          <strong>Bulma</strong> by <a href="https://jgthms.com">Jeremy Thomas</a>. The source code is licensed
          <a href="http://opensource.org/licenses/mit-license.php">MIT</a>. The website content
          is licensed <a href="http://creativecommons.org/licenses/by-nc-sa/4.0/">CC BY NC SA 4.0</a>.
        </p>
      </div>
    </footer>
  </div>
</body>

<!--EXTERNAL JAVASCRIPT
<script src="js/login.js"></script>
-->

<!--INTERNAL JAVASCRIPT-->
<script>
  let signupCompanyBtn = document.getElementById("signupCompanyBtn");
  let signupSubcontractorBtn = document.getElementById("signupSubcontractorBtn");
  let signupUserBtn = document.getElementById("signupUserBtn");

  clientTrackingBtn.classList.remove("is-hidden");

  signUpBtn.classList.remove("is-hidden");
  loginBtn.classList.remove("is-hidden");

  sideNavbarClass.style.display = "none";
  sideNavbarBurger.classList.add("is-hidden");



  signupCompanyBtn.addEventListener('click', () => {
    window.location.href = "sign-up-company.php";
  });

  signupSubcontractorBtn.addEventListener('click', () => {
    window.location.href = "sign-up-subcontractor.php";
  });

  signupUserBtn.addEventListener('click', () => {
    window.location.href = "sign-up-user.php";
  });

</script>

</html>