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

    $_SESSION["ownerSubcontractorId"] = $_POST['subcontractorId'];
    $_SESSION["ownerUsername"] = $_POST['username'];
    $_SESSION["ownerFirstName"] = $_POST['firstName'];
    $_SESSION["ownerMiddleName"] = $_POST['middleName'];
    $_SESSION["ownerLastName"] = $_POST["lastName"];
    $_SESSION["groupId"] = $_POST['groupId'];
    $_SESSION["groupName"] = $_POST['groupName'];
    $_SESSION["companyId"] = $_SESSION["companyId"];

    //header("location: ../subcontractor-group-profile.php");
    //exit();

    //echo $roleNameEdit . $dashboardAccessEdit . $shipmentAccessEdit . $employeeAccessEdit . $subcontractorAccessEdit . $permissionIdEdit . $companyId;
    //echo "test";
}
