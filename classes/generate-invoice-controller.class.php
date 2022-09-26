<?php
if ( !isset($_SESSION) ) {
    session_start();
}

include 'generate-invoice-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $shipmentNumberArray = json_decode($_POST['shipmentNumberArray']);

    $invoiceNumberAdd = $_POST['invoiceNumberAdd'];
    $clientAdd = $_POST['clientAdd'];

    $invoiceDateAdd = $_POST['invoiceDateAdd'];

    $companyId = $_SESSION["companyId"];

    $generateObj = new GenerateInvoiceModel(
        $invoiceNumberAdd,
        $clientAdd, 
        $invoiceDateAdd, 
        $shipmentNumberArray,
        $companyId
    );

    $generateObj->generateInvoiceRecord();

}