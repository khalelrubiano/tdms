<?php
if ( !isset($_SESSION) ) {
    session_start();
}

include 'edit-shipment-fees-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $shipmentId = $_POST['shipmentId'];
    $dropFeeAdd = $_POST['dropFeeAdd'];
    $parkingFeeAdd = $_POST['parkingFeeAdd'];
    $demurrageAdd = $_POST['demurrageAdd'];
    $otherChargesAdd = $_POST['otherChargesAdd'];
    $penaltyAdd = $_POST["penaltyAdd"];

    $addObj = new AddShipmentProgressModel(
        $shipmentId,
        $dropFeeAdd, 
        $parkingFeeAdd, 
        $demurrageAdd, 
        $otherChargesAdd,
        $penaltyAdd
    );

    $addObj->addShipmentProgressRecord();

}