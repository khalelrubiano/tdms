<?php
//PART OF NEW SYSTEM

include 'navbar.php';

if (!isset($_SESSION)) {
  session_start();
}

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: homepage.php");
  exit;
}

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["accountAccess"] === 'No') {
  header("location: dashboard-default.php");
  exit;
}

$resultsPerPage = 10;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Account</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>



  <style>
    table {
      border: 1px solid #ccc;
      width: 100%;
      margin: 0;
      padding: 0;
      border-collapse: collapse;
      border-spacing: 0;
    }

    table tr {
      border: 1px solid #ddd;
      padding: 5px;
      background: #fff;

    }

    table th,
    table td {
      padding: 10px;
      text-align: center;

    }

    table th {
      text-transform: uppercase;
      letter-spacing: 1px;
    }


    @media screen and (max-width: 600px) {

      #card table {
        border: 0;
      }

      #card table thead {
        display: none;
      }

      #card table tr {
        margin-bottom: 20px;
        display: block;
        border-bottom: 2px solid #ddd;
        box-shadow: 2px 2px 1px #dadada;

      }

      #card table td {
        display: block;
        text-align: right;
        font-size: 13px;
      }

      #card table td:last-child {
        border-bottom: 0;
      }

      #card table td::before {
        content: attr(data-label);
        float: left;
        text-transform: uppercase;
        font-weight: bold;
      }

      #card tbody {
        line-height: 0 !important;
      }

    }
  </style>

</head>

<body>

  <div class="section">

    <div class="container">
      <div id="card" class="mb-6">
        <table id="userTable" class="table is-bordered">
          <thead>
            <tr>
              <th>Username</th>

              <th>First Name</th>
              <th>Middle Name</th>
              <th>Last Name</th>
              <th>Role</th>
            </tr>
          </thead>

          <tbody id="userTableBody">

          </tbody>
        </table>
      </div>

      <nav class="pagination" role="navigation" aria-label="pagination">
        <a class="pagination-previous" id="paginationPrevious">Previous</a>
        <a class="pagination-next" id="paginationNext">Next page</a>
        <ul class="pagination-list" id="paginationListBody">
        </ul>
      </nav>

    </div>
    <p class="title" id="test_paragraph1">data here</p>
    <p class="title" id="test_paragraph2">data here</p>

  </div>



  <!--
<div class="container">
  <div id="card">
    <table class="table is-bordered">
      <thead>
        <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Address</th>
          <th>City</th>
          <th>State</th>
          <th>Zip</th>
          <th>Height</th>
          <th>Weight</th>
          <th>Blood Type</th>
          <th>Eye Color</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td data-label="First Name"> John</td>
          <td data-label="Last Name">Doe</td>
          <td data-label="Address">123 Main Street</td>
          <td data-label="City">Anytown</td>
          <td data-label="State">MN</td>
          <td data-label="Zip"> 12345</td>
          <td data-label="Height">5"8</td>
          <td data-label="Weight">150 lb</td>
          <td data-label="Blood Type">O</td>
          <td data-label="Eye Color">Hazel</td>
        </tr>
        <tr>
          <td data-label="First Name"> John</td>
          <td data-label="Last Name">Doe</td>
          <td data-label="Address">123 Main Street</td>
          <td data-label="City">Anytown</td>
          <td data-label="State">MN</td>
          <td data-label="Zip"> 12345</td>
          <td data-label="Height">5"8</td>
          <td data-label="Weight">150 lb</td>
          <td data-label="Blood Type">O</td>
          <td data-label="Eye Color">Hazel</td>
        </tr>
        <tr>
          <td data-label="First Name"> John</td>
          <td data-label="Last Name">Doe</td>
          <td data-label="Address">123 Main Street</td>
          <td data-label="City">Anytown</td>
          <td data-label="State">MN</td>
          <td data-label="Zip"> 12345</td>
          <td data-label="Height">5"8</td>
          <td data-label="Weight">150 lb</td>
          <td data-label="Blood Type">O</td>
          <td data-label="Eye Color">Hazel</td>
        </tr>
        <tr>
          <td data-label="First Name"> John</td>
          <td data-label="Last Name">Doe</td>
          <td data-label="Address">123 Main Street</td>
          <td data-label="City">Anytown</td>
          <td data-label="State">MN</td>
          <td data-label="Zip"> 12345</td>
          <td data-label="Height">5"8</td>
          <td data-label="Weight">150 lb</td>
          <td data-label="Blood Type">O</td>
          <td data-label="Eye Color">Hazel</td>
        </tr>
        <tr>
          <td data-label="First Name"> John</td>
          <td data-label="Last Name">Doe</td>
          <td data-label="Address">123 Main Street</td>
          <td data-label="City">Anytown</td>
          <td data-label="State">MN</td>
          <td data-label="Zip"> 12345</td>
          <td data-label="Height">5"8</td>
          <td data-label="Weight">150 lb</td>
          <td data-label="Blood Type">O</td>
          <td data-label="Eye Color">Hazel</td>
        </tr>
        <tr>
          <td data-label="First Name"> John</td>
          <td data-label="Last Name">Doe</td>
          <td data-label="Address">123 Main Street</td>
          <td data-label="City">Anytown</td>
          <td data-label="State">MN</td>
          <td data-label="Zip"> 12345</td>
          <td data-label="Height">5"8</td>
          <td data-label="Weight">150 lb</td>
          <td data-label="Blood Type">O</td>
          <td data-label="Eye Color">Hazel</td>
        </tr>
      </tbody>
    </table>
  </div>
  </div>
  -->
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

<script src="js/manage-account.js"></script>

<script>
  let shipmentBtn = document.getElementById('shipmentBtn')
  let trackingBtn = document.getElementById('trackingBtn')
  let payslipBtn = document.getElementById('payslipBtn')
  let manageBtn = document.getElementById('manageBtn')
  let accountBtn = document.getElementById('accountBtn')
  let vehicleBtn = document.getElementById('vehicleBtn')
  let billingBtn = document.getElementById('billingBtn')
  let clientTrackingBtn = document.getElementById('clientTrackingBtn')

  let signupBtn = document.getElementById('signupBtn')
  let loginBtn = document.getElementById('loginBtn')
  let logoutBtn = document.getElementById('logoutBtn')

  if (<?php echo isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true ?>) {

    logoutBtn.classList.remove("is-hidden");
    manageBtn.classList.remove("is-hidden");
    shipmentBtn.classList.remove("is-hidden");
    accountBtn.classList.remove("is-hidden");

  }
</script>

</html>