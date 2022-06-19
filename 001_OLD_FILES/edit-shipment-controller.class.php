<?php 
if ( !isset($_SESSION) ) {
    session_start();
}
include 'edit-shipment-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $shipmentNumberEdit = $_POST['shipmentNumberEdit'];
    $shipmentStatusEdit = $_POST['shipmentStatusEdit'];
    $startingPointEdit = $_POST['startingPointEdit'];
    $destinationEdit = $_POST['destinationEdit'];
    $areaRateEdit = $_POST['areaRateEdit'];
    $callTimeEdit = $_POST['callTimeEdit'];
    $dateOfDeliveryEdit = $_POST['dateOfDeliveryEdit'];
    $companyName = $_SESSION["companyName"];
    $vehiclePlateNumberEdit = $_POST['vehiclePlateNumberEdit'];

    $editObj = new EditShipmentModel(
        $shipmentNumberEdit, 
        $shipmentStatusEdit, 
        $startingPointEdit, 
        $destinationEdit,
        $areaRateEdit,
        $callTimeEdit, 
        $dateOfDeliveryEdit,
        $companyName,
        $vehiclePlateNumberEdit
    );

    $editObj->editShipmentRecord();

}