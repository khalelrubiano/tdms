<?php
//PART OF NEW SYSTEM
include_once 'navbar.php';

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  header("location: index.php");
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign-up</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <link rel="stylesheet" href="navbar.css">
  <style>

  </style>
</head>

<body>
  <div class="main_alt">
    <section class="hero is-fullheight-with-navbar">
      <div class="hero-body">
        <div class="container">
          <!-- classless div used for making the subtitle start on new line-->
          <p class="title">
            Sign-up as:
          </p>
          <div class="tile is-ancestor">
            <div class="tile is-parent">
              <div class="tile is-child">
                <p class="title">
                  Company
                </p>
                <a href="sign-up-company.php" class="button is-link is-rounded" id="signupCompanyBtn"><strong>Sign Up</strong> </a>
              </div>
              <div class="tile is-child">
                <p class="title">
                  User
                </p>
                <a href="sign-up-user.php" class="button is-link is-rounded" id="signupUserBtn"><strong>Sign Up</strong> </a>
              </div>
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

<script>
  let clientTrackingBtn = document.getElementById('clientTrackingBtn')

  let signupBtn = document.getElementById('signupBtn')
  let loginBtn = document.getElementById('loginBtn')
  let logoutBtn = document.getElementById('logoutBtn')

  if (<?php echo !isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true ?>) {

    clientTrackingBtn.classList.remove("is-hidden");

    signupBtn.classList.remove("is-hidden");
    loginBtn.classList.remove("is-hidden");
  }
  sidenav_class.style.display = "none";

  burger_2.classList.add("is-hidden");
</script>

</html>