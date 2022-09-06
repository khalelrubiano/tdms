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
    <title>Payroll</title>

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

        .titleHeader {
            font-size: calc(14px + 0.390625vw) !important;
        }

        .subtitleHeader {
            font-size: calc(8px + 0.390625vw) !important;
        }

        @media (min-width: 1000px) {

            #payrollTitle {
                float: right;
                padding-right: 100px;
            }

            .firstContainer {
                border-bottom: 1px solid gray;
            }
        }

        @media (max-width: 1000px) {

            #payrollTitle {
                margin-bottom: 50px;
            }

            .verticalContainer {
                margin-top: 150px;
            }

            #firstContainer {
                text-align: center !important;
            }
        }

        .table1TH,
        .table1TD {
            padding: 10px !important;
            text-align: center !important;
            width: 50% !important;
        }

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


        @media (max-width: 600px) {

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
                margin-top: 20px;
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

        .firstTable,
        .firstTableTr,
        .firstTableTd {
            table-layout: fixed;
            border: none !important;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="main" style="margin-bottom: 20%;">
        <div class="container firstContainer" style="margin-bottom: 5%;" id="firstContainer">
            <button class="button is-rounded mb-6 is-light" id="returnBtn"><i class="fa-solid fa-arrow-left mr-3"></i>Return</button>
            <button class="button is-rounded mb-6 is-light" id="updateBtn" onclick="updatePayslipStatus()"><i class="fa-solid fa-check mr-3"></i>Mark as Settled</button>
            <p class="title is-4 has-text-centered" id="payrollTitle">Batch <i class="fa-solid fa-hashtag"></i><?php echo "" . $_SESSION["billingId"] ?></p>
            <p class="title is-hidden" id="test_indicator">Test</p>
            <p class="title is-hidden" id="indicator">Live Search Indicator</p>
            <p class="title is-hidden" id="billingIdHidden"><?php echo $_SESSION["billingId"] ?></p>
            <p class="title is-hidden" id="ownerIdHidden"><?php echo $_SESSION["ownerId"] ?></p>
            <p class="title is-hidden" id="payrollStatusHidden"><?php echo $_SESSION["payrollStatus"] ?></p>
        </div>

        <div class="container box" style="margin-bottom: 2.5%;">
            <div class="columns">
                <div class="column is-6">
                    <table class="table firstTable">
                        <tbody>
                            <tr class="firstTable">
                                <td class="firstTableTd"><strong>Status:</strong></td>
                                <td class="firstTableTd"><?php echo $_SESSION["payrollStatus"] ?></td>
                            </tr>
                            <tr class="firstTable">
                                <td class="firstTableTd"><strong>Plate Number:</strong></td>
                                <td class="firstTableTd" id="plateNumberHeader"><?php echo $_SESSION["invoiceDate"] ?></td>
                            </tr>
                            <tr class="firstTable">
                                <td class="firstTableTd"><strong>Vehicle Owner:</strong></td>
                                <td class="firstTableTd" id="ownerHeader"><?php echo $_SESSION["dueDate"] ?></td>
                            </tr>
                            <tr class="firstTable">
                                <td class="firstTableTd"><strong>Date:</strong></td>
                                <td class="firstTableTd" id="dateHeader"><?php echo $_SESSION["startDate"] . " to " . $_SESSION["endDate"] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="container is-hidden" style="margin-bottom: 5%;">
            <p class="title is-4 mb-6" id="statusHeader">Status: <?php echo $_SESSION["payrollStatus"] ?> </p>

        </div>

        <div class="container box" style="margin-bottom: 5%;">
            <div class="columns is-centered">
                <div class="column is-12">
                    <table class="table is-bordered is-fullwidth">
                        <thead>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="table1TD">Truck Rate:</td>
                                <td class="table1TD" id="truckRateTD">0</td>
                            </tr>
                            <tr>
                                <td class="table1TD">Drop Off:</th>
                                <td class="table1TD" id="dropFeeTD">0</td>
                            </tr>

                            <tr>
                                <td class="table1TD">Penalty:</td>
                                <td class="table1TD" id="penaltyTD">0</td>
                            </tr>

                            <tr>
                                <th class="table1TH">Total:</th>
                                <td class="table1TD" id="subtotalTD">0</td>
                            </tr>

                            <tr>
                                <td class="table1TD">1% Withholding Tax:</td>
                                <td class="table1TD" id="whtTD">0</td>
                            </tr>
                            <tr>
                                <td class="table1TD">Commission Rate:</td>
                                <td class="table1TD" id="commissionTD">0</td>
                            </tr>
                            <tr>
                                <th class="table1TH">Net Pay:</th>
                                <td class="table1TD" id="netpayTD">0</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>

        <div class="container box">
            <p class="title is-4 mb-6">Shipment Summary</p>
            <div id="card" class="mb-4 has-text-centered">
                <table>
                    <thead>
                        <tr>
                            <th style="text-align: center;">Date</th>
                            <th>Shipment Number</th>
                            <th>Destination</th>
                            <th>Area</th>
                            <th>Rate</th>
                        </tr>
                    </thead>
                    <tbody id="tableTbody">
                        <!--
                        <tr>
                            <td data-label="First Name"> John</td>
                            <td data-label="Last Name">Doe</td>
                            <td data-label="Address">123 Main Street</td>
                            <td data-label="City">Anytown</td>
-->
                    </tbody>
                </table>
            </div>
            <nav class="pagination mt-6">
                <ul class="pagination-list">
                    <li>
                        <a class="pagination-link is-current is-hidden" id="paginationIndicatorBtn">1</a>
                        <a class="pagination-link is-hidden" id="arrayLengthHidden"></a>
                    </li>
                </ul>
                <a class="pagination-previous is-disabled" id="paginationPreviousBtn">Previous</a>
                <a class="pagination-next" id="paginationNextBtn">Next page</a>
            </nav>
        </div>
    </div>



</body>

<!--EXTERNAL JAVASCRIPT-->
<script src="js/payslip-profile.js"></script>


<!--INTERNAL JAVASCRIPT-->
<script>
    logoutBtn.classList.remove("is-hidden");
    userBtn.innerHTML = "<?php echo $_SESSION['username'] ?>";
    userBtn.classList.remove("is-hidden");
    payrollBtn.classList.add("is-active");

    if (payrollStatusHidden.innerHTML == "Settled") {
        updateBtn.classList.add("is-hidden");
    }
</script>

</html>