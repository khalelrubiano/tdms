<?php
if (!isset($_SESSION)) {
    session_start();
}
//PART OF NEW SYSTEM
include 'edit-vehicle-reason-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $vehicleStatusEdit = $_POST['vehicleStatus'];
    $vehicleIdEdit = $_POST['vehicleId'];
    $reason = $_POST['reason'];

    $editObj = new EditVehicleModel(
        $vehicleStatusEdit,
        $vehicleIdEdit,
        $reason
    );

    $editObj->editVehicleRecord();
    

    //echo $companyId;
}
