<?php

include 'navbar.php';

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: shipment.php");
    exit;
}
else{
  header("location: homepage.php");
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>

    </style>
</head>

<body>
<section class="hero has-background-primary">
  <div class="hero-body">
    <div class="container box">
    <p class="title">
      Hero title
    </p>
    </div>
    <p class="subtitle">
      Hero subtitle
    </p>
  </div>
</section>

<section class="section has-background-link">
  <h1 class="title">Section</h1>
  <h2 class="subtitle">
    A simple container to divide your page into <strong>sections</strong>, like the one you're currently reading.
  </h2>
  <button class="button">Button</button>
</section>

</body>

<script>
  /*
  let shipmentBtn = document.getElementById('shipmentBtn')
  let trackingBtn = document.getElementById('trackingBtn')
  let payslipBtn = document.getElementById('payslipBtn')
  let manageBtn = document.getElementById('manageBtn')
  let billingBtn = document.getElementById('billingBtn')
  let clientTrackingBtn = document.getElementById('clientTrackingBtn')
  
  if(<?php //echo !isset($_SESSION["loggedin"])?>){
    shipmentBtn.className = "navbar-item is-hidden";
    trackingBtn.className = "navbar-item is-hidden";
    payslipBtn.className = "navbar-item is-hidden";
    manageBtn.className = "navbar-item is-hidden";
    billingBtn.className = "navbar-item is-hidden";
    clientTrackingBtn.className = "navbar-item";
  }
*/
</script>

</html>