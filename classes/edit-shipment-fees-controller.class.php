<?php
if ( !isset($_SESSION) ) {
    session_start();
}

include 'edit-shipment-fees-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $shipmentId = $_POST['shipmentId'];
    $dropFeeAdd = $_POST['dropFeeAdd'];
    $parkingFeeAdd = $_POST['parkingFeeAdd'];
    $tollFeeAdd = $_POST['tollFeeAdd'];
    $fuelChargeAdd = $_POST['fuelChargeAdd'];
    $extraHelperFeeAdd = $_POST['extraHelperFeeAdd'];
    $demurrageAdd = $_POST['demurrageAdd'];
    $otherChargesAdd = $_POST['otherChargesAdd'];
    $penaltyAdd = $_POST["penaltyAdd"];

    $addObj = new AddShipmentProgressModel(
        $shipmentId,
        $dropFeeAdd, 
        $parkingFeeAdd, 
        $tollFeeAdd, 
        $fuelChargeAdd, 
        $extraHelperFeeAdd, 
        $demurrageAdd, 
        $otherChargesAdd,
        $penaltyAdd
    );

    $addObj->addShipmentProgressRecord();

}