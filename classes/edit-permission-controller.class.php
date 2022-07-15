
<?php
//PART OF NEW SYSTEM
if (!isset($_SESSION)) {
    session_start();
}
include 'edit-permission-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $roleNameEdit = $_POST['roleNameEdit'];
    $shipmentAccessEdit = $_POST['shipmentAccessEdit'];
    $employeeAccessEdit = $_POST['employeeAccessEdit'];
    $subcontractorAccessEdit = $_POST["subcontractorAccessEdit"];
    $clientAccessEdit = $_POST['clientAccessEdit'];
    $billingAccessEdit = $_POST['billingAccessEdit'];
    $payrollAccessEdit = $_POST['payrollAccessEdit'];
    $permissionIdEdit = $_POST['permissionIdEdit'];
    $companyId = $_SESSION["companyId"];

    $editObj = new EditPermissionModel(
        $roleNameEdit,
        $shipmentAccessEdit,
        $employeeAccessEdit,
        $subcontractorAccessEdit,
        $clientAccessEdit,
        $billingAccessEdit,
        $payrollAccessEdit,
        $permissionIdEdit,
        $companyId
    );

    $editObj->editPermissionRecord();
    

    //echo $roleNameEdit . $shipmentAccessEdit . $employeeAccessEdit . $subcontractorAccessEdit . $permissionIdEdit . $clientAccessEdit . $billingAccessEdit . $payrollAccessEdit . $companyId;
}
