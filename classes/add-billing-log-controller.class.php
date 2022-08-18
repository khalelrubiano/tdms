<?php
if ( !isset($_SESSION) ) {
    session_start();
}

include 'add-billing-log-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

$logDescription = $_POST['logDescription'];
$billingDescription = $_POST['billingDescription'];
$userDescription =  $_SESSION["firstName"] . " " . $_SESSION["middleName"] . " " . $_SESSION["lastName"];
$companyId = $_SESSION['companyId'];

    $addObj = new AddLogModel(
        $logDescription, 
        $billingDescription, 
        $userDescription, 
        $companyId
    );

    $addObj->addLogRecord();

}

/*
$logDescription = $_POST['logDescription'];
$shipmentDescription = $_POST['shipmentDescription'];
$userDescription =  $_SESSION["firstName"] . " " . $_SESSION["middleName"] . " " . $_SESSION["lastName"];
$companyId = $_SESSION['companyId'];

echo $logDescription . $shipmentDescription . $userDescription . $companyId;*/