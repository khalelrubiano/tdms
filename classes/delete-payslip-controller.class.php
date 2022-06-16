<?php 
if ( !isset($_SESSION) ) {
    session_start();
}

include 'delete-payslip-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $payslipNumberDelete = $_POST['payslipNumberDelete'];
    $companyName = $_SESSION["companyName"];

    $deleteObj = new DeletePayslipModel($payslipNumberDelete, $companyName);

    $deleteObj->deletePayslipRecord();

}
