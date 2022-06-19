<?php 
include 'add-vehicle-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $vehiclePlateNumberAdd = $_POST['vehiclePlateNumberAdd'];
    $usernameAdd = $_POST['usernameAdd'];
    $companyName = $_SESSION["companyName"];

    $addObj = new AddVehicleModel(
        $vehiclePlateNumberAdd, 
        $usernameAdd,
        $companyName
    );

    $addObj->addVehicleRecord();

}