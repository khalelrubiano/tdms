<?php
if (!isset($_SESSION)) {
    session_start();
}
//PART OF NEW SYSTEM
include 'edit-payslip-status-model.class.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $payrollId = $_POST['payrollId'];

    $editObj = new EditPayslipModel(
        $payrollId
    );

    $editObj->editPayslipRecord();


    //echo $companyId;
}
