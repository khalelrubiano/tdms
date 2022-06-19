<?php
$DB_HOST = "localhost";
$DB_USER = "u573662636_tdms"; 
$DB_PASS = "tdmsGroup1"; 
$DB_NAME = "u573662636_tdms";

$con=mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);

$trackerId = $_GET['trackerId'];
$longitude = $_GET['longitude'];
$latitude = $_GET['latitude'];

$result = mysqli_query($con,"INSERT INTO trackerlocation (trackerId, longitude, latitude) VALUES('$trackerId','$longitude', '$latitude')");

echo "success!";

?>