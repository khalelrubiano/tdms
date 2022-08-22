<?php
if ( !isset($_SESSION) ) {
    session_start();
}

include 'add-payroll-log-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

$logDescription = $_POST['logDescription'];
$userDescription =  $_SESSION["firstName"] . " " . $_SESSION["middleName"] . " " . $_SESSION["lastName"];
$companyId = $_SESSION['companyId'];
$billingId = $_POST['billingId'];
$ownerId = $_POST['ownerId'];

    $addObj = new AddLogModel(
        $logDescription, 
        $userDescription, 
        $companyId,
        $billingId,
        $ownerId
    );

    $addObj->addLogRecord();

}

/*
$logDescription = $_POST['logDescription'];
$shipmentDescription = $_POST['shipmentDescription'];
$userDescription =  $_SESSION["firstName"] . " " . $_SESSION["middleName"] . " " . $_SESSION["lastName"];
$companyId = $_SESSION['companyId'];

echo $logDescription . $shipmentDescription . $userDescription . $companyId;*/