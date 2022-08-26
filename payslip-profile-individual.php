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
    </style>
</head>

<body>
    <div class="main" style="margin-bottom: 20%;">
        <div class="container firstContainer" style="margin-bottom: 5%;">
            <button class="button is-rounded mb-5 is-light" id="returnBtn"><i class="fa-solid fa-arrow-left mr-3"></i>Return</button>
            <p class="title is-4 has-text-centered" id="payrollTitle">Batch <i class="fa-solid fa-hashtag"></i><?php echo "" . $_SESSION["billingId"] ?></p>
            <p class="title is-hidden" id="test_indicator">Test</p>
            <p class="title is-hidden" id="indicator">Live Search Indicator</p>
            <p class="title is-hidden" id="billingIdHidden"><?php echo $_SESSION["billingId"] ?></p>
            <p class="title is-hidden" id="ownerIdHidden"><?php echo $_SESSION["ownerId"] ?></p>
            <p class="title is-hidden" id="payrollStatusHidden"><?php echo $_SESSION["payrollStatus"] ?></p>
            <p class="title is-4 is-hidden" id="isOwnerHidden"><?php echo $_SESSION["isOwner"] ?></p>
            <p class="title is-4 is-hidden" id="isDriverHidden"><?php echo $_SESSION["isDriver"] ?></p>
            <p class="title is-4 is-hidden" id="isHelperHidden"><?php echo $_SESSION["isHelper"] ?></p>
        </div>



        <div class="container" style="margin-bottom: 5%;">
            <p class="title is-4 mb-6" id="statusHeader">Status: <?php echo $_SESSION["payrollStatus"] ?> </p>

            <p class="subtitle is-5 mb-4" id="plateNumberHeader">Plate Number:</p>
            <p class="subtitle is-5 mb-4" id="ownerHeader">Vehicle Owner:</p>
            <p class="subtitle is-5 mb-4" id="dateHeader">Date:</p>

        </div>

        <div class="container" style="margin-bottom: 5%;">
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

        <div class="container">
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
                        <a class="pagination-link is-current" id="paginationIndicatorBtn">1</a>
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
<script src="js/payslip-profile-individual.js"></script>


<!--INTERNAL JAVASCRIPT-->
<script>
    let isOwnerHidden = document.getElementById('isOwnerHidden')
    let isDriverHidden = document.getElementById('isDriverHidden')
    let isHelperHidden = document.getElementById('isHelperHidden')

    logoutBtn.classList.remove("is-hidden");
    payslipBtn.classList.add("is-active");

    if (isOwnerHidden.innerHTML == "Yes") {
        //shipmentGroupBtn.classList.remove("is-hidden");
        shipmentIndividualBtn.classList.remove("is-hidden");
        payslipBtn.classList.remove("is-hidden");
        vehicleBtn.classList.remove("is-hidden");
    };

    if (isDriverHidden.innerHTML == "Yes" || isHelperHidden.innerHTML == "Yes") {
        shipmentIndividualBtn.classList.remove("is-hidden");
    };
</script>

</html>