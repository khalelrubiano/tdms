<?php
if ( !isset($_SESSION) ) {
    session_start();
}

include 'add-shipment-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $shipmentNumberAdd = $_POST['shipmentNumberAdd'];
    $shipmentStatusAdd = $_POST['shipmentStatusAdd'];
    $startingPointAdd = $_POST['startingPointAdd'];
    $destinationAdd = $_POST['destinationAdd'];
    $areaRateAdd = $_POST['areaRateAdd'];
    $callTimeAdd = $_POST['callTimeAdd'];
    $dateOfDeliveryAdd = $_POST['dateOfDeliveryAdd'];
    $companyName = $_SESSION["companyName"];
    $vehiclePlateNumberAdd = $_POST['vehiclePlateNumberAdd'];

    $addObj = new AddShipmentModel(
        $shipmentNumberAdd, 
        $shipmentStatusAdd, 
        $startingPointAdd, 
        $destinationAdd,
        $areaRateAdd, 
        $callTimeAdd, 
        $dateOfDeliveryAdd,
        $companyName,
        $vehiclePlateNumberAdd
    );

    $addObj->addShipmentRecord();

}