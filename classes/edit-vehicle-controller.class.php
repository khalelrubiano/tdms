<?php
if (!isset($_SESSION)) {
    session_start();
}
//PART OF NEW SYSTEM
include 'edit-vehicle-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $vehicleIdEdit = $_POST['vehicleIdEdit'];
    $commissionRateEdit = $_POST['commissionRateEdit'];
    $driverEdit = $_POST['driverEdit'];
    $helperEdit = $_POST['helperEdit'];

    $editObj = new EditVehicleModel(
        $vehicleIdEdit,
        $commissionRateEdit,
        $driverEdit,
        $helperEdit
    );

    $editObj->editVehicleRecord();
    

    //echo $companyId;
}
