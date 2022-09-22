<?php
if ( !isset($_SESSION) ) {
    session_start();
}

include 'transfer-shipment-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $shipmentId = $_POST['shipmentId'];
    $shipmentNumber = $_POST['shipmentNumber'];
    $vehicleId = $_POST['vehicleId'];
    $vehicleIdOld = $_POST['vehicleIdOld'];
    $companyId = $_SESSION['companyId'];
    $transferReason = $_POST['transferReason'];

    $transferObj = new TransferShipmentModel(
        $shipmentId,
        $shipmentNumber,
        $vehicleId,
        $vehicleIdOld,
        $companyId,
        $transferReason
    );

    $transferObj->transferShipmentRecord();

}
/*
$shipmentId = $_POST['shipmentId'];
$shipmentNumber = $_POST['shipmentNumber'];
$shipmentDescription = $_POST['shipmentDescription'];
$destination = $_POST['destination'];
$dateOfDelivery = $_POST['dateOfDelivery'];
$areaId = $_POST['areaId'];
$vehicleId = $_POST['vehicleId'];

echo $shipmentId . $shipmentNumber . $shipmentDescription . $destination . $dateOfDelivery . $areaId . $vehicleId;*/