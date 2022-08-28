
<?php
//PART OF NEW SYSTEM
if (!isset($_SESSION)) {
    session_start();
}
include 'add-tracker-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $trackerId = $_POST['trackerId'];
    $vehicleId = $_POST['vehicleId'];

    $addObj = new AddModel(
        $trackerId,
        $vehicleId
    );

    $addObj->addRecord();
    

    //echo $companyId;
}
