<?php
if ( !isset($_SESSION) ) {
    session_start();
}

include 'add-shipment-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $shipmentNumberAdd = $_POST['shipmentNumberAdd'];
    $shipmentDescriptionAdd = $_POST['shipmentDescriptionAdd'];
    $dateOfDeliveryAdd = $_POST['dateOfDeliveryAdd'];
    $callTimeAdd = $_POST['callTimeAdd'];
    $clientAdd = $_POST['clientAdd'];
    $destinationAdd = $_POST['destinationAdd'];
    $vehicleAdd = $_POST['vehicleAdd'];
    $companyId = $_SESSION['companyId'];

    $addObj = new AddShipmentModel(
        $shipmentNumberAdd, 
        $shipmentDescriptionAdd, 
        $dateOfDeliveryAdd, 
        $callTimeAdd, 
        $clientAdd,
        $destinationAdd, 
        $vehicleAdd,
        $companyId
    );

    $addObj->addShipmentRecord();

}