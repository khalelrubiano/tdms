<?php
if ( !isset($_SESSION) ) {
    session_start();
}

include 'add-shipment-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $shipmentNumberAdd = $_POST['shipmentNumberAdd'];
    $shipmentDescriptionAdd = $_POST['shipmentDescriptionAdd'];
    $destinationAdd = $_POST['destinationAdd'];
    $dateOfDeliveryAdd = $_POST['dateOfDeliveryAdd'];
    $areaRateAdd = $_POST['areaRateAdd'];
    $vehicleAdd = $_POST['vehicleAdd'];

    $addObj = new AddShipmentModel(
        $shipmentNumberAdd, 
        $shipmentDescriptionAdd, 
        $destinationAdd, 
        $dateOfDeliveryAdd,
        $areaRateAdd, 
        $vehicleAdd,
    );

    $addObj->addShipmentRecord();

}