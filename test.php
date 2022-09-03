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
    <script src="https://cdn.maptiler.com/maplibre-gl-js/v2.1.1/maplibre-gl.js"></script>
    <link href="https://cdn.maptiler.com/maplibre-gl-js/v2.1.1/maplibre-gl.css" rel="stylesheet" />
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

        @media (min-width: 1000px) {

            #shipmentTitle {
                float: right;
                padding-right: 100px;
            }

            .firstContainer {
                border-bottom: 1px solid gray;
            }

            #mapContainer {
                height: 500px;
            }
        }

        @media (max-width: 1000px) {
            #shipmentTitle {
                margin-bottom: 50px;
            }

            .verticalContainer {
                margin-top: 150px;
            }

            #mapContainer {
                height: 250px;
            }
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
        }

        .selected div {
            color: tomato;
        }

        .verticalContainer li span {
            position: absolute;
            left: -45px;
            font-size: 12px;
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
    </style>
</head>

<body>
    <div class="main" style="margin-bottom: 20%;">
        <div class="container firstContainer" style="margin-bottom: 5%;">
            <button class="button is-rounded mb-5 is-light" id="returnBtn"><i class="fa-solid fa-arrow-left mr-3"></i>Return</button>
            <button class="button is-rounded mb-5 is-light" id="transferBtn"><i class="fa-solid fa-cart-flatbed mr-3"></i>Transfer</button>
            <button class="button is-rounded mb-5 is-light" id="cancelBtn"><i class="fa-solid fa-ban mr-3"></i>Cancel</button>
            <p class="title is-4" id="shipmentTitle">Shipment <i class="fa-solid fa-hashtag"></i><?php echo "" . $_SESSION["shipmentNumber"] ?></p>
            <p class="title is-4 is-hidden" id="shipmentNumberHidden"><?php echo $_SESSION["shipmentNumber"] ?></p>
            <p class="title is-4 is-hidden" id="shipmentTitleHidden"><?php echo $_SESSION["shipmentId"] ?></p>
            <p class="title is-4 is-hidden" id="areaIdHidden"><?php echo $_SESSION["areaId"] ?></p>
            <p class="title is-4 is-hidden" id="vehicleIdHidden"><?php echo $_SESSION["vehicleId"] ?></p>
            <p class="title is-4 is-hidden" id="shipmentStatusHidden"><?php echo $_SESSION["shipmentStatus"] ?></p>
            <p class="title is-4 is-hidden" id="indicatorHidden">result here</p>
        </div>
        <!-- DESCRIPTION -->
        <div class="container" id="mapContainer">
            <div id="map" class="">

            </div>
        </div>

        <div class="container" style="padding: 50px;">



            <p class="title is-5 mb-6" id="shipmentDescriptionTitle">Shipment Description:</p>
            <p class="subtitle is-6" id="shipmentDescriptionSubtitle" style="margin-bottom: 100px;"><?php echo $_SESSION["shipmentDescription"] ?></p>
        </div>
        <!-- DESCRIPTION -->

        <!-- PROGRESS BAR + LOG -->
        <div class="container">
            <ul class="progressbar" id="progressbarId">
                <!--
                <li class="active" id="shipmentPlacedId">
                    <p style="color: black;">Shipment Placed</p>
                </li>
                <li class="" id="shipmentPickupId">
                    <p style="color: black;">Shipment Pickup</p>
                </li>
                <li class="" id="shipmentDropoffId">
                    <p style="color: black;">Shipment Drop-off</p>
                </li>
                <li class="" id="completedDeliveryId">
                    <p style="color: black;">Completed Delivery</p>
                </li>-->
            </ul>
        </div>
        <div class="container verticalContainer" style="padding: 10%;">
            <ul id="verticalContainerUl">
                <!--
                <li>
                    <span>2022-07-20 03:35</span>
                    <div>This is an update.</div>
                </li>
                <li>
                    <span>2022-07-20 03:35</span>
                    <div>This is an update.</div>
                </li>
                <li>
                    <span>2022-07-20 03:35</span>
                    <div>This is an update.</div>
                </li>
                <li>
                    <span>2022-07-20 03:35</span>
                    <div>This is an update.</div>
                </li>
                <li>
                    <span>2022-07-20 03:35</span>
                    <div>This is an update.</div>
                </li>
                <li>
                    <span>2022-07-20 03:35</span>
                    <div>This is an update.</div>
                </li>
                <li class="selected">
                    <span>2022-07-20 03:35</span>
                    <div>This is the latest update.</div>
                </li>-->

            </ul>
        </div>
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

        <!-- CANCEL MODAL START-->
        <div class="modal" id="cancelModal">
            <div class="modal-background" id="cancelModalBg"></div>
            <div class="modal-card">

                <header class="modal-card-head has-background-info">
                    <p class="modal-card-title has-text-white"><i class="fa-solid fa-user-group mr-3"></i>Cancel Shipment</p>
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
                        <button class="button is-info has-text-white is-rounded" name="submitCancelForm" id="submitCancelForm">
                            <i class="fas fa-paper-plane mr-3"></i>Submit
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
            <div class="modal-card">

                <header class="modal-card-head has-background-info">
                    <p class="modal-card-title has-text-white"><i class="fa-solid fa-user-group mr-3"></i>Transfer Shipment</p>
                    <button class="delete" aria-label="close" onclick="closeTransfer()"></button>
                </header>

                <section class="modal-card-body">


                    <div class="field">
                        <label for="" class="label">Transfer to</label>
                        <div class="control">
                            <div class="select is-rounded" id="vehicleTransferDiv">
                                <select id="vehicleTransfer" name="vehicleTransfer">
                                </select>
                            </div>
                        </div>
                        <p class="help" id="vehicleTransferHelp"></p>
                    </div>

                    <div class="field has-text-centered mt-6">
                        <button class="button is-info has-text-white is-rounded" name="submitTransferForm" id="submitTransferForm">
                            <i class="fas fa-paper-plane mr-3"></i>Submit
                        </button>
                        <p class="help" id="submitTransferFormHelp" style="text-align: center;"></p>
                    </div>

                </section>
            </div>
        </div>
        <!-- TRANSFER MODAL END-->
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

    var el = document.createElement('div');
    el.classList.add('marker');
    //el.innerHTML = "<h1 class='title is-6'><i class='fa-solid fa-truck fa-2xl'></i></h1>";
    el.setAttribute("style", "background: url(green_marker.png) no-repeat center center fixed; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;");
    //el.setAttribute("style", "background-color: #cccccc; height: 50px; background-position: center; background-repeat: no-repeat; background-size: cover;");
    el.style.width = '60px';
    el.style.height = '60px';



    // You can remove the following line if you don't need support for RTL (right-to-left) labels:
    //maplibregl.setRTLTextPlugin('https://cdn.maptiler.com/mapbox-gl-js/plugins/mapbox-gl-rtl-text/v0.2.3/mapbox-gl-rtl-text.js');
    var map = new maplibregl.Map({
        container: 'map',
        style: 'https://api.maptiler.com/maps/streets/style.json?key=MROowlWHhkfBGNBrkA3C',
        center: [121.261588, 14.295503],
        zoom: 7
    });

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

    var popup = new maplibregl.Popup({
        closeButton: false,
        closeOnClick: false
    });

    let lat, long, update_time;

    mapContainer.addEventListener('mouseover', function() {
        // Change the cursor style as a UI indicator.
        map.getCanvas().style.cursor = 'pointer';
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
        popup.setLngLat([long, lat]).setHTML("<h1 class='title is-6 p-1'><i class='fa-solid fa-clock mr-3'></i>"+ "Last Update: </h1> <h1 class='subtitle is-6 p-1'>" + update_time + "</h1>").addTo(map);
        //alert("mouse on");
    });

    mapContainer.addEventListener('mouseout', function() {
        map.getCanvas().style.cursor = '';
        popup.remove();
        //alert("mouse off");
    });
</script>

</html>