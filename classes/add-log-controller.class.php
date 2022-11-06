<?php
if ( !isset($_SESSION) ) {
    session_start();
}

include 'add-log-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

$logDescription = $_POST['logDescription'];
$moduleDescription = $_POST['moduleDescription'];
$userDescription =  $_SESSION["firstName"] . " " . $_SESSION["middleName"] . " " . $_SESSION["lastName"];
$companyId = $_SESSION['companyId'];

$logDescription = $_SESSION["firstName"] . " " . $_SESSION["middleName"] . " " . $_SESSION["lastName"] . " " . $_POST['logDescription'] . " " . $_POST['moduleDescription'];

    $addObj = new AddLogModel(
        $logDescription,
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