

<?php
//PART OF NEW SYSTEM
include 'navbar.php';

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["shipmentAccess"] === 'Yes') {
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
  <title>Default Dashboard</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <style>

  </style>
</head>

<body>

  <section class="hero is-dark is-fullheight-with-navbar">
    <div class="hero-body">
      <div class="">
        <!-- classless div used for making the subtitle start on new line-->
        <p class="title">
          Your account does not have access to any module. Please contact your company administrator.
        </p>
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

</body>

<script>
  let shipmentBtn = document.getElementById('shipmentBtn')
  let trackingBtn = document.getElementById('trackingBtn')
  let payslipBtn = document.getElementById('payslipBtn')
  let manageBtn = document.getElementById('manageBtn')
  let billingBtn = document.getElementById('billingBtn')
  let clientTrackingBtn = document.getElementById('clientTrackingBtn')

  let signupBtn = document.getElementById('signupBtn')
  let loginBtn = document.getElementById('loginBtn')
  let logoutBtn = document.getElementById('logoutBtn')

  if (<?php echo isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true ?>) {

    logoutBtn.classList.remove("is-hidden");

  }
</script>

</html>