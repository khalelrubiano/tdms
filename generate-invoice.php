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
    <title>Generate Invoice</title>

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

        /* width */
        ::-webkit-scrollbar {
            width: 10px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        @media (min-width: 1000px) {
            #firstContainer {
                padding-bottom: 2%;
                border-bottom: 1px solid gray;
                text-align: center;
            }

            #returnBtn {
                float: left;
            }

            #shipmentDiv {
                height: 500px;
                overflow-y: auto;
            }


        }

        @media (max-width: 1000px) {

            #firstContainer {
                text-align: center !important;
            }

        }
    </style>
</head>

<body>
    <div class="main" style="margin-bottom: 20%;">

        <div class="container" id="firstContainer" style="margin-bottom: 2.5%;">
            <button class="button is-rounded mb-5 has-background-light has-text-black" id="returnBtn"><i class="fa-solid fa-arrow-left mr-3"></i>Return</button>
            <p class="title has-text-centered is-4">Generate Invoice</p>
            <p class="title is-hidden" id="shipmentIdHidden"><?php echo $_SESSION['shipmentId'] ?></p>
        </div>

        <div class="container" style="margin-bottom: 5%;" id="pdfbody">
            <div class="columns is-centered">
                <div class="column is-4 box m-4 p-6" style="height: 400px;">
                    <div class="field">
                        <label for="" class="label">Invoice Number</label>
                        <div class="control has-icons-left">
                            <input type="text" placeholder="Enter invoice number here" class="input is-rounded" name="invoiceNumberAdd" id="invoiceNumberAdd">
                            <span class="icon is-small is-left">
                                <i class="fa-solid fa-hashtag"></i>
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

                    <div class="field has-text-centered mt-6">
                        <button class="button is-info has-text-white is-rounded" name="submitAddForm" id="submitAddForm">
                            <i class="fa-solid fa-check mr-3"></i>Submit
                        </button>
                        <p class="help" id="submitAddFormHelp" style="text-align: center;"></p>
                    </div>
                </div>
                <div class="column box m-4 p-6">
                    <p class="title has-text-centered is-4">Shipments</p>
                    <div class="container has-text-centered" id="shipmentDiv">
                        <table class="table is-fullwidth is-bordered" id="shipmentTable">
                            <!--
                            <tr>
                                <td style="text-align: left;"><input type="checkbox" value="Bike" class="mr-3 mt-4 mb-4"> Shipment #123 - Date Delivered: 2022-09-22</td>
                            </tr>
    -->
                        </table>
                    </div>
                </div>
            </div>
        </div>

</body>

<!--EXTERNAL JAVASCRIPT-->
<script src="js/generate-invoice.js"></script>


<!--INTERNAL JAVASCRIPT-->
<script>
    logoutBtn.classList.remove("is-hidden");
    userBtn.innerHTML = "<?php echo $_SESSION['username'] ?>";
    userBtn.classList.remove("is-hidden");
    billingBtn.classList.add("is-active");

    let access1 = document.getElementById('access1');
    let access2 = document.getElementById('access2');
    let access3 = document.getElementById('access3');
    let access4 = document.getElementById('access4');

    let access6 = document.getElementById('access6');

    if (access1.innerHTML == 'false') {
        shipmentBtn.classList.add("is-hidden");
    }
    if (access2.innerHTML == 'false') {
        employeeBtn.classList.add("is-hidden");
    }
    if (access3.innerHTML == 'false') {
        subcontractorBtn.classList.add("is-hidden");
    }
    if (access4.innerHTML == 'false') {
        clientBtn.classList.add("is-hidden");
    }

    if (access6.innerHTML == 'false') {
        payrollBtn.classList.add("is-hidden");
    }
</script>

</html>