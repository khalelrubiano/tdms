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

    $_SESSION["clientId"] = $_POST['clientId'];
    $_SESSION["clientName"] = $_POST['clientName'];
    $_SESSION["clientAddress"] = $_POST['clientAddress'];
    $_SESSION["companyId"] = $_SESSION["companyId"];
    $_SESSION["clientTin"] = $_POST['clientTin'];
    //header("location: ../subcontractor-group-profile.php");
    //exit();

    //echo $roleNameEdit . $dashboardAccessEdit . $shipmentAccessEdit . $employeeAccessEdit . $subcontractorAccessEdit . $permissionIdEdit . $companyId;
    //echo "test";
}
