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
    $_SESSION["startingPoint"] = $_POST['startingPoint'];
    $_SESSION["destination"] = $_POST["destination"];
    $_SESSION["dateOfDelivery"] = $_POST['dateOfDelivery'];
    $_SESSION["plateNumber"] = $_POST['plateNumber'];

    //header("location: ../subcontractor-group-profile.php");
    //exit();

    //echo $roleNameEdit . $dashboardAccessEdit . $shipmentAccessEdit . $employeeAccessEdit . $subcontractorAccessEdit . $permissionIdEdit . $companyId;
    //echo "test";
}
