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
  <title>Billing</title>

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

      #searchBarForm,
      #selectSortDiv {
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
      <button class="button is-rounded mr-4 is-info" onclick="openAdd()"> <i class="fa-solid fa-plus mr-3"></i> Create Billing Invoice</button>
      <button class="button is-rounded mr-4 is-info" onclick="openLog()"> <i class="fa-solid fa-clipboard-list mr-3"></i> Log</button>

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
          <option value="billing.invoice_number" selected>Sort By Invoice Number</option>
          <option value="billing.invoice_date">Sort By Invoice Date</option>
        </select>
      </div>

    </div>
    <div class="container">
      <div class="tabs is-centered is-toggle">
        <ul>
          <li class="is-active" id="allTabLi"><a id="allTabLink">All</a></li>
          <li id="settledTabLi"><a id="settledTabLink">Settled</a></li>
          <li id="unsettledTabLi"><a id="unsettledTabLink">Unsettled</a></li>
        </ul>
      </div>

      <div class="tile is-ancestor is-vertical" id="ancestorTile">

      </div>

    </div>

  </div>

  <!-- ADD MODAL START-->
  <div class="modal" id="addModal">
    <div class="modal-background" id="addModalBg"></div>
    <div class="modal-card">

      <header class="modal-card-head has-background-info">
        <p class="modal-card-title has-text-white"><i class="fa-solid fa-user-group mr-3"></i>Create Billing Invoice</p>
        <button class="delete" aria-label="close" onclick="closeAdd()"></button>
      </header>

      <section class="modal-card-body">
        <div class="field">
          <label for="" class="label">Invoice Number</label>
          <div class="control has-icons-left">
            <input type="text" placeholder="Enter invoice number here" class="input is-rounded" name="invoiceNumberAdd" id="invoiceNumberAdd">
            <span class="icon is-small is-left">
              <i class="fa-solid fa-user"></i>
            </span>
          </div>
          <p class="help" id="invoiceNumberAddHelp"></p>
        </div>

        <div class="field">
          <label for="" class="label">Invoice Date</label>
          <div class="control has-icons-left">
            <input type="date" class="input is-rounded" name="invoiceDateAdd" id="invoiceDateAdd">
            <span class="icon is-small is-left">
              <i class="far fa-calendar-alt"></i>
            </span>
          </div>
          <p class="help" id="invoiceDateAddHelp"></p>
        </div>

        <div class="field">
          <label for="" class="label">Client</label>
          <div class="control">
            <div class="select is-rounded" id="clientAddDiv">
              <select id="clientAdd" name="clientAdd">
              </select>
            </div>
          </div>
          <p class="help" id="clientAdd"></p>
        </div>

        <div class="field">
          <label for="" class="label">Drop Fee</label>
          <div class="control has-icons-left">
            <input type="text" placeholder="Enter drop fee here" class="input is-rounded" name="dropFeeAdd" id="dropFeeAdd">
            <span class="icon is-small is-left">
              <i class="fa-solid fa-user"></i>
            </span>
          </div>
          <p class="help" id="dropFeeAddHelp"></p>
        </div>

        <div class="field">
          <label for="" class="label">Parking Fee</label>
          <div class="control has-icons-left">
            <input type="text" placeholder="Enter parking fee here" class="input is-rounded" name="parkingFeeAdd" id="parkingFeeAdd">
            <span class="icon is-small is-left">
              <i class="fa-solid fa-user"></i>
            </span>
          </div>
          <p class="help" id="parkingFeeAddHelp"></p>
        </div>

        <div class="field">
          <label for="" class="label">Demurrage</label>
          <div class="control has-icons-left">
            <input type="text" placeholder="Enter invoice number here" class="input is-rounded" name="demurrageAdd" id="demurrageAdd">
            <span class="icon is-small is-left">
              <i class="fa-solid fa-user"></i>
            </span>
          </div>
          <p class="help" id="demurrageAddHelp"></p>
        </div>

        <div class="field">
          <label for="" class="label">Other Charges</label>
          <div class="control has-icons-left">
            <input type="text" placeholder="Enter invoice number here" class="input is-rounded" name="otherChargesAdd" id="otherChargesAdd">
            <span class="icon is-small is-left">
              <i class="fa-solid fa-user"></i>
            </span>
          </div>
          <p class="help" id="otherChargesAddHelp"></p>
        </div>

        <div class="field">
          <label for="" class="label">Penalty</label>
          <div class="control has-icons-left">
            <input type="text" placeholder="Enter invoice number here" class="input is-rounded" name="penaltyAdd" id="penaltyAdd">
            <span class="icon is-small is-left">
              <i class="fa-solid fa-user"></i>
            </span>
          </div>
          <p class="help" id="penaltyAddHelp"></p>
        </div>

        <div class="field">
          <label for="" class="label">Start Date</label>
          <div class="control has-icons-left">
            <input type="date" class="input is-rounded" name="startDateAdd" id="startDateAdd">
            <span class="icon is-small is-left">
              <i class="far fa-calendar-alt"></i>
            </span>
          </div>
          <p class="help" id="startDateAddHelp"></p>
        </div>

        <div class="field">
          <label for="" class="label">End Date</label>
          <div class="control has-icons-left">
            <input type="date" class="input is-rounded" name="endDateAdd" id="endDateAdd">
            <span class="icon is-small is-left">
              <i class="far fa-calendar-alt"></i>
            </span>
          </div>
          <p class="help" id="endDateAddHelp"></p>
        </div>

        <div class="field has-text-centered mt-6">
          <button class="button is-info has-text-white is-rounded" name="submitAddForm" id="submitAddForm">
            <i class="fas fa-paper-plane mr-3"></i>Submit
          </button>
          <p class="help" id="submitAddFormHelp" style="text-align: center;"></p>
        </div>

      </section>
    </div>
  </div>
  <!-- ADD MODAL END-->
  <!-- LOG MODAL START-->
  <div class="modal" id="logModal">
    <div class="modal-background" id="logModalBg"></div>
    <div class="modal-card">

      <header class="modal-card-head has-background-info">
        <p class="modal-card-title has-text-white"><i class="fa-solid fa-clipboard-list mr-3"></i>Log</p>
        <button class="delete" aria-label="close" onclick="closeLog()"></button>
      </header>

      <section class="modal-card-body">
        <div class="content">
          <ul id="logList">
          
          </ul>
        </div>
      </section>
    </div>
  </div>
  <!-- LOG MODAL END-->
</body>

<!--EXTERNAL JAVASCRIPT-->
<script src="js/billing.js"></script>


<!--INTERNAL JAVASCRIPT-->
<script>
  logoutBtn.classList.remove("is-hidden");
  userBtn.innerHTML = "<?php echo $_SESSION['username'] ?>";
  userBtn.classList.remove("is-hidden");
  billingBtn.classList.add("is-active");
</script>

</html>