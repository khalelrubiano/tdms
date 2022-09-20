<?php
if (!isset($_SESSION)) {
    session_start();
}
//PART OF NEW SYSTEM
include 'add-vehicle-type-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $typeAdd2 = $_POST['typeAdd2'];
    $companyId = $_SESSION["companyId"];

    $addObj = new AddVehicleModel(
        $typeAdd2,
        $companyId
    );

    $addObj->addVehicleRecord();
    

    //echo $companyId;
}
