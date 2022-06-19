<?php 
include 'add-tracker-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $vehiclePlateNumberAdd = $_POST['vehiclePlateNumberAdd'];
    $trackerIdAdd = $_POST['trackerIdAdd'];
    $companyName = $_SESSION["companyName"];

    $addObj = new AddTrackerModel(
        $vehiclePlateNumberAdd, 
        $trackerIdAdd,
        $companyName
    );

    $addObj->addTrackerRecord();

}