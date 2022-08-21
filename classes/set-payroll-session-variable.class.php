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

    $_SESSION["payrollId"] = $_POST["payrollId"];
    $_SESSION["payrollStatus"] = $_POST['payrollStatus'];

    $_SESSION["billingId"] = $_POST['billingId'];
    $_SESSION["invoiceNumber"] = $_POST['invoiceNumber'];
    $_SESSION["invoiceDate"] = $_POST['invoiceDate'];

    //header("location: ../subcontractor-group-profile.php");
    //exit();

    //echo $roleNameEdit . $dashboardAccessEdit . $shipmentAccessEdit . $employeeAccessEdit . $subcontractorAccessEdit . $permissionIdEdit . $companyId;
    //echo "test";
}
