<?php
if (!isset($_SESSION)) {
  session_start();
}
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["shipmentAccess"] === 'Yes') {
  header("location: index.php");
  exit;
}
//PART OF NEW SYSTEM
include 'navbar.php';



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
  <link rel="stylesheet" href="navbar.css">
  <style>

  </style>
</head>

<body>
  <div class="main">
    <section class="hero is-dark is-fullheight-with-navbar">
      <div class="hero-body">
        <div class="container">
          <div class="">
            <!-- classless div used for making the subtitle start on new line-->
            <p class="title">
              Your account does not have access to any module. Please contact your company administrator.
            </p>
          </div> <!-- classless div used for making the subtitle start on new line-->
        </div>
      </div>
    </section>
  </div>
</body>

<script>
  let shipmentBtn = document.getElementById('shipmentBtn')
  let clientTrackingBtn = document.getElementById('clientTrackingBtn')

  let manageBtn = document.getElementById('manageBtn')
  let employeeBtn = document.getElementById('employeeBtn')
  let subcontractorBtn = document.getElementById('subcontractorBtn')


  let signupBtn = document.getElementById('signupBtn')
  let loginBtn = document.getElementById('loginBtn')
  let logoutBtn = document.getElementById('logoutBtn')

  if (<?php echo isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true ?>) {
    logoutBtn.classList.remove("is-hidden");
  }
</script>

</html>