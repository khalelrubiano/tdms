<?php
if ( !isset($_SESSION) ) {
    session_start();
}

include 'add-shipment-fees-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $shipmentId = $_POST['shipmentId'];

    $addObj = new AddShipmentProgressModel(
        $shipmentId
    );

    $addObj->addShipmentProgressRecord();

}