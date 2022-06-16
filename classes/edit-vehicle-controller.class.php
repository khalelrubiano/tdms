<?php 
include 'edit-vehicle-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $vehiclePlateNumberEdit = $_POST['vehiclePlateNumberEdit'];
    $usernameEdit = $_POST['usernameEdit'];
    $companyName = $_SESSION["companyName"];

    $editObj = new EditVehicleModel(
        $vehiclePlateNumberEdit, 
        $usernameEdit,
        $companyName
    );

    $editObj->editVehicleRecord();

}