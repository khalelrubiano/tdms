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
    $_SESSION["dateOfDelivery"] = $_POST["dateOfDelivery"];
    $_SESSION["callTime"] = $_POST["callTime"];
    $_SESSION["clientId"] = $_POST["clientId"];
    $_SESSION["areaName"] = $_POST["areaName"];
    $_SESSION["destination"] = $_POST["destination"];
    $_SESSION["areaRate"] = $_POST["areaRate"];
    $_SESSION["vehicleType"] = $_POST["vehicleType"];
    $_SESSION["plateNumber"] = $_POST["plateNumber"];
    $_SESSION["commissionRate"] = $_POST["commissionRate"];
    $_SESSION["driverId"] = $_POST["driverId"];
    $_SESSION["helperId"] = $_POST["helperId"];
    $_SESSION["clientName"] = $_POST["clientName"];

    //header("location: ../subcontractor-group-profile.php");
    //exit();

    //echo $roleNameEdit . $dashboardAccessEdit . $shipmentAccessEdit . $employeeAccessEdit . $subcontractorAccessEdit . $permissionIdEdit . $companyId;
    //echo "test";
}
