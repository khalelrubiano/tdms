<?php
//SESSION START
if (!isset($_SESSION)) {
  session_start();
}
/*
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["shipmentAccess"] === 'No') {
  header("location: dashboard-default.php");
  exit;
}*/

include_once 'navbar.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shipment</title>

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

      #selectSortDiv {
        float: left;
      }

      #searchBarForm {
        float: right;
      }
    }

    @media (max-width: 1000px) {

      #searchBarForm {
        padding-top: 10px;
        padding-bottom: 10px;
      }

      #selectSortDiv {
        margin-bottom: 5%;
      }
    }
  </style>
</head>

<body>
  <div class="main" style="margin-bottom: 20%;">
    <div class="container" style="margin-bottom: 2%;">
      <p class="title is-hidden" id="arrayLengthHidden">sample</p>
      <p class="title is-hidden" id="test_indicator">Test</p>
      <p class="title is-hidden" id="indicator">Live Search Indicator</p>
      <p class="title is-hidden" id="tabValueHidden">All</p>

      <div class="field" id="searchBarForm">
        <p class="control has-icons-right">
          <input class="input is-rounded" type="text" placeholder="Search" id="searchBarInput">
          <span class="icon is-small is-right">
            <i class="fa-solid fa-magnifying-glass"></i>
          </span>
        </p>
      </div>

      <div class="select is-rounded mr-3" id="selectSortDiv">
        <select id="selectSort">
          <option value="vehicle.plate_number" selected>Sort By Plate Number</option>
          <option value="vehicle.vehicle_status">Sort By Status</option>
        </select>
      </div>

    </div>
    <div class="container">
      <div class="tabs is-centered is-toggle">
        <ul>
          <li class="is-active" id="allTabLi"><a id="allTabLink">All</a></li>
          <li id="availableTabLi"><a id="availableTabLink">Available</a></li>
          <li id="onDeliveryTabLi"><a id="onDeliveryTabLink">On-Delivery</a></li>
          <li id="unavailableTabLi"><a id="unavailableTabLink">Unavailable</a></li>
        </ul>
      </div>

      <div class="tile is-ancestor is-vertical" id="ancestorTile">

      </div>

    </div>

  </div>
 
</body>

<!--EXTERNAL JAVASCRIPT-->
<script src="js/subcontractor-vehicle.js"></script>


<!--INTERNAL JAVASCRIPT-->
<script>
  logoutBtn.classList.remove("is-hidden");
  subcontractorVehicleBtn.classList.add("is-active");
</script>

</html>