<?php
//PART OF NEW SYSTEM
include 'navbar.php';
/*
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  header("location: index.php");
  exit;
}*/
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="navbar.css">
</head>

<body>
  <div class="main_alt">
    <section class="hero has-background-white is-fullheight">
      <div class="hero-body">

        <div class="container">

          <div class="columns is-centered">
            <div class="column is-5-tablet is-4-desktop is-3-widescreen">

              <form id="loginForm" action="classes/login-controller.class.php" class="box has-background-white-ter" method="POST">

                <div class="field">
                  <label for="" class="label">Username</label>
                  <div class="control has-icons-left">
                    <input type="text" placeholder="Enter username here" class="input is-rounded" name="username" id="username">
                    <span class="icon is-small is-left">
                      <i class="fas fa-user"></i>
                    </span>
                  </div>
                  <p class="help" id="usernameHelp"></p>
                </div>


                <div class="field">
                  <label for="" class="label">Password</label>
                  <div class="control has-icons-left">
                    <input type="password" placeholder="Enter password here" class="input is-rounded" name="password" id="password">
                    <span class="icon is-small is-left">
                      <i class="fa fa-lock"></i>
                    </span>
                  </div>
                  <p class="help" id="passwordHelp"></p>
                </div>

                <div class="field">
                  <button class="button is-info has-text-white is-rounded" name="submit" type="submit" id="submitForm">
                    <i class="fas fa-sign-in-alt mr-3"></i>Login
                  </button>
                </div>

              </form>

            </div>

          </div>

        </div>

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

<script src="js/login.js"></script>
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