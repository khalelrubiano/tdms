<?php
$DB_HOST = "localhost";
$DB_USER = "u829557651_tdms"; 
$DB_PASS = "Tdms2022"; 
$DB_NAME = "u829557651_tdms";

$con=mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);

$trackerId = $_GET['trackerId'];
$longitude = $_GET['longitude'];
$latitude = $_GET['latitude'];
$shipmentId = 1;

$result = mysqli_query($con,"INSERT INTO trackingdata (tracking_id, shipment_id, longitude, latitude) VALUES('$trackerId', '$shipmentId', '$longitude', '$latitude')");

echo "success!";

?>