<?php
if ( !isset($_SESSION) ) {
    session_start();
}

include 'add-shipment-progress-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $shipmentId = $_POST['shipmentId'];
    $shipmentDescription = $_POST['shipmentDescription'];

    $addObj = new AddShipmentProgressModel(
        $shipmentId, 
        $shipmentDescription
    );

    $addObj->addShipmentProgressRecord();

}