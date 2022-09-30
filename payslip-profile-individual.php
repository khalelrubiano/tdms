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

        #shipmentTable {
            border: 1px solid #ccc;
            width: 100%;
            margin: 0;
            padding: 0;
            border-collapse: collapse;
            border-spacing: 0;
        }

        #shipmentTable tr {
            border: 1px solid #ddd;
            padding: 5px;
            background: #fff;

        }

        #shipmentTable th,
        #shipmentTable td {
            padding: 10px;
            text-align: center;
        }

        #shipmentTable th {
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
            <p class="title is-4 has-text-centered is-hidden" id="payrollTitle">Invoice <i class="fa-solid fa-hashtag"></i><?php echo "" . $_SESSION["payrollId"] ?></p>
            <p class="title is-hidden" id="test_indicator">Test</p>
            <p class="title is-hidden" id="indicator">Live Search Indicator</p>
            <p class="title is-hidden" id="payrollIdHidden"><?php echo $_SESSION["payrollId"] ?></p>
            <p class="title is-hidden" id="ownerIdHidden"></p>
            <p class="title is-hidden" id="payrollStatusHidden"><?php echo $_SESSION["payrollStatusHidden"] ?></p>
            <p class="title is-hidden" id="plateNumberHidden"></p>
            <p class="title is-4 is-hidden" id="isOwnerHidden"><?php echo $_SESSION["isOwner"] ?></p>
            <p class="title is-4 is-hidden" id="isDriverHidden"><?php echo $_SESSION["isDriver"] ?></p>
            <p class="title is-4 is-hidden" id="isHelperHidden"><?php echo $_SESSION["isHelper"] ?></p>
        </div>

        <div class="container box p-6">
            <div class="container" style="margin-bottom: 5%;">
                <div class="columns">
                    <div class="column">
                        <table class="table is-fullwidth is-bordered firstTable" style="table-layout: fixed;">
                            <tbody>
                                <tr class="firstTableTr">
                                    <td class="firstTableTd">
                                        <p class="title is-5" id="invoiceNumberHeader" style="line-height: 0.5;">Invoice Number:</p>
                                    </td>
                                </tr>
                                <tr class="firstTableTr">
                                    <td class="firstTableTd">
                                        <p class="title is-5" id="ownerHeader" style="line-height: 0.5;">Vehicle Owner:</p>
                                    </td>

                                </tr>
                                <tr class="firstTableTr">
                                    <td class="firstTableTd">
                                        <p class="title is-5" id="plateNumberHeader" style="line-height: 0.5;">Plate Number:</p>
                                    </td>

                                </tr>
                                <tr class="firstTableTr">
                                    <td class="firstTableTd">
                                        <p class="title is-5" id="dateHeader" style="line-height: 0.5;">Date:</p>
                                    </td>

                                </tr>
                            </tbody>
                        </table>




                    </div>
                </div>
            </div>

            <div class="container" style="margin-bottom: 5%;">
                <p class="title is-4 mb-6">Shipment Summary</p>
                <div id="card" class="mb-4 has-text-centered">
                    <table id="shipmentTable">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Date</th>
                                <th>Shipment Number</th>
                                <th>Destination</th>
                                <th>Area</th>
                                <th>Rate</th>
                                <th>Drop Off</th>
                                <th>Penalty</th>
                            </tr>
                        </thead>
                        <tbody id="tableTbody">

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

            <div class="container" style="margin-bottom: 5%; min-height:100px">
                <div class="columns">
                    <div class="column">
                        <p class="title is-5" id="remarksHeader" style="line-height: 0.5;">Remarks:</p>
                        <p class="title is-6" id="remarksParagraph" style="line-height: 0.5;"></p>
                    </div>
                </div>
            </div>

            <div class="container" style="margin-bottom: 5%;">
                <div class="columns">

                    <div class="column">
                        <table class="table is-fullwidth is-bordered" style="table-layout: fixed;">
                            <tbody>
                                <tr>
                                    <td>TRUCK RATE:</td>
                                    <td id="truckRateTD">0</td>
                                </tr>
                                <tr>
                                    <td>DROP OFF:</td>
                                    <td id="dropOffTD">0</td>
                                </tr>
                                <tr>
                                    <td>PENALTY:</td>
                                    <td id="penaltyTD">0</td>
                                </tr>
                                <tr>
                                    <td class="has-text-weight-bold">TOTAL:</td>
                                    <td class="has-text-weight-bold" id="totalTD">0</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="column">
                        <table class="table is-fullwidth is-bordered" style="table-layout: fixed;">
                            <tbody>
                                <tr>
                                    <td>WITHOLDING TAX 1%:</td>
                                    <td id="taxTD">0</td>
                                </tr>
                                <tr>
                                    <td id="lessTDHeader">LESS %</td>
                                    <td id="lessTD">0</td>
                                </tr>
                                <tr>
                                    <td class="has-text-weight-bold">NET PAY:</td>
                                    <td class="has-text-weight-bold" id="netPayTD">0</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>

   


</body>

<!--EXTERNAL JAVASCRIPT-->
<script src="js/payslip-profile-individual.js"></script>

<script>
    let isOwnerHidden = document.getElementById('isOwnerHidden')
    let isDriverHidden = document.getElementById('isDriverHidden')
    let isHelperHidden = document.getElementById('isHelperHidden')

    logoutBtn.classList.remove("is-hidden");
    userBtn.innerHTML = "<?php echo $_SESSION['username'] ?>";
    userBtn.classList.remove("is-hidden");
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