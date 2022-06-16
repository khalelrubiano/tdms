<?php 
if ( !isset($_SESSION) ) {
    session_start();
}
include 'delete-vehicle-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $vehiclePlateNumberDelete = $_POST['vehiclePlateNumberDelete'];
    $companyName = $_SESSION["companyName"];

    $deleteObj = new DeleteVehicleModel($vehiclePlateNumberDelete, $companyName);

    $deleteObj->deleteVehicleRecord();

}
