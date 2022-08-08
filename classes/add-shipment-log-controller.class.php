<?php
if ( !isset($_SESSION) ) {
    session_start();
}

include 'add-shipment-log-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

$logDescription = $_POST['logDescription'];
$shipmentDescription = $_POST['shipmentDescription'];
$userDescription =  $_SESSION["firstName"] . " " . $_SESSION["middleName"] . " " . $_SESSION["lastName"];
$companyId = $_SESSION['companyId'];

    $addObj = new AddShipmentLogModel(
        $logDescription, 
        $shipmentDescription, 
        $userDescription, 
        $companyId
    );

    $addObj->addShipmentLogRecord();

}

/*
$logDescription = $_POST['logDescription'];
$shipmentDescription = $_POST['shipmentDescription'];
$userDescription =  $_SESSION["firstName"] . " " . $_SESSION["middleName"] . " " . $_SESSION["lastName"];
$companyId = $_SESSION['companyId'];

echo $logDescription . $shipmentDescription . $userDescription . $companyId;*/