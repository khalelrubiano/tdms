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

include_once 'navbar-subcontractor.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle List</title>

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
        .container {
            margin-bottom: 5%;

        }

        @media (min-width: 1000px) {



            #searchBarForm {
                float: right;
            }

            #selectSortDiv {
                float: left;

            }

        }

        @media (max-width: 1000px) {

            #returnBtn {
                padding-top: 10px;
                padding-bottom: 10px;
            }

            #searchBarForm {
                padding-top: 10px;
                padding-bottom: 10px;
            }
        }

        .switch {
            position: relative;
            display: inline-block;
            margin-top: 2%;
            margin-right: 5%;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: green;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px green;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
</head>

<body>
    <div class="main">
        <div class="container">
            <p class="title " id="arrayLengthHidden">sample</p>
            <p class="title " id="test_indicator">Test</p>
            <p class="title " id="indicator">Live Search Indicator</p>
            <p class="title is-4 is-hidden" id="isOwnerHidden"><?php echo $_SESSION["isOwner"] ?></p>
            <p class="title is-4 is-hidden" id="isDriverHidden"><?php echo $_SESSION["isDriver"] ?></p>
            <p class="title is-4 is-hidden" id="isHelperHidden"><?php echo $_SESSION["isHelper"] ?></p>

            <p class="title is-hidden" id="vehicleIdHidden"></p>
            <div class="field" id="searchBarForm">
                <p class="control has-icons-right">
                    <input class="input is-rounded" type="text" placeholder="Search" id="searchBarInput">
                    <span class="icon is-small is-right">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                </p>
            </div>

            <div class="select is-rounded mr-3" id="selectSortDiv">
                <select id="selectSort">
                    <option value="vehicle.plate_number" selected>Sort By Plate Number</option>
                    <option value="vehicle.vehicle_status">Sort By Status</option>
                </select>
            </div>
        </div>

        <div class="container">


            <p class="title mb-6 mt-6 is-4 has-text-centered" id="vehicleHeader">Registered Vehicles:</p>

            <div class="tile is-ancestor is-vertical" id="ancestorTile">

            </div>
        </div>
    </div>

</body>

<!--EXTERNAL JAVASCRIPT-->
<script src="js/vehicle-list-subcontractor.js"></script>

<!--INTERNAL JAVASCRIPT-->
<script>
    let isOwnerHidden = document.getElementById('isOwnerHidden')
    let isDriverHidden = document.getElementById('isDriverHidden')
    let isHelperHidden = document.getElementById('isHelperHidden')

    logoutBtn.classList.remove("is-hidden");
    vehicleBtn.classList.add("is-active");

    if (isOwnerHidden.innerHTML == "Yes") {
        shipmentGroupBtn.classList.remove("is-hidden");
        shipmentIndividualBtn.classList.remove("is-hidden");
        payslipBtn.classList.remove("is-hidden");
        vehicleBtn.classList.remove("is-hidden");
    };

    if (isDriverHidden.innerHTML == "Yes" || isHelperHidden.innerHTML == "Yes") {
        shipmentIndividualBtn.classList.remove("is-hidden");
    };
    if (shipmentStatusHidden.innerHTML == "Completed" || isOwnerHidden.innerHTML == "Yes") {
        updateBtn.classList.add("is-hidden");
    };
</script>

</html>