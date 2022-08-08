<?php 
if ( !isset($_SESSION) ) {
    session_start();
}
include 'delete-shipment-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST" /*&& $_POST['accessTypeEdit'] != "Admin"*/){

    $shipmentId = $_POST['shipmentId'];

    $deleteObj = new DeleteShipmentModel($shipmentId);

    $deleteObj->deleteShipmentRecord();

}/*else{
    $_SESSION['prompt'] = "Cannot delete this account!";
    header('location: ../modal-prompt.php');
    exit();
}*/
