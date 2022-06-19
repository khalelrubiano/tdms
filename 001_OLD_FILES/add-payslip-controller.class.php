<?php
if ( !isset($_SESSION) ) {
    session_start();
}

include 'add-payslip-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $payslipNumberAdd = $_POST['payslipNumberAdd'];
    $dateIssuedAdd = $_POST['dateIssuedAdd'];
    $dropOffAdd = $_POST['dropOffAdd'];
    $penaltyAdd = $_POST['penaltyAdd'];
    $withholdingTaxAdd = $_POST['withholdingTaxAdd'];
    $commissionRateAdd = $_POST['commissionRateAdd'];
    $vehiclePlateNumberAdd = $_POST['vehiclePlateNumberAdd'];
    $billingInvoiceNumberAdd = $_POST['billingInvoiceNumberAdd'];
    $companyName = $_SESSION['companyName'];

    $addObj = new AddPayslipModel(
        $payslipNumberAdd, 
        $dateIssuedAdd, 
        $dropOffAdd,
        $penaltyAdd,
        $withholdingTaxAdd, 
        $commissionRateAdd, 
        $vehiclePlateNumberAdd, 
        $billingInvoiceNumberAdd,
        $companyName
    );

    $addObj->addPayslipRecord();

}