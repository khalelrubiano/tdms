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
    <title>Invoice</title>

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

            #invoiceTitle {
                float: right;
                padding-right: 100px;
            }

            .firstContainer {
                border-bottom: 1px solid gray;
            }
        }

        @media (max-width: 1000px) {

            #invoiceTitle {
                margin-bottom: 50px;
            }

            .verticalContainer {
                margin-top: 150px;
            }

            td,
            th {
                font-size: calc(8px + 0.390625vw) !important;
            }

            #invoiceTitle, #shipmentSummaryTitle {
                font-size: calc(18px + 0.390625vw) !important;
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
                font-size: calc(8px + 0.390625vw);
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


        <div class="container firstContainer" style="margin-bottom: 2.5%;">
            <button class="button is-rounded mb-5 has-background-light has-text-black" id="returnBtn"><i class="fa-solid fa-arrow-left mr-3"></i>Return</button>
            <button class="button is-rounded mb-5 has-background-primary has-text-white" id="updateBtn" onclick="updateBillingStatus()"><i class="fa-solid fa-check mr-3"></i>Mark as Settled</button>
            <p class="title is-4 has-text-centered" id="invoiceTitle">Invoice <i class="fa-solid fa-hashtag"></i><?php echo "" . $_SESSION["invoiceNumber"] ?></p>
            <p class="title is-4 is-hidden" id="billingIdHidden"><?php echo $_SESSION["billingId"] ?></p>
            <p class="title is-4 is-hidden" id="billingStatusHidden"><?php echo $_SESSION["billingStatus"] ?></p>
            <p class="title is-4 is-hidden" id="invoiceNumberHidden"><?php echo $_SESSION["invoiceNumber"] ?></p>
        </div>


        <div class="container box" style="margin-bottom: 2.5%;">
            <div class="columns">
                <div class="column">
                    <table class="table firstTable">
                        <tbody>
                            <tr class="firstTable">
                                <td class="firstTableTd"><strong>Status:</strong></td>
                                <td class="firstTableTd"><?php echo $_SESSION["billingStatus"] ?></td>
                            </tr>
                            <tr class="firstTable">
                                <td class="firstTableTd"><strong>Invoice Date:</strong></td>
                                <td class="firstTableTd"><?php echo $_SESSION["invoiceDate"] ?></td>
                            </tr>
                            <tr class="firstTable">
                                <td class="firstTableTd"><strong>Due Date:</strong></td>
                                <td class="firstTableTd"><?php echo $_SESSION["dueDate"] ?></td>
                            </tr>
                            <tr class="firstTable">
                                <td class="firstTableTd"><strong>Covered Date:</strong></td>
                                <td class="firstTableTd"><?php echo $_SESSION["startDate"] . " to " . $_SESSION["endDate"] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="column">
                    <table class="table firstTable">
                        <tbody>
                            <tr class="firstTable">
                                <td class="firstTableTd"><strong>Client:</strong></td>
                                <td class="firstTableTd"><?php echo $_SESSION["clientName"] ?></td>
                            </tr>
                            <tr class="firstTable">
                                <td class="firstTableTd"><strong>Client Address:</strong></td>
                                <td class="firstTableTd"><?php echo $_SESSION["clientAddress"] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="container box is-hidden" style="margin-bottom: 5%;">
            <p class="title is-4 mb-6" id="statusHeader">Status: <?php echo "" . $_SESSION["billingStatus"] ?></p>

            <p class="subtitle is-5 mb-4">Invoice Date: <?php echo "" . $_SESSION["invoiceDate"] ?></p>
            <p class="subtitle is-5 mb-4">Due Date: <?php echo "" . $_SESSION["dueDate"] ?></p>
            <p class="subtitle is-5 mb-6">Covered Date: <?php echo "" . $_SESSION["startDate"] . " to " . $_SESSION["endDate"] ?></p>

        </div>

        <div class="container box is-hidden" style="margin-bottom: 5%;">

            <p class="title is-4 mb-6">Client: <?php echo "" . $_SESSION["clientName"] ?></p>
            <p class="subtitle is-5 mb-6">Client Address: <?php echo "" . $_SESSION["clientAddress"] ?></p>

        </div>

        <div class="container box" style="margin-bottom: 5%;">
            <div class="columns is-centered">
                <div class="column is-12">
                    <table class="table is-bordered is-fullwidth">
                        <thead>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="table1TD">Truck Rate:</th>
                                <td class="table1TD" id="truckRateTD">0</th>
                            </tr>
                            <tr>
                                <td class="table1TD">Drop Fee:</th>
                                <td class="table1TD" id="dropFeeTD"><?php echo $_SESSION["dropFee"] ?></th>
                            </tr>
                            <tr>
                                <td class="table1TD">Parking Fee:</th>
                                <td class="table1TD" id="parkingFeeTD"><?php echo $_SESSION["parkingFee"] ?></th>
                            </tr>
                            <tr>
                                <td class="table1TD">Demurrage:</th>
                                <td class="table1TD" id="demurrageTD"><?php echo $_SESSION["demurrage"] ?></th>
                            </tr>
                            <tr>
                                <td class="table1TD">Other Charges:</th>
                                <td class="table1TD" id="otherChargesTD"><?php echo $_SESSION["otherCharges"] ?></th>
                            </tr>
                            <tr>
                                <th class="table1TH">Subtotal:</th>
                                <td class="table1TD" id="subtotalTD">0</th>
                            </tr>
                            <tr>
                                <td class="table1TD">12% VAT:</th>
                                <td class="table1TD" id="taxTD">0</th>
                            </tr>
                            <tr>
                                <td class="table1TD">Less Penalties:</th>
                                <td class="table1TD" id="penaltyTD"><?php echo $_SESSION["penalty"] ?></th>
                            </tr>
                            <tr>
                                <th class="table1TH">Total Trucking Charges:</th>
                                <td class="table1TD" id="totalTD">0</th>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
        <div class="container box">
            <p class="title is-4 mb-6" id="shipmentSummaryTitle">Shipment Summary</p>
            <div id="card" class="mb-4 has-text-centered">
                <table>
                    <thead>
                        <tr>
                            <th style="text-align: center;">Shipment Number</th>
                            <th>Area Rate</th>
                            <th>Vehicle Plate Number</th>
                            <th>Date Completed</th>
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
<script src="js/billing-profile.js"></script>


<!--INTERNAL JAVASCRIPT-->
<script>
    logoutBtn.classList.remove("is-hidden");
    userBtn.innerHTML = "<?php echo $_SESSION['username'] ?>";
    userBtn.classList.remove("is-hidden");
    billingBtn.classList.add("is-active");

    if (billingStatusHidden.innerHTML == "Settled") {
        updateBtn.classList.add("is-hidden");
    }
</script>

</html>