<?php
if (!isset($_SESSION)) {
    session_start();
}
//PART OF NEW SYSTEM
include 'add-vehicle-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $plateNumberAdd = $_POST['plateNumberAdd'];
    $commissionRateAdd = $_POST['commissionRateAdd'];
    $driverAdd = $_POST['driverAdd'];
    $helperAdd = $_POST['helperAdd'];
    $groupIdAdd = $_SESSION["groupId"];
    $typeAdd = $_POST["typeAdd"];

    $addObj = new AddVehicleModel(
        $plateNumberAdd,
        $commissionRateAdd,
        $driverAdd,
        $helperAdd,
        $groupIdAdd,
        $typeAdd
    );

    $addObj->addVehicleRecord();
    

    //echo $companyId;
}
