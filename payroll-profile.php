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
    </style>
</head>

<body>
    <div class="main" style="margin-bottom: 20%;">
        <div class="container firstContainer" style="margin-bottom: 5%;">
            <button class="button is-rounded mb-5 is-light" id="returnBtn"><i class="fa-solid fa-arrow-left mr-3"></i>Return</button>
            <button class="button is-rounded mb-5 is-light" id="updateBtn" onclick="updatePayrollStatus()"><i class="fa-solid fa-check mr-3"></i>Mark as Settled</button>
            <p class="title is-4 has-text-centered" id="payrollTitle">Batch <i class="fa-solid fa-hashtag"></i><?php echo "" . $_SESSION["payrollId"] ?></p>
            <p class="title is-4 is-hidden" id="payrollStatusHidden"><?php echo $_SESSION["payrollStatus"] ?></p>
            <p class="title is-4 is-hidden" id="billingIdHidden"><?php echo $_SESSION["billingId"] ?></p>
            <p class="title is-4 is-hidden" id="invoiceNumberHidden"><?php echo $_SESSION["invoiceNumber"] ?></p>
            <p class="title is-4 is-hidden" id="invoiceDateHidden"><?php echo $_SESSION["invoiceDate"] ?></p>
            <p class="title " id="arrayLengthHidden">sample</p>
            <p class="title is-hidden" id="test_indicator">Test</p>
            <p class="title is-hidden" id="indicator">Live Search Indicator</p>
        </div>



        <div class="container" style="margin-bottom: 10%;">
            <p class="title is-4 mb-6" id="statusHeader">Status: <?php echo "" . $_SESSION["payrollStatus"] ?></p>

            <p class="subtitle is-5 mb-4">Invoice Number: <?php echo "" . $_SESSION["invoiceNumber"] ?></p>
            <p class="subtitle is-5 mb-4">Invoice Date: <?php echo "" . $_SESSION["invoiceDate"] ?></p>

        </div>

        <div class="container" style="margin-bottom: 5%;">

            <p class="title is-4 mb-6 has-text-centered" id="summaryHeader">Payroll Summary</p>

            <div class="tile is-ancestor is-vertical" id="ancestorTile">

            </div>

        </div>
    </div>



</body>

<!--EXTERNAL JAVASCRIPT-->
<script src="js/payroll-profile.js"></script>


<!--INTERNAL JAVASCRIPT-->
<script>
    logoutBtn.classList.remove("is-hidden");
    payrollBtn.classList.add("is-active");
    /*
        if (billingStatusHidden.innerHTML == "Settled") {
            updateBtn.classList.add("is-hidden");
        }
    */
</script>

</html>