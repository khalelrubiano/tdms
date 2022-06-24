<?php
header("Refresh: 10; url = index.php");

session_start();
include 'navbar.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Prompt</title>

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
  <div class="mainAlt">
    <section class="hero has-background-white">
      <div class="hero-body">
        <div class="container">
          <div class="columns is-centered">
            <div class="column is-6">
              <article class="message is-info">
                <div class="message-header">
                  <p class="is-size-3">Attention!</p>
                </div>

                <div class="message-body">
                  <p class="is-size-4"> <?php echo $_SESSION['prompt'] . "<br>" . "Redirecting in 10 secs..."; ?> </p>
                </div>
              </article>

            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

</body>
<script>
  clientTrackingBtn.classList.remove("is-hidden");

  signUpBtn.classList.remove("is-hidden");
  loginBtn.classList.remove("is-hidden");

  sideNavbarClass.style.display = "none";
  sideNavbarBurger.classList.add("is-hidden");
</script>

</html>