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
    <title>Shipment Profile</title>

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
    <script src='https://unpkg.com/maplibre-gl@2.4.0/dist/maplibre-gl.js'></script>
    <link href='https://unpkg.com/maplibre-gl@2.4.0/dist/maplibre-gl.css' rel='stylesheet' />
    <!--INTERNAL CSS-->
    <style>
        .progressbar {
            counter-reset: step;
        }

        .progressbar li {
            list-style-type: none;
            /*width: 25%;*/
            float: left;
            font-size: 12px;
            position: relative;
            text-align: center;
            text-transform: uppercase;
            color: black;
        }

        .inProgressLi:before {
            width: 30px;
            height: 30px;
            content: '✖';
            counter-increment: step;
            line-height: 30px;
            border: 2px solid #7d7d7d;
            display: block;
            text-align: center;
            margin: 0 auto 10px auto;
            border-radius: 50%;
            background-color: #7d7d7d;
        }

        .inProgressLi:after {
            width: 100%;
            height: 5px;
            content: '';
            position: absolute;
            background-color: #7d7d7d;
            top: 15px;
            left: -50%;
            z-index: -1;
        }

        .transferLi:before {
            width: 30px;
            height: 30px;
            content: '✖';
            counter-increment: step;
            line-height: 30px;
            border: 2px solid #7d7d7d;
            display: block;
            text-align: center;
            margin: 0 auto 10px auto;
            border-radius: 50%;
            background-color: #7d7d7d;
        }

        .transferLi:after {
            width: 100%;
            height: 5px;
            content: '';
            position: absolute;
            background-color: #7d7d7d;
            top: 15px;
            left: -50%;
            z-index: -1;
        }

        .cancelLi:before {
            width: 30px;
            height: 30px;
            content: '✖';
            counter-increment: step;
            line-height: 30px;
            border: 2px solid #7d7d7d;
            display: block;
            text-align: center;
            margin: 0 auto 10px auto;
            border-radius: 50%;
            background-color: #7d7d7d;
        }

        .cancelLi:after {
            width: 100%;
            height: 5px;
            content: '';
            position: absolute;
            background-color: #7d7d7d;
            top: 15px;
            left: -50%;
            z-index: -1;
        }

        .progressbar li:first-child:after {
            content: none;
        }

        .transferLiActive:last-child:after {
            background-color: yellow;
        }

        .cancelLiActive:last-child:after {
            background-color: red;
        }

        .progressbar li.active {
            color: white;

        }

        .inProgressLiActive:before {
            background-color: #55b776;
            border-color: #55b776;
            content: '✔';

        }

        .inProgressLiActive+.inProgressLiActive:after {
            background-color: #55b776;
        }

        .transferLiActive:before {
            background-color: yellow;
            border-color: yellow;
            content: '!';

        }

        .transferLiActive+.transferLiActive:after {
            background-color: yellow;
        }

        .cancelLiActive:before {
            background-color: red;
            border-color: red;
            content: '✖';

        }

        .cancelLiActive+.cancelLiActive:after {
            background-color: red;
        }


        .left-td {
            float: right;
        }

        /*BREAK*/
        /*
        .verticalContainer {
            padding: 20px 40px; 
            font-size: 14px;
        }
*/
        .verticalContainer ul {
            position: relative;
            list-style: none;
            padding: 0;
        }

        .verticalContainer ul:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            background-color: #ddd;
            width: 3px;
            height: 100%;
        }

        .verticalContainer ul li {
            padding: 30px 30px;
            position: relative;
            font-size: calc(4px + 0.390625vw) !important;
        }

        .selected div {
            color: tomato;
        }

        .verticalContainer li span {
            position: absolute;
            left: -40px;
            font-size: calc(4px + 0.390625vw) !important;
            background-color: #fff;
            padding: 10px 0;
            top: 20px;
            color: #aaa;
        }

        .verticalContainer li div {
            margin-left: 50px;
        }


        #map {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }

        #map {
            position: absolute;
            top: 0;
            bottom: 0;
            /*
            width: 100%;
            */
            z-index: -2;
        }

        .marker {
            display: block;
            border: none;
            cursor: pointer;
            padding: 0;
        }

        .mapboxgl-popup {
            max-width: 400px;
            font: 12px/20px 'Helvetica Neue', Arial, Helvetica, sans-serif;
        }



        .dropdown {
            position: absolute;

            top: 15vh;
            left: 350px;

        }

        .dropdown-item {
            width: 25vw;
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

        ::-webkit-scrollbar {
            width: 0px;
            background: transparent;
            /* make scrollbar transparent */
        }

        /*
        .mapboxgl-popup-tip {
            display: none;
        }
*/
        @media (min-width: 1000px) {

            #shipmentTitle {
                margin-bottom: 10px;
                font-size: calc(20px + 0.390625vw) !important;
            }

            .progressbar li {
                font-size: calc(3px + 0.390625vw) !important;
            }

            #progressBarDiv {
                margin-bottom: 100px !important;
            }

            #progressLogDiv {
                max-height: 200px !important;
                overflow-x: auto !important;
                margin-bottom: 5px !important;
            }

            #infoDiv {
                padding-top: 30px !important;
                max-height: 200px !important;
                overflow-x: auto !important;
                margin-bottom: 0px !important;

            }

            .verticalContainer {
                margin-left: 10%;
            }

            #dateOfDeliveryTitle,
            #dateOfDeliverySubtitle,
            #destinationTitle,
            #destinationSubtitle,
            #clientNameTitle,
            #clientNameSubtitle,
            #personnelTitle,
            #driverSubtitle,
            #helperSubtitle,
            #plateNumberSubtitle,
            #typeTitle,
            #vehicleTypeSubtitle,
            #titleSpan {
                font-size: calc(6px + 0.390625vw);
            }

            #shipmentDescriptionTitle {
                font-size: calc(10px + 0.390625vw);
            }

            #shipmentDescriptionSubtitle {
                font-size: calc(8px + 0.390625vw);
            }

            #buttonDiv {
                position: absolute;

                z-index: 2;

                top: 15vh;
                left: 510px;

            }

            #personnelDiv {
                position: absolute;

                z-index: 3;

                top: 15vh;
                right: 50px;

                max-width: 20vw;
            }

            table {
                table-layout: fixed;
            }

            td {
                text-align: left !important;
                white-space: nowrap;
                font-size: calc(8px + 0.390625vw);
            }

            /*
            #returnBtn {
                position: absolute;

                z-index: 2;

                top: 15vh;
                left: 510px;

            }

            #transferBtn {
                position: absolute;

                z-index: 2;

                top: 15vh;
                left: 625px;

            }

            #cancelBtn {
                position: absolute;

                z-index: 2;

                top: 15vh;
                left: 755px;

            }
*/
            .dropdown-menu {
                height: 80vh !important;
                overflow-x: auto !important;
            }

        }

        /*
#shipmentTitle {
    float: right;
    padding-right: 100px;
}
*/
        /*
            .firstContainer {
                border-bottom: 1px solid gray;
            }


            #mapContainer {
                height: 500px;
            }

        }
*/
        @media (max-width: 1000px) {



            #shipmentTitle {
                margin-bottom: 10px;
                font-size: calc(20px + 0.390625vw) !important;
            }

            .verticalContainer {
                margin-left: 10%;
            }

            #progressBarDiv {
                margin-bottom: 100px !important;
            }

            #progressLogDiv {
                max-height: 200px !important;
                overflow-x: auto !important;
                margin-bottom: 0px !important;
            }

            #infoDiv {
                max-height: 200px !important;
                overflow-x: auto !important;
                margin-bottom: 0px !important;
            }

            #mapContainer {
                height: 250px;
            }

            .inProgressLi:before,
            .transferLi:before,
            .cancelLi:before {

                line-height: 3;

            }

            .dropdown {
                position: absolute !important;

                top: 17vh !important;
                left: 5vw !important;
                /*
                z-index: -4;
                */

            }

            .dropdown-item {
                width: 90vw;

            }

            #buttonDiv {
                position: absolute !important;

                bottom: 5vh !important;
                right: 5vw !important;

                z-index: 2;

            }

            #personnelDiv {
                position: absolute;

                z-index: 3;

                bottom: 15vh;
                right: 5vw;

                width: 90vw;
            }

            table {
                table-layout: fixed;
            }

            td {
                text-align: left !important;
                white-space: nowrap;
                font-size: calc(10px + 0.390625vw);
            }

            /*
            #returnBtn {
                position: absolute !important;

                bottom: 5vh !important;
                right: 5vw !important;

                z-index: 2;

                width: 70px !important;
            }

            #transferBtn {
                position: absolute;

                z-index: 2;

                bottom: 5vh;
                right: 30vw;

                width: 70px !important;
            }

            #cancelBtn {
                position: absolute;

                z-index: 2;

                bottom: 5vh;
                right: 55vw;

                width: 70px !important;
            }
*/
            #dateOfDeliveryTitle,
            #dateOfDeliverySubtitle,
            #destinationTitle,
            #destinationSubtitle,
            #clientNameTitle,
            #clientNameSubtitle,
            #personnelTitle,
            #driverSubtitle,
            #helperSubtitle,
            #plateNumberSubtitle,
            #typeTitle,
            #vehicleTypeSubtitle,
            #titleSpan {
                font-size: calc(12px + 0.390625vw);
            }

            #shipmentDescriptionTitle {
                font-size: calc(12px + 0.390625vw);
            }

            #shipmentDescriptionSubtitle {
                font-size: calc(12px + 0.390625vw);
            }

            .dropdown-menu {
                height: 70vh !important;
                overflow-x: auto !important;
            }

            .progressbar li {
                font-size: calc(6px + 0.390625vw) !important;
            }

            .verticalContainer ul li {
                font-size: calc(6px + 0.390625vw) !important;
            }

            .verticalContainer li span {

                font-size: calc(6px + 0.390625vw) !important;

            }
        }

        /*
        .modal,
        .modal-background,
        .modal-card {
            z-index: 7 !important;
        }
        */

        /* keep code for progress bar, but container needs position attribute and z-index to work */

        .dropdown-content {
            position: relative;
            z-index: -9999 !important;
        }
    </style>
