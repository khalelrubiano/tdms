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
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
    <title>TEST</title>

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
        #map {
            position: absolute;
            top: 10%;
            right: 10%;
            bottom: 10%;
            left: 10%;
        }
    </style>
</head>

<body>
    <div class="main">

        <div id="map" class="">

        </div>

    </div>


    <script>
        // You can remove the following line if you don't need support for RTL (right-to-left) labels:
        maplibregl.setRTLTextPlugin('https://cdn.maptiler.com/mapbox-gl-js/plugins/mapbox-gl-rtl-text/v0.2.3/mapbox-gl-rtl-text.js');
        var map = new maplibregl.Map({
            container: 'map',
            style: 'https://api.maptiler.com/maps/streets/style.json?key=MROowlWHhkfBGNBrkA3C',
            center: [121.261588, 14.295503],
            zoom: 7
        });
    </script>
</body>

<!--EXTERNAL JAVASCRIPT-->
<script src="js/test.js"></script>

<!--INTERNAL JAVASCRIPT-->
<script>
    logoutBtn.classList.remove("is-hidden");
</script>

</html>