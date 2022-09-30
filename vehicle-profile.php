<?php
//SESSION START
if (!isset($_SESSION)) {
    session_start();
}

/*
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["shipmentAccess"] === 'No') {
    header("location: dashboard-default.php");
    exit;
}
*/

include_once 'navbar.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group Profile</title>

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

        .container {
            margin-bottom: 5%;

        }

        /*
        @media (min-width: 1000px) {
            #registerBtn {
                float: left;
            }

            #returnBtn {
                float: right;
            }

        }
*/
        @media (max-width: 1000px) {

            #returnBtn {
                padding-top: 10px;
                padding-bottom: 10px;
                width: 45%;
            }

            #registerBtn {
                padding-top: 10px;
                padding-bottom: 10px;
                width: 45%;
            }

            #firstContainer {
                text-align: center !important;
            }
        }

        table {
            border: 1px solid #ccc;
            width: 100%;
            margin: 0;
            padding: 0;
            border-collapse: collapse;
            border-spacing: 0;
            table-layout: fixed;
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
    <div class="main">
        <div class="container" style="margin-bottom: 2%;" id="firstContainer">
            <p class="title is-hidden" id="arrayLengthHidden">sample</p>
            <p class="title is-hidden" id="test_indicator">Test</p>
            <p class="title is-hidden" id="indicator">Live Search Indicator</p>
            <button class="button is-rounded mb-5 has-background-grey has-text-white" id="returnBtn"><i class="fa-solid fa-arrow-left mr-3"></i>Return</button>

            <p class="title is-hidden" id="clientIdHidden"><?php echo $_SESSION["plateNumberVehicle"] ?></p>
            <p class="title is-hidden" id="areaIdHidden"></p>

        </div>

        <div class="container box">

            <p class="title has-text-centered is-3 has-text-black mt-6"><?php echo $_SESSION["plateNumberVehicle"] ?></p>

            <div id="card" class="mb-4 has-text-centered">
                <table>
                    <thead>
                        <tr>
                            <th style="text-align: center;">Shipment Number</th>
                            <th>Shipment Status</th>
                            <th>Billing</th>
                            <th>Payroll</th>
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
    </div>

</body>

<!--EXTERNAL JAVASCRIPT-->
<script src="js/vehicle-profile.js"></script>

<!--INTERNAL JAVASCRIPT-->
<script>
    logoutBtn.classList.remove("is-hidden");
    userBtn.innerHTML = "<?php echo $_SESSION['username'] ?>";
    userBtn.classList.remove("is-hidden");
    subcontractorVehicleBtn.classList.add("is-active");
    let access1 = document.getElementById('access1');
    let access2 = document.getElementById('access2');

    let access4 = document.getElementById('access4');
    let access5 = document.getElementById('access5');
    let access6 = document.getElementById('access6');

    if (access1.innerHTML == 'false') {
        shipmentBtn.classList.add("is-hidden");
    }
    if (access2.innerHTML == 'false') {
        employeeBtn.classList.add("is-hidden");
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