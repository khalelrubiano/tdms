<?php 
if ( !isset($_SESSION) ) {
    session_start();
}
include 'delete-vehicle-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST" /*&& $_POST['accessTypeEdit'] != "Admin"*/){

    $vehicleIdDelete = $_POST['vehicleIdDelete'];

    $deleteObj = new DeleteVehicleModel($vehicleIdDelete);

    $deleteObj->deleteVehicleRecord();

}/*else{
    $_SESSION['prompt'] = "Cannot delete this account!";
    header('location: ../modal-prompt.php');
    exit();
}*/
