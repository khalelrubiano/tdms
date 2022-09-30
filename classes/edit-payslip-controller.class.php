<?php
if (!isset($_SESSION)) {
    session_start();
}
//PART OF NEW SYSTEM
include 'edit-payslip-model.class.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $dropOffEdit = $_POST['dropOffEdit'];
    $penaltyEdit = $_POST['penaltyEdit'];
    $remarksEdit = $_POST['remarksEdit'];
    $payrollId = $_POST['payrollId'];

    $editObj = new EditPayslipModel(
        $dropOffEdit,
        $penaltyEdit,
        $remarksEdit,
        $payrollId
    );

    $editObj->editPayslipRecord();


    //echo $companyId;
}
