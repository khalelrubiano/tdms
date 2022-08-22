<?php
if (!isset($_SESSION)) {
    session_start();
}
//PART OF NEW SYSTEM
include 'edit-payslip-status-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $billingId = $_POST['billingId'];
    $ownerId = $_POST['ownerId'];

    $editObj = new EditPayslipModel(
        $billingId,
        $ownerId
    );

    $editObj->editPayslipRecord();
    

    //echo $companyId;
}
