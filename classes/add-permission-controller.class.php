
<?php
//PART OF NEW SYSTEM
if (!isset($_SESSION)) {
    session_start();
}
include 'add-permission-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $roleNameAdd = $_POST['roleNameAdd'];
    $shipmentAccessAdd = $_POST['shipmentAccessAdd'];
    $employeeAccessAdd = $_POST['employeeAccessAdd'];
    $subcontractorAccessAdd = $_POST["subcontractorAccessAdd"];
    $clientAccessAdd = $_POST['clientAccessAdd'];
    $billingAccessAdd = $_POST['billingAccessAdd'];
    $payrollAccessAdd = $_POST['payrollAccessAdd'];
    $companyId = $_SESSION["companyId"];

    $addObj = new AddPermissionModel(
        $roleNameAdd,
        $shipmentAccessAdd,
        $employeeAccessAdd,
        $subcontractorAccessAdd,
        $clientAccessAdd,
        $billingAccessAdd,
        $payrollAccessAdd,
        $companyId
    );

    $addObj->addPermissionRecord();
    

    //echo $companyId;
}
