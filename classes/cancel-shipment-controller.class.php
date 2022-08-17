<?php
if ( !isset($_SESSION) ) {
    session_start();
}

include 'cancel-shipment-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $shipmentId = $_POST['shipmentId'];
    $cancelReason = $_POST['cancelReason'];
    $vehicleId = $_SESSION['vehicleId'];

    $cancelObj = new CancelShipmentModel(
        $shipmentId,
        $cancelReason,
        $vehicleId
    );

    $cancelObj->cancelShipmentRecord();

}