<?php
if (!isset($_SESSION)) {
  session_start();
}
//PART OF NEW SYSTEM

if (!isset($_SESSION["loggedin"]) || !isset($_SESSION["shipmentAccess"])) {
  header("location: homepage.php");
  exit;
}

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["shipmentAccess"] === 'No') {
  header("location: dashboard-default.php");
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
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <link rel="stylesheet" href="navbar.css">
  <style>

  </style>
</head>

<body>
  <div class="main">
    <section class="section">
      <p class="title">
        Under construction (Dashboard)
      </p>
    </section>
  </div>


</body>

<script>

  let clientTrackingBtn = document.getElementById('clientTrackingBtn')

  let signupBtn = document.getElementById('signupBtn')
  let loginBtn = document.getElementById('loginBtn')
  let logoutBtn = document.getElementById('logoutBtn')

  if (<?php echo isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true ?>) {
    logoutBtn.classList.remove("is-hidden");
  }

  dashboardBtn.classList.add("is-active");

</script>

</html>