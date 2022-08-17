<?php
if (!isset($_SESSION)) {
    session_start();
}
//PART OF NEW SYSTEM
include 'edit-vehicle-status-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $vehicleStatusEdit = $_POST['vehicleStatus'];
    $vehicleIdEdit = $_POST['vehicleId'];

    $editObj = new EditVehicleModel(
        $vehicleStatusEdit,
        $vehicleIdEdit
    );

    $editObj->editVehicleRecord();
    

    //echo $companyId;
}
