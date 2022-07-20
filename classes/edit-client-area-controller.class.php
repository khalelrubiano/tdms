
<?php
//PART OF NEW SYSTEM
if (!isset($_SESSION)) {
    session_start();
}
include 'edit-client-area-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $areaRateEdit = $_POST['areaRateEdit'];
    $areaId = $_POST['areaId'];

    $editObj = new EditClientAreaModel(
        $areaRateEdit,
        $areaId
    );

    $editObj->editClientAreaRecord();
    

    //echo $roleNameEdit . $shipmentAccessEdit . $employeeAccessEdit . $subcontractorAccessEdit . $permissionIdEdit . $clientAccessEdit . $billingAccessEdit . $payrollAccessEdit . $companyId;
}
