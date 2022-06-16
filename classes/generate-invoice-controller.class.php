<?php
if ( !isset($_SESSION) ) {
    session_start();
}

include 'generate-invoice-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $shipmentNumberArray = json_decode($_POST['shipmentNumberArray']);

    $billingInvoiceNumberGenerate = $_POST['billingInvoiceNumberGenerate'];
    $clientGenerate = $_POST['clientGenerate'];

    $dropFeeGenerate = $_POST['dropFeeGenerate'];
    $parkingFeeGenerate = $_POST['parkingFeeGenerate'];
    $demurrageGenerate = $_POST['demurrageGenerate'];
    $otherChargesGenerate = $_POST['otherChargesGenerate'];
    $lessPenaltiesGenerate = $_POST["lessPenaltiesGenerate"];

    $companyName = $_SESSION["companyName"];

    $generateObj = new GenerateInvoiceModel(
        $billingInvoiceNumberGenerate,
        $clientGenerate, 
        $dropFeeGenerate, 
        $parkingFeeGenerate, 
        $demurrageGenerate, 
        $otherChargesGenerate,
        $lessPenaltiesGenerate,
        $shipmentNumberArray,
        $companyName
    );

    $generateObj->generateInvoiceRecord();

}