<?php
if ( !isset($_SESSION) ) {
    session_start();
}

include 'generate-payroll-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $typeAdd = $_POST['typeAdd'];
    $invoiceNumberAdd = $_POST['invoiceNumberAdd'];
    $vehicleAdd = $_POST['vehicleAdd'];

    $companyId = $_SESSION["companyId"];

    $generateObj = new GenerateInvoiceModel(
        $typeAdd,
        $invoiceNumberAdd, 
        $vehicleAdd, 
        $companyId
    );

    $generateObj->generateInvoiceRecord();

}