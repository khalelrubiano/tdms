<?php
//SESSION START
if (!isset($_SESSION)) {
  session_start();
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
  <div class="main">
    <div class="container">
      <p class="title" style="margin-top: 130px;">Shipments</p>
      <div id="card">
        <table>
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
      <nav class="pagination mt-6">
        <ul class="pagination-list">
          <li>
            <a class="pagination-link is-current">1</a>
          </li>
        </ul>
        <a class="pagination-previous is-disabled">Previous</a>
        <a class="pagination-next">Next page</a>
      </nav>
    </div>
  </div>
</body>

<!--EXTERNAL JAVASCRIPT
<script src="js/index.js"></script>
-->

<!--INTERNAL JAVASCRIPT-->
<script>
  logoutBtn.classList.remove("is-hidden");
  shipmentBtn.classList.add("is-active");
</script>

</html>