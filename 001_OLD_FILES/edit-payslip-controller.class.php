<?php
if ( !isset($_SESSION) ) {
    session_start();
}

include 'edit-payslip-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $payslipNumberEdit = $_POST['payslipNumberEdit'];
    $dateIssuedEdit = $_POST['dateIssuedEdit'];
    $shipmentNumberEdit = $_POST['shipmentNumberEdit'];
    $areaRateEdit = $_POST['areaRateEdit'];
    $commissionRateEdit = $_POST['commissionRateEdit'];
    $penaltyEdit = $_POST['penaltyEdit'];
    $companyName = $_SESSION['companyName'];

    $editObj = new EditPayslipModel(
        $payslipNumberEdit, 
        $dateIssuedEdit, 
        $shipmentNumberEdit, 
        $areaRateEdit, 
        $commissionRateEdit, 
        $penaltyEdit,
        $companyName
    );

    $editObj->editPayslipRecord();

}