</head>

<body>

    <div class="mainAlt">
        <div id="buttonDiv">
            <div class="columns">
                <div class="column">
                    <button class="button mb-5 is-light" id="transferBtn"><i class="fa-solid fa-truck-arrow-right mr-3"></i>Transfer</button>
                    <button class="button mb-5 is-light" id="cancelBtn"><i class="fa-solid fa-ban mr-3"></i>Cancel</button>
                    <button class="button mb-5 is-light" id="returnBtn"><i class="fa-solid fa-arrow-left mr-3"></i>Return</button>
                </div>
            </div>

        </div>

        <div id="personnelDiv">
            <div class="card">
                <div class="card-content">
                    <div class="content">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="has-text-weight-bold">Plate Number:</td>
                                    <td><?php echo $_SESSION["plateNumber"] ?></td>
                                </tr>
                                <tr>
                                    <td class="has-text-weight-bold">Type:</td>
                                    <td><?php echo $_SESSION["vehicleType"] ?></td>
                                </tr>
                                <tr>
                                    <td class="has-text-weight-bold">Driver:</td>
                                    <td id="driverSubtitle2"></td>
                                </tr>
                                <tr>
                                    <td class="has-text-weight-bold">Helper:</td>
                                    <td id="helperSubtitle2"></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="dropdown is-active" id="dropdownElement">
            <div class="dropdown-trigger">
                <button class="button" aria-haspopup="true" aria-controls="dropdown-menu2" id="dropdownBtn">
                    <span id="titleSpan">Shipment Details</span>
                    <span class="icon is-small">
                        <i class="fas fa-angle-down" aria-hidden="true"></i>
                    </span>
                </button>
            </div>
            <div class="dropdown-menu" id="dropdown-menu2" role="menu">
                <div class="dropdown-content">
                    <div class="dropdown-item">
                        <p class="title is-4" id="shipmentTitle">Shipment <i class="fa-solid fa-hashtag"></i><?php echo "" . $_SESSION["shipmentNumber"] ?></p>
                    </div>

                    <hr class="dropdown-divider">
                    <div class="dropdown-item" id="descriptionDiv">
                        <p class="title mb-6" id="shipmentDescriptionTitle">Description:</p>
                        <p class="subtitle" id="shipmentDescriptionSubtitle"><?php echo $_SESSION["shipmentDescription"] ?></p>
                    </div>

                    <hr class="dropdown-divider">
                    <div class="dropdown-item" id="progressBarDiv">

                        <ul class="progressbar" id="progressbarId">
                        </ul>

                    </div>

                    <hr class="dropdown-divider">
                    <div class="dropdown-item" id="progressLogDiv">
                        <div class="container verticalContainer has-text-centered" style="padding: 10%;">
                            <ul id="verticalContainerUl">

                            </ul>
                        </div>
                    </div>

                    <hr class="dropdown-divider">
                    <div class="dropdown-item" id="infoDiv">
                        <div class="container">
                            <div class="tile is-ancestor">
                                <div class="tile is-parent">
                                    <div class="tile is-child">
                                        <p class="title is-6 mb-6" id="clientNameTitle">Client:</p>
                                        <p class="subtitle is-6" id="clientNameSubtitle" style="margin-bottom: 75px;"><?php echo $_SESSION["clientName"] ?></p>
                                        <p class="title is-6 mb-6" id="dateOfDeliveryTitle">Date of Delivery:</p>
                                        <p class="subtitle is-6" id="dateOfDeliverySubtitle" style="margin-bottom: 75px;"><?php echo $_SESSION["dateOfDelivery"] ?></p>
                                        <p class="title is-6 mb-6" id="destinationTitle">Destination:</p>
                                        <p class="subtitle is-6" id="destinationSubtitle" style="margin-bottom: 75px;"><?php echo $_SESSION["destination"] . ', ' . $_SESSION["areaName"] ?></p>


                                    </div>

                                    <div class="tile is-child">
                                        <p class="title is-6 mb-6" id="personnelTitle">Personnel:</p>
                                        <p class="subtitle is-6" id="driverSubtitle">sample</p>
                                        <p class="subtitle is-6" id="helperSubtitle">sample</p>
                                        <p class="subtitle is-6" id="plateNumberSubtitle" style="margin-bottom: 75px;">Plate Number: <?php echo $_SESSION["plateNumber"] ?></p>
                                        <p class="title is-6 mb-6" id="typeTitle">Vehicle Type:</p>
                                        <p class="subtitle is-6" id="vehicleTypeSubtitle" style="margin-bottom: 75px;"><?php echo $_SESSION["vehicleType"] ?></p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- CANCEL MODAL START-->
    <div class="modal" id="cancelModal">
        <div class="modal-background" id="cancelModalBg"></div>
        <div class="modal-card p-4">

            <header class="modal-card-head has-background-light">
                <p class="modal-card-title has-text-black"><i class="fa-solid fa-ban mr-3"></i>Cancel Shipment</p>
                <button class="delete" aria-label="close" onclick="closeCancel()"></button>
            </header>

            <section class="modal-card-body">


                <div class="field">
                    <label for="" class="label">Reason for Cancellation</label>
                    <div class="control">
                        <label class="radio">
                            <input type="radio" name="cancellationReason" value="Failed Delivery">
                            Failed Delivery
                        </label>
                        <br>
                        <label class="radio">
                            <input type="radio" name="cancellationReason" value="Incorrect Shipment">
                            Incorrect Shipment
                        </label>
                        <br>
                        <label class="radio">
                            <input type="radio" name="cancellationReason" value="Others">
                            Others, specify:
                        </label>
                    </div>
                    <p class="help" id="cancellationReasonHelp"></p>
                </div>


                <div class="field">
                    <label for="" class="label"></label>
                    <div class="control">
                        <textarea class="textarea" placeholder="Enter reason here" name="othersCancellationReason" id="othersCancellationReason" style="resize: none;"></textarea>
                    </div>
                    <p class="help" id="othersCancellationReasonHelp"></p>
                </div>

                <div class="field has-text-centered mt-6">
                    <button class="button is-dark has-text-white is-rounded" name="submitCancelForm" id="submitCancelForm">
                        <i class="fa-solid fa-check mr-3"></i>Submit
                    </button>
                    <p class="help" id="submitCancelFormHelp" style="text-align: center;"></p>
                </div>

            </section>
        </div>
    </div>
    <!-- CANCEL MODAL END-->

    <!-- TRANSFER MODAL START-->
    <div class="modal" id="transferModal">
        <div class="modal-background" id="transferModalBg"></div>
        <div class="modal-card p-4">

            <header class="modal-card-head has-background-light">
                <p class="modal-card-title has-text-black"><i class="fa-solid fa-truck-arrow-right mr-3"></i>Transfer Shipment</p>
                <button class="delete" aria-label="close" onclick="closeTransfer()"></button>
            </header>

            <section class="modal-card-body">

                <div class="field">

                    <div class="field mb-6">
                        <label for="" class="label">Transfer to</label>
                        <div class="control">
                            <div class="select is-rounded" id="vehicleTransferDiv">
                                <select id="vehicleTransfer" name="vehicleTransfer">
                                </select>
                            </div>
                        </div>
                        <p class="help" id="vehicleTransferHelp"></p>
                    </div>

                    <label for="" class="label">Reason for Transfer</label>
                    <div class="control">
                        <label class="radio">
                            <input type="radio" name="transferReason" value="Failed Delivery">
                            Failed Delivery
                        </label>
                        <br>
                        <label class="radio">
                            <input type="radio" name="transferReason" value="Incorrect Shipment">
                            Incorrect Shipment
                        </label>
                        <br>
                        <label class="radio">
                            <input type="radio" name="transferReason" value="Others">
                            Others, specify:
                        </label>
                    </div>
                    <p class="help" id="transferReasonHelp"></p>
                </div>


                <div class="field">
                    <label for="" class="label"></label>
                    <div class="control">
                        <textarea class="textarea" placeholder="Enter reason here" name="othersTransferReason" id="othersTransferReason" style="resize: none;"></textarea>
                    </div>
                    <p class="help" id="othersTransferReasonHelp"></p>
                </div>



                <div class="field has-text-centered mt-6">
                    <button class="button is-dark has-text-white is-rounded" name="submitTransferForm" id="submitTransferForm">
                        <i class="fa-solid fa-check mr-3"></i>Submit
                    </button>
                    <p class="help" id="submitTransferFormHelp" style="text-align: center;"></p>
                </div>

            </section>
        </div>
    </div>
    <!-- TRANSFER MODAL END-->

    <!-- TRANSFER CONFIRM MODAL START-->
    <div class="modal" id="transferConfirmModal">
        <div class="modal-background" id="transferConfirmModalBg"></div>
        <div class="modal-card p-4">

            <header class="modal-card-head has-background-light">
                <p class="modal-card-title has-text-black"><i class="fa-solid fa-circle-exclamation mr-3"></i>Confirm Transfer</p>

            </header>

            <section class="modal-card-body">
                <div class="columns is-centered">
                    <div class="column has-text-centered">
                        <p class="title is-5" id="shipmentTransferHeader"> Transfer Shipment #10</p>
                        <p class="title is-6" id="fromTransferHeader">From: ABC-123 (AUV)</p>
                        <p class="title is-6" id="toTransferHeader">To: VBN-420 (AUV)</p>
                    </div>
                </div>

                <div class="mt-6 box">
                    <p class="title is-5">Reason for Transfer:</p>
                    <p class="title is-6" id="reasonTransferHeader">Vehicle Failure</p>
                </div>


                <div class="field has-text-centered mt-6">
                    <button class="button is-info has-text-white is-rounded" name="confirmTransferForm" id="confirmTransferForm">
                        <i class="fa-solid fa-check mr-3"></i>Confirm
                    </button>

                    <button class="button has-background-grey-dark has-text-white is-rounded" name="cancelTransferForm" id="cancelTransferForm">
                        <i class="fa-solid fa-ban mr-3"></i>Cancel
                    </button>
                </div>
            </section>
        </div>
    </div>
    <!-- TRANSFER CONFIRM MODAL END-->

    <!-- CANCEL CONFIRM MODAL START-->
    <div class="modal" id="cancelConfirmModal">
        <div class="modal-background" id="cancelConfirmModalBg"></div>
        <div class="modal-card p-4">

            <header class="modal-card-head has-background-light">
                <p class="modal-card-title has-text-black"><i class="fa-solid fa-circle-exclamation mr-3"></i>Confirm Cancel</p>

            </header>

            <section class="modal-card-body">
                <div class="columns is-centered">
                    <div class="column has-text-centered">
                        <p class="title is-5" id="shipmentCancelHeader"> Cancel Shipment #10</p>
                        <p class="title is-6" id="vehicleCancelHeader">Vehicle: ABC-123 (AUV)</p>
                    </div>
                </div>

                <div class="mt-6 box">
                    <p class="title is-5">Reason for Cancellation:</p>
                    <p class="title is-6" id="reasonCancelHeader">Vehicle Failure</p>
                </div>


                <div class="field has-text-centered mt-6">
                    <button class="button is-info has-text-white is-rounded" name="confirmCancelForm" id="confirmCancelForm">
                        <i class="fa-solid fa-check mr-3"></i>Confirm
                    </button>

                    <button class="button has-background-grey-dark has-text-white is-rounded" name="cancelCancelForm" id="cancelCancelForm">
                        <i class="fa-solid fa-ban mr-3"></i>Cancel
                    </button>
                </div>
            </section>
        </div>
    </div>
    <!-- CANCEL CONFIRM MODAL END-->

    <div id="map"></div>


    <div class="container is-hidden" style="margin-bottom: 20%;">
        <div class="container firstContainer" style="margin-bottom: 5%;">

            <p class="title is-4 is-hidden" id="shipmentNumberHidden"><?php echo $_SESSION["shipmentNumber"] ?></p>
            <p class="title is-4 is-hidden" id="shipmentTitleHidden"><?php echo $_SESSION["shipmentId"] ?></p>
            <p class="title is-4 is-hidden" id="areaIdHidden"><?php echo $_SESSION["areaId"] ?></p>
            <p class="title is-4 is-hidden" id="vehicleIdHidden"><?php echo $_SESSION["plateNumber"] ?></p>
            <p class="title is-4 is-hidden" id="driverIdHidden"><?php echo $_SESSION["driverId"] ?></p>
            <p class="title is-4 is-hidden" id="helperIdHidden"><?php echo $_SESSION["helperId"] ?></p>
            <p class="title is-4 is-hidden" id="vehicleTypeHidden"><?php echo $_SESSION["vehicleType"] ?></p>
            <p class="title is-4 is-hidden" id="shipmentStatusHidden"><?php echo $_SESSION["shipmentStatus"] ?></p>
            <p class="title is-4 is-hidden" id="indicatorHidden">result here</p>
        </div>

        <!-- MAP -->
        <div class="container" id="mapContainer">
            <div id="map"></div>
        </div>
        <!-- MAP -->

        <!-- DESCRIPTION -->
        <div class="container" style="padding: 50px;">




        </div>
        <!-- DESCRIPTION -->



        <!-- PROGRESS BAR + LOG -->



        <!-- DETAILS ******************************* USE TILES WITH THREE COLUMNS ****************************** -->
        <div class="container" style="padding-left: 50px; padding-right: 50px">
            <div class="tile is-ancestor">
                <div class="tile is-parent">
                    <div class="tile is-child">
                        <p class="title is-5 mb-6">Expected Date of Delivery:</p>
                        <p class="subtitle is-6" id="dateOfDeliverySubtitle" style="margin-bottom: 75px;"><?php echo $_SESSION["dateOfDelivery"] ?></p>
                        <p class="title is-5 mb-6">Destination:</p>
                        <p class="subtitle is-6" id="destinationSubtitle" style="margin-bottom: 75px;"><?php echo $_SESSION["destination"] ?></p>
                        <p class="title is-5 mb-6">Client:</p>
                        <p class="subtitle is-6" id="clientNameSubtitle" style="margin-bottom: 75px;"><?php echo $_SESSION["clientName"] ?></p>

                    </div>
                    <div class="tile is-child">
                        <p class="title is-5 mb-6">Personnel:</p>
                        <p class="subtitle is-6" id="driverSubtitle"></p>
                        <p class="subtitle is-6" id="helperSubtitle"></p>
                        <p class="subtitle is-6" id="plateNumberSubtitle" style="margin-bottom: 75px;"></p>
                    </div>
                </div>
            </div>

        </div>
        <!-- DETAILS ******************************* USE TILES WITH THREE COLUMNS ****************************** -->



    </div>

