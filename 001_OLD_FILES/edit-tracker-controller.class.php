<?php 
include 'edit-tracker-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $vehiclePlateNumberEdit = $_POST['vehiclePlateNumberEdit'];
    $trackerIdEdit = $_POST['trackerIdEdit'];
    $companyName = $_SESSION["companyName"];

    $editObj = new EditTrackerModel(
        $vehiclePlateNumberEdit, 
        $trackerIdEdit,
        $companyName
    );

    $editObj->editTrackerRecord();

}