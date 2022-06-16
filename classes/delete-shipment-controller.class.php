<?php 
if ( !isset($_SESSION) ) {
    session_start();
}

include 'delete-shipment-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $shipmentNumberDelete = $_POST['shipmentNumberDelete'];
    $companyName = $_SESSION["companyName"];

    $deleteObj = new DeleteShipmentModel($shipmentNumberDelete, $companyName);

    $deleteObj->deleteShipmentRecord();

}
