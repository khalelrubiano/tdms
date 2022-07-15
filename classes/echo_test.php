<?php
//PART OF NEW SYSTEM
if (!isset($_SESSION)) {
    session_start();
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $roleNameEdit = $_POST['roleNameEdit'];
    $dashboardAccessEdit = $_POST['dashboardAccessEdit'];
    $shipmentAccessEdit = $_POST['shipmentAccessEdit'];
    $employeeAccessEdit = $_POST['employeeAccessEdit'];
    $subcontractorAccessEdit = $_POST["subcontractorAccessEdit"];
    $permissionIdEdit = $_POST['permissionIdEdit'];
    $companyId = $_SESSION["companyId"];
    
    echo $roleNameEdit . $dashboardAccessEdit . $shipmentAccessEdit . $employeeAccessEdit . $subcontractorAccessEdit . $permissionIdEdit . $companyId;
}
