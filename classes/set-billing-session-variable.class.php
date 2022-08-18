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

    $_SESSION["billingId"] = $_POST['billingId'];
    $_SESSION["invoiceNumber"] = $_POST['invoiceNumber'];
    $_SESSION["invoiceDate"] = $_POST['invoiceDate'];
    $_SESSION["billingStatus"] = $_POST['billingStatus'];
    $_SESSION["clientName"] = $_POST["clientName"];
    $_SESSION["dropFee"] = $_POST['dropFee'];
    $_SESSION["parkingFee"] = $_POST['parkingFee'];
    $_SESSION["demurrage"] = $_POST['demurrage'];
    $_SESSION["otherCharges"] = $_POST['otherCharges'];
    $_SESSION["penalty"] = $_POST['penalty'];
    $_SESSION["startDate"] = $_POST['startDate'];
    $_SESSION["endDate"] = $_POST['endDate'];
    $_SESSION["dueDate"] = $_POST['dueDate'];
    $_SESSION["clientAddress"] = $_POST['clientAddress'];

    //header("location: ../subcontractor-group-profile.php");
    //exit();

    //echo $roleNameEdit . $dashboardAccessEdit . $shipmentAccessEdit . $employeeAccessEdit . $subcontractorAccessEdit . $permissionIdEdit . $companyId;
    //echo "test";
}