</body>

<!--EXTERNAL JAVASCRIPT-->
<script src="js/shipment-profile.js"></script>


<!--INTERNAL JAVASCRIPT-->
<script>
    logoutBtn.classList.remove("is-hidden");
    userBtn.innerHTML = "<?php echo $_SESSION['username'] ?>";
    userBtn.classList.remove("is-hidden");
    shipmentBtn.classList.add("is-active");
    /*
        var el = document.createElement('div');
        el.classList.add('marker');
        //el.innerHTML = "<h1 class='title is-6'><i class='fa-solid fa-truck fa-2xl'></i></h1>";
        el.setAttribute("style", "background: url(green_marker.png) no-repeat center center fixed; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;");
        //el.setAttribute("style", "background-color: #cccccc; height: 50px; background-position: center; background-repeat: no-repeat; background-size: cover;");
        el.style.width = '60px';
        el.style.height = '60px';
    */


    // You can remove the following line if you don't need support for RTL (right-to-left) labels:
    //maplibregl.setRTLTextPlugin('https://cdn.maptiler.com/mapbox-gl-js/plugins/mapbox-gl-rtl-text/v0.2.3/mapbox-gl-rtl-text.js');
    /*
    var map = new maplibregl.Map({
        container: 'map',
        style: 'https://api.maptiler.com/maps/streets/style.json?key=MROowlWHhkfBGNBrkA3C',
        center: [121.261588, 14.295503],
        zoom: 7
    });*/
    /*
        var map = new maplibregl.Map({
            container: 'map', // container id
            style: 'https://api.maptiler.com/maps/streets/style.json?key=MROowlWHhkfBGNBrkA3C', // style URL
            center: [121.261588, 14.295503], // starting position [lng, lat]
            zoom: 5 // starting zoom
        });*/
    //var laguna = new maplibregl.Marker(el).setLngLat([121.261588, 14.295503]).addTo(map);
    /*
        var laguna_popup = new maplibregl.Popup({
            closeButton: false
        }).setLngLat([121.261588, 14.295503]).setHTML("<h1 class='title is-6'><i class='fa-solid fa-truck fa-2x'></i></h1>").addTo(map);
    */
    //laguna_popup.togglePopup();

    /*
        el.addEventListener('click', function() {
            new maplibregl.Popup({
                closeButton: false
            }).setLngLat([121.261588, 14.295503]).setHTML("<h1 class='title is-6'><i class='fa-solid fa-truck fa-2x'></i></h1>").addTo(map);
        });
    */
    // add marker to map
    //new maplibregl.Marker(el).setLngLat(marker.geometry.coordinates).addTo(map);
    /*
        var popup = new maplibregl.Popup({
            closeButton: false,
            closeOnClick: false
        });

        let lat, long, update_time;


        var map = new maplibregl.Map({
            container: 'map', // container id
            style: 'https://api.maptiler.com/maps/streets/style.json?key=MROowlWHhkfBGNBrkA3C', // style URL
            center: [long, lat],
            zoom: 12
        });

        map.on('mouseover', function() {
            map.getCanvas().style.cursor = 'pointer';
            popup.setLngLat([long, lat]).setHTML("<h1 class='title is-6 p-1'><i class='fa-solid fa-clock mr-3'></i>" + "Last Update: </h1> <h1 class='subtitle is-6 p-1'>" + update_time + "</h1>").addTo(map);
            map.flyTo({
                center: [long, lat],
                zoom: 12
            });
        });

        map.on('mouseout', function() {
            map.getCanvas().style.cursor = '';
            popup.remove();
        });
    */


    //map.addEventListener('mouseover', function() {
    // Change the cursor style as a UI indicator.
    //alert('SAMPLE');
    // map.getCanvas().style.cursor = 'pointer';
    /*
            var coordinates = e.features[0].geometry.coordinates.slice();
            var description = e.features[0].properties.description;

            // Ensure that if the map is zoomed out such that multiple
            // copies of the feature are visible, the popup appears
            // over the copy being pointed to.
            while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
                coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
            }
    */
    // Populate the popup and set its coordinates
    // based on the feature found.
    //popup.setLngLat([long, lat]).setHTML("<h1 class='title is-6 p-1'><i class='fa-solid fa-clock mr-3'></i>" + "Last Update: </h1> <h1 class='subtitle is-6 p-1'>" + update_time + "</h1>").addTo(map);
    //alert("mouse on");
    //});
    /*
        mapContainer.addEventListener('mouseout', function() {
            map.getCanvas().style.cursor = '';
            popup.remove();
            //alert("mouse off");
        });*/
    //popup.setLngLat([long, lat]).setHTML("<h1 class='title is-6 p-1'><i class='fa-solid fa-clock mr-3'></i>" + "Last Update: </h1> <h1 class='subtitle is-6 p-1'>" + update_time + "</h1>").addTo(map);
</script>

</html>