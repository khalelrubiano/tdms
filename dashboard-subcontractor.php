<?php
//SESSION START
if (!isset($_SESSION)) {
  session_start();
}

/*
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["dashboardAccess"] === 'No') {
    header("location: dashboard-default.php");
    exit;
}
*/

include_once 'navbar-subcontractor.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>

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
  <div class="main">
    <section class="hero is-link is-fullheight">
      <div class="hero-body">
        <div class="">
          <p class="title">
            Fullheight Dashboard
          </p>
          <p class="subtitle">
            Fullheight subtitle
          </p>
          <p class="title is-4 is-hidden" id="isOwnerHidden"><?php echo $_SESSION["isOwner"] ?></p>
          <p class="title is-4 is-hidden" id="isDriverHidden"><?php echo $_SESSION["isDriver"] ?></p>
          <p class="title is-4 is-hidden" id="isHelperHidden"><?php echo $_SESSION["isHelper"] ?></p>

        </div>
      </div>
    </section>
  </div>
  
</body>

<!--EXTERNAL JAVASCRIPT
<script src="js/index.js"></script>
-->

<!--INTERNAL JAVASCRIPT-->
<script>
  let isOwnerHidden = document.getElementById('isOwnerHidden')
  let isDriverHidden = document.getElementById('isDriverHidden')
  let isHelperHidden = document.getElementById('isHelperHidden')

  logoutBtn.classList.remove("is-hidden");
  dashboardBtn.classList.add("is-active");

  if(isOwnerHidden.innerHTML == "Yes"){
    shipmentGroupBtn.classList.remove("is-hidden");
    shipmentIndividualBtn.classList.remove("is-hidden");
    payslipBtn.classList.remove("is-hidden");
    vehicleBtn.classList.remove("is-hidden");
  };

  if(isDriverHidden.innerHTML == "Yes" || isHelperHidden.innerHTML == "Yes"){
    shipmentIndividualBtn.classList.remove("is-hidden");
  };
</script>

</html>