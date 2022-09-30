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

    $_SESSION["invoiceNumberPDF"] = $_POST['invoiceNumberPDF'];
    $_SESSION["ownerHeader"] = '0';
    $_SESSION["plateNumberHeader"] = '0';
    $_SESSION["dateHeader"] = '0';
    $_SESSION["remarksHeader"] = '0';
    $_SESSION["truckRateTD"] = '0';
    $_SESSION["dropOffTD"] = '0';
    $_SESSION["penaltyTD"] = '0';
    $_SESSION["totalTD"] = '0';
    $_SESSION["taxTD"] = '0';
    $_SESSION["lessTDHeader"] = '0';
    $_SESSION["lessTD"] = '0';
    $_SESSION["netPayTD"] = '0';
    $_SESSION["shipmenthtml"] = '0';

    //header("location: ../subcontractor-group-profile.php");
    //exit();

    //echo $roleNameEdit . $dashboardAccessEdit . $shipmentAccessEdit . $employeeAccessEdit . $subcontractorAccessEdit . $permissionIdEdit . $companyId;
    //echo $_SESSION["invoiceNumberPDF"];
}
