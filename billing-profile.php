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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--INTERNAL CSS-->
    <style>
        #companyLogo {
            height: 100px;
        }

        html {
            background-color: #f4faff;
        }

        .titleHeader {
            font-size: calc(14px + 0.390625vw) !important;
        }

        .subtitleHeader {
            font-size: calc(8px + 0.390625vw) !important;
        }

        table {
            table-layout: fixed;
        }

        #feesTable {
            text-align: center;
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

            #invoiceTitle,
            #shipmentSummaryTitle {
                font-size: calc(18px + 0.390625vw) !important;
            }
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
    </style>
</head>

<body>
    <div class="main" style="margin-bottom: 20%;">
        <div class="container firstContainer" style="margin-bottom: 5%;" id="firstContainer">
            <button class="button is-rounded mb-6 is-light" id="returnBtn"><i class="fa-solid fa-arrow-left mr-3"></i>Return</button>
            <button class="button is-rounded mb-5 has-background-primary has-text-white" id="updateBtn" onclick="updateBillingStatus()"><i class="fa-solid fa-check mr-3"></i>Mark as Settled</button>
            <button class="button is-rounded mb-6 is-link" id="downloadBtn"><i class="fa-solid fa-file-arrow-down mr-3"></i>Download PDF</button>
            <p class="title is-hidden" id="test_indicator">Test</p>
            <p class="title is-hidden" id="indicator">Live Search Indicator</p>
            <p class="title is-hidden" id="companyLogoHidden"></p>
            <p class="title is-hidden" id="billingIdHidden"><?php echo $_SESSION["billingId"] ?></p>
            <p class="title is-hidden" id="invoiceNumberHidden"></p>
            <p class="title is-hidden" id="invoiceStatusHidden"><?php echo $_SESSION["invoiceStatus"] ?></p>
        </div>
        <div class="container box" style="padding: 100px;" id="pdfbody">
            <div class="container" style="border-bottom: 1px solid black; margin-bottom: 50px">
                <p class="title is-3 has-text-centered" id="companyNameTD">TORTORS TRANSPORT SERVICES</p>
                <div class="columns">
                    <div class="column is-3 has-text-centered">
                        <img id="companyLogo">
                    </div>
                    <div class="column">
                        <table>
                            <tbody>
                                <tr>
                                    <td id="companyAddressTD">ADDRESS: BLK 35 L13 PHASE 1D GOLDEN CITY SUBD. BRGY DILA SANTA ROSA, LAGUNA</td>
                                </tr>
                                <tr>
                                    <td id="companyTinTD">VAT Reg. TIN: 767-969-330</td>
                                </tr>
                                <tr>
                                    <td id="companyEmailTD">EMAIL ADD: tortorstransportservice@gmail.com</td>
                                </tr>
                                <tr>
                                    <td id="companyNumberTD">CONTACT Nos.: (0917) 324 7582</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="container" style="margin-bottom: 50px;">
                <div class="columns">
                    <div class="column">
                        <table>
                            <tbody>
                                <tr>
                                    <td id="invoiceNumberTD">BILLING INVOICE: TTS2021-0155</td>
                                </tr>
                                <tr>
                                    <td id="coveredDateTD">COVERED DATE: AUGUST 09 - 20, 2022</td>
                                </tr>
                                <tr>
                                    <td id="invoiceDateTD">INVOICE DATE: SEPTEMBER 15, 2022</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="container" style="margin-bottom: 50px;">
                <div class="columns">
                    <div class="column">
                        <table>
                            <tbody>
                                <tr>
                                    <td id="clientTD">2GO LOGISTICS, INC.</td>
                                </tr>
                                <tr>
                                    <td id="clientTinTD">Tin # 006-600-713-000</td>
                                </tr>
                                <tr>
                                    <td id="clientAddressTD">8th Floor Tower 1, Double Dragon Plaza cor EDSA</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="container" style="margin-bottom: 200px;">
                <p class="title is-6">This is to bill you for trucking service:</p>
                <table class="table is-bordered is-fullwidth" id="feesTable">
                    <thead>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="table1TD">TRUCK COST:</td>
                            <td class="table1TD" id="truckCostTD">0</td>
                        </tr>
                        <tr>
                            <td class="table1TD">DROP FEE:</th>
                            <td class="table1TD" id="dropFeeTD">0</td>
                        </tr>

                        <tr>
                            <td class="table1TD">PARKING FEE:</td>
                            <td class="table1TD" id="parkingFeeTD">0</td>
                        </tr>

                        <tr>
                            <td class="table1TD">TOLL FEE:</td>
                            <td class="table1TD" id="tollFeeTD">0</td>
                        </tr>

                        <tr>
                            <td class="table1TD">FUEL CHARGE:</td>
                            <td class="table1TD" id="fuelChargeTD">0</td>
                        </tr>

                        <tr>
                            <td class="table1TD">EXTRA HELPER:</td>
                            <td class="table1TD" id="extraHelperTD">0</td>
                        </tr>

                        <tr>
                            <td class="table1TD">DEMURRAGE:</td>
                            <td class="table1TD" id="demurrageTD">0</td>
                        </tr>

                        <tr>
                            <td class="table1TD">OTHER MISC FEE:</td>
                            <td class="table1TD" id="miscFeeTD">0</td>
                        </tr>

                        <tr>
                            <td class="table1TD has-text-weight-bold">SUBTOTAL:</td>
                            <td class="table1TD" id="subtotalTD">0</td>
                        </tr>

                        <tr>
                            <td class="table1TD">12% VAT:</td>
                            <td class="table1TD" id="vatTD">0</td>
                        </tr>
                        <tr>
                            <td class="table1TD">LESS PENALTIES:</td>
                            <td class="table1TD" id="penaltyTD">0</td>
                        </tr>
                        <tr>
                            <td class="table1TD has-text-weight-bold">TOTAL TRUCKING CHARGES:</td>
                            <td class="table1TD" id="totalTD">0</td>
                        </tr>
                    </tbody>
                </table>
                <p class="title is-6 has-text-weight-bold">TERMS: Balance due in 30 days.</p>
            </div>
            <div class="container" style="margin-bottom: 100px;">
                <div class="columns">
                    <div class="column">
                        <p class="title is-6 has-text-weight-bold">Received by:_______________</p>
                    </div>
                    <div class="column has-text-centered">
                        <p class="title is-6 has-text-weight-bold" style="margin-bottom: 50px;">________________________________________</p>
                        <p class="title is-6 has-text-weight-bold">LOGISTIC MANAGER</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container box">
            <p class="title is-4 mb-6" id="shipmentSummaryTitle">Shipment Summary</p>
            <div id="card" class="mb-4 has-text-centered">
                <table id="shipmentTable">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Shipment Number</th>
                            <th>Area Rate</th>
                            <th>Vehicle Plate Number</th>
                            <th>Delivery Date</th>
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


    if (invoiceStatusHidden.innerHTML == "Settled") {
        updateBtn.classList.add("is-hidden");
    }

</script>

</html>