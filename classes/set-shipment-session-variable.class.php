<?php
//PART OF NEW SYSTEM
if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
/*
    $subcontractorId = $_POST['subcontractorId'];
    $username = $_POST['username'];
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST["lastName"];
    $groupId = $_POST['groupId'];
    $groupName = $_POST['groupName'];
    $companyId = $_SESSION["companyId"];*/

    $_SESSION["shipmentId"] = $_POST['shipmentId'];
    $_SESSION["shipmentNumber"] = $_POST['shipmentNumber'];
    $_SESSION["shipmentStatus"] = $_POST['shipmentStatus'];
    $_SESSION["shipmentDescription"] = $_POST['shipmentDescription'];
    $_SESSION["destination"] = $_POST["destination"];
    $_SESSION["dateOfDelivery"] = $_POST['dateOfDelivery'];
    $_SESSION["clientName"] = $_POST['clientName'];
    $_SESSION["plateNumber"] = $_POST['plateNumber'];
    $_SESSION["vehicleId"] = $_POST['vehicleId'];
    $_SESSION["areaId"] = $_POST['areaId'];

    //header("location: ../subcontractor-group-profile.php");
    //exit();

    //echo $roleNameEdit . $dashboardAccessEdit . $shipmentAccessEdit . $employeeAccessEdit . $subcontractorAccessEdit . $permissionIdEdit . $companyId;
    //echo "test";
}
