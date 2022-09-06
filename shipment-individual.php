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

include_once 'navbar-subcontractor.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shipment (Individual)</title>

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
    html {
      background-color: #f4faff;
    }

    #tabUl li {

      background-color: white !important;
    }

    table {
      table-layout: fixed;
    }

    td {
      text-align: center !important;
      white-space: nowrap;
      font-size: calc(8px + 0.390625vw);
    }

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

      #tabUl li {
        font-size: 1.5vh !important;
        background-color: white !important;
      }

      #logBtn {
        padding-top: 10px;
        padding-bottom: 10px;
        width: 45%;
      }

      #addBtn {
        padding-top: 10px;
        padding-bottom: 10px;
        width: 45%;
      }

      #selectSortDiv {
        margin-bottom: 10%;
      }

      #firstContainer {
        text-align: center !important;
      }

    }
  </style>
</head>

<body>
  <div class="main" style="margin-bottom: 20%;">
    <div class="container" style="margin-bottom: 2%;" id="firstContainer">
      <p class="title is-hidden" id="arrayLengthHidden">sample</p>
      <p class="title is-hidden" id="test_indicator"><?php echo $_SESSION["companyId"] ?></p>
      <p class="title is-hidden" id="indicator">Live Search Indicator</p>
      <p class="title is-hidden" id="tabValueHidden">All</p>
      <p class="title is-4 is-hidden" id="isOwnerHidden"><?php echo $_SESSION["isOwner"] ?></p>
      <p class="title is-4 is-hidden" id="isDriverHidden"><?php echo $_SESSION["isDriver"] ?></p>
      <p class="title is-4 is-hidden" id="isHelperHidden"><?php echo $_SESSION["isHelper"] ?></p>

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
          <option value="shipment.shipment_number" selected>Sort By Shipment Number</option>
          <option value="shipment.created_at">Sort By Date</option>
        </select>
      </div>

    </div>
    <div class="container">
      <div class="tabs is-centered is-toggle">
        <ul id="tabUl">
          <li class="is-active" id="allTabLi"><a id="allTabLink">All</a></li>
          <li id="inProgressTabLi"><a id="inProgressTabLink">In-progress</a></li>
          <li id="completedTabLi"><a id="completedTabLink">Completed</a></li>
          <li id="cancelledTabLi"><a id="cancelledTabLink">Cancelled</a></li>
        </ul>
      </div>

      <div class="tile is-ancestor is-vertical" id="ancestorTile">

      </div>

    </div>

  </div>

</body>

<!--EXTERNAL JAVASCRIPT-->
<script src="js/shipment-individual.js"></script>


<!--INTERNAL JAVASCRIPT-->
<script>
  let isOwnerHidden = document.getElementById('isOwnerHidden')
  let isDriverHidden = document.getElementById('isDriverHidden')
  let isHelperHidden = document.getElementById('isHelperHidden')

  logoutBtn.classList.remove("is-hidden");
  userBtn.innerHTML = "<?php echo $_SESSION['username'] ?>";
  userBtn.classList.remove("is-hidden");
  shipmentIndividualBtn.classList.add("is-active");

  if (isOwnerHidden.innerHTML == "Yes") {
    //shipmentGroupBtn.classList.remove("is-hidden");
    shipmentIndividualBtn.classList.remove("is-hidden");
    payslipBtn.classList.remove("is-hidden");
    vehicleBtn.classList.remove("is-hidden");
  };

  if (isDriverHidden.innerHTML == "Yes" || isHelperHidden.innerHTML == "Yes") {
    shipmentIndividualBtn.classList.remove("is-hidden");
    manageLabel.classList.add("is-hidden");
  };
</script>

</html>