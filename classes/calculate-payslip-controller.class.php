<?php
if ( !isset($_SESSION) ) {
    session_start();
}

include 'calculate-payslip-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $payslipNumberCalculate = $_POST['payslipNumberCalculate'];
    $usernameCalculate = $_POST['usernameCalculate'];
    $companyName = $_SESSION['companyName'];

    $calculateObj = new CalculatePayslipModel(
        $payslipNumberCalculate, 
        $usernameCalculate, 
        $companyName
    );

    $calculateObj->calculatePayslipRecord();

}