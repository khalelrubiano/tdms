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
    <title>Shipment Fees</title>

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
        html {
            background-color: #f4faff;
        }

        .table1TH,
        .table1TD {
            padding: 10px !important;
            text-align: center !important;
            width: 50% !important;
        }

        @media (min-width: 1000px) {
            #firstContainer {
                padding-bottom: 2%;
                border-bottom: 1px solid gray;
                text-align: center;
            }

            #addBtn {
                float: left;
            }

            #returnBtn {
                float: right;
            }
        }

        @media (max-width: 1000px) {

            #addBtn {
                padding-top: 10px;
                padding-bottom: 10px;
                width: 45%;
            }

            #firstContainer {
                text-align: center !important;
            }

        }
    </style>
</head>

<body>
    <div class="main" style="margin-bottom: 20%;">
        <div class="container" id="firstContainer" style="margin-bottom: 2.5%;">
            <button class="button is-rounded mb-5 ml-1 is-link" id="addBtn" onclick="openAdd()"><i class="fa-solid fa-pen-to-square mr-3"></i>Set Shipment Fees</button>
            <button class="button is-rounded mb-5 has-background-light has-text-black" id="returnBtn"><i class="fa-solid fa-arrow-left mr-3"></i>Return</button>
            <p class="title has-text-centered is-4" id="shipmentNumberHeader">Shipment #<?php echo $_SESSION['shipmentNumber'] ?></p>
            <p class="title is-hidden" id="shipmentIdHidden"><?php echo $_SESSION['shipmentId'] ?></p>
        </div>

        <div class="container" style="margin-bottom: 5%;" id="pdfbody">
            <div class="columns is-centered">
                <div class="column is-12">

                    <table class="table is-bordered is-fullwidth">
                        <thead>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="table1TD has-text-weight-bold">Rate:</th>
                                <td class="table1TD" id="truckRateTD">0</th>
                            </tr>
                            <tr>
                                <td class="table1TD has-text-weight-bold">Drop Fee:</th>
                                <td class="table1TD" id="dropFeeTD">0</th>
                            </tr>
                            <tr>
                                <td class="table1TD has-text-weight-bold">Parking Fee:</th>
                                <td class="table1TD" id="parkingFeeTD">0</th>
                            </tr>
                            <tr>
                                <td class="table1TD has-text-weight-bold">Toll Fee:</th>
                                <td class="table1TD" id="tollFeeTD">0</th>
                            </tr>
                            <tr>
                                <td class="table1TD has-text-weight-bold">Fuel Charge:</th>
                                <td class="table1TD" id="fuelChargeTD">0</th>
                            </tr>
                            <tr>
                                <td class="table1TD has-text-weight-bold">Extra Helper Fee:</th>
                                <td class="table1TD" id="extraHelperFeeTD">0</th>
                            </tr>
                            <tr>
                                <td class="table1TD has-text-weight-bold">Demurrage:</th>
                                <td class="table1TD" id="demurrageTD">0</th>
                            </tr>
                            <tr>
                                <td class="table1TD has-text-weight-bold">Other Charges:</th>
                                <td class="table1TD" id="otherChargesTD">0</th>
                            </tr>
                            <tr>
                                <td class="table1TD has-text-weight-bold">Penalty:</th>
                                <td class="table1TD" id="penaltyTD">0</th>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>

    <!-- ADD MODAL START-->
    <div class="modal" id="addModal">
        <div class="modal-background" id="addModalBg"></div>
        <div class="modal-card p-4">

            <header class="modal-card-head has-background-info">
                <p class="modal-card-title has-text-white"><i class="fa-solid fa-plus mr-3"></i>Shipment Fees</p>
                <button class="delete" aria-label="close" onclick="closeAdd()"></button>
            </header>

            <section class="modal-card-body">

                <div class="field">
                    <label for="" class="label">Drop Fee</label>
                    <div class="control has-icons-left">
                        <input type="text" placeholder="Enter drop fee here" class="input is-rounded" name="dropFeeAdd" id="dropFeeAdd">
                        <span class="icon is-small is-left">
                            <i class="fa-solid fa-peso-sign"></i>
                        </span>
                    </div>
                    <p class="help" id="dropFeeAddHelp"></p>
                </div>

                <div class="field">
                    <label for="" class="label">Parking Fee</label>
                    <div class="control has-icons-left">
                        <input type="text" placeholder="Enter parking fee here" class="input is-rounded" name="parkingFeeAdd" id="parkingFeeAdd">
                        <span class="icon is-small is-left">
                            <i class="fa-solid fa-peso-sign"></i>
                        </span>
                    </div>
                    <p class="help" id="parkingFeeAddHelp"></p>
                </div>

                <div class="field">
                    <label for="" class="label">Toll Fee</label>
                    <div class="control has-icons-left">
                        <input type="text" placeholder="Enter toll fee here" class="input is-rounded" name="tollFeeAdd" id="tollFeeAdd">
                        <span class="icon is-small is-left">
                            <i class="fa-solid fa-peso-sign"></i>
                        </span>
                    </div>
                    <p class="help" id="tollFeeAddHelp"></p>
                </div>

                <div class="field">
                    <label for="" class="label">Fuel Charge</label>
                    <div class="control has-icons-left">
                        <input type="text" placeholder="Enter fuel charge here" class="input is-rounded" name="fuelChargeAdd" id="fuelChargeAdd">
                        <span class="icon is-small is-left">
                            <i class="fa-solid fa-peso-sign"></i>
                        </span>
                    </div>
                    <p class="help" id="fuelChargeAddHelp"></p>
                </div>

                <div class="field">
                    <label for="" class="label">Extra Helper Fee</label>
                    <div class="control has-icons-left">
                        <input type="text" placeholder="Enter extra helper fee here" class="input is-rounded" name="extraHelperFeeAdd" id="extraHelperFeeAdd">
                        <span class="icon is-small is-left">
                            <i class="fa-solid fa-peso-sign"></i>
                        </span>
                    </div>
                    <p class="help" id="extraHelperFeeAddHelp"></p>
                </div>

                <div class="field">
                    <label for="" class="label">Demurrage</label>
                    <div class="control has-icons-left">
                        <input type="text" placeholder="Enter demurrage here" class="input is-rounded" name="demurrageAdd" id="demurrageAdd">
                        <span class="icon is-small is-left">
                            <i class="fa-solid fa-peso-sign"></i>
                        </span>
                    </div>
                    <p class="help" id="demurrageAddHelp"></p>
                </div>

                <div class="field">
                    <label for="" class="label">Other Charges</label>
                    <div class="control has-icons-left">
                        <input type="text" placeholder="Enter other charges here" class="input is-rounded" name="otherChargesAdd" id="otherChargesAdd">
                        <span class="icon is-small is-left">
                            <i class="fa-solid fa-peso-sign"></i>
                        </span>
                    </div>
                    <p class="help" id="otherChargesAddHelp"></p>
                </div>

                <div class="field">
                    <label for="" class="label">Penalty</label>
                    <div class="control has-icons-left">
                        <input type="text" placeholder="Enter penalty here" class="input is-rounded" name="penaltyAdd" id="penaltyAdd">
                        <span class="icon is-small is-left">
                            <i class="fa-solid fa-peso-sign"></i>
                        </span>
                    </div>
                    <p class="help" id="penaltyAddHelp"></p>
                </div>

                <div class="field has-text-centered mt-6">
                    <button class="button is-info has-text-white is-rounded" name="submitAddForm" id="submitAddForm">
                        <i class="fa-solid fa-check mr-3"></i>Submit
                    </button>
                    <p class="help" id="submitAddFormHelp" style="text-align: center;"></p>
                </div>

            </section>
        </div>
    </div>
    <!-- ADD MODAL END-->
</body>

<!--EXTERNAL JAVASCRIPT-->
<script src="js/shipment-fees-profile.js"></script>


<!--INTERNAL JAVASCRIPT-->
<script>
    logoutBtn.classList.remove("is-hidden");
    userBtn.innerHTML = "<?php echo $_SESSION['username'] ?>";
    userBtn.classList.remove("is-hidden");
    shipmentBtn.classList.add("is-active");


    let access2 = document.getElementById('access2');
    let access3 = document.getElementById('access3');
    let access4 = document.getElementById('access4');
    let access5 = document.getElementById('access5');
    let access6 = document.getElementById('access6');


    if (access2.innerHTML == 'false') {
        employeeBtn.classList.add("is-hidden");
    }
    if (access3.innerHTML == 'false') {
        subcontractorBtn.classList.add("is-hidden");
    }
    if (access4.innerHTML == 'false') {
        clientBtn.classList.add("is-hidden");
    }
    if (access5.innerHTML == 'false') {
        billingBtn.classList.add("is-hidden");
    }
    if (access6.innerHTML == 'false') {
        payrollBtn.classList.add("is-hidden");
    }
</script>

</html>