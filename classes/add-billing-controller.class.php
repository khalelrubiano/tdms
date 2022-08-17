<?php
if ( !isset($_SESSION) ) {
    session_start();
}

include 'add-billing-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $invoiceNumberAdd = $_POST['invoiceNumberAdd'];
    $invoiceDateAdd = $_POST['invoiceDateAdd'];
    $clientAdd = $_POST['clientAdd'];

    $dropFeeAdd = $_POST['dropFeeAdd'];
    $parkingFeeAdd = $_POST['parkingFeeAdd'];
    $demurrageAdd = $_POST['demurrageAdd'];
    $otherChargesAdd = $_POST['otherChargesAdd'];
    $penaltyAdd = $_POST["penaltyAdd"];

    $startDateAdd = $_POST["startDateAdd"];
    $endDateAdd = $_POST["endDateAdd"];

    //echo $invoiceNumberAdd . "<br>" .  $clientAdd . "<br>" .  $dropFeeAdd . "<br>" .  $parkingFeeAdd . "<br>" .  $demurrageAdd . "<br>" .  $otherChargesAdd . "<br>" .  $penaltyAdd . "<br>" .  $startDateAdd . "<br>" .  $endDateAdd;

    $generateObj = new GenerateInvoiceModel(
        $invoiceNumberAdd,
        $invoiceDateAdd,
        $clientAdd, 
        $dropFeeAdd, 
        $parkingFeeAdd, 
        $demurrageAdd, 
        $otherChargesAdd,
        $penaltyAdd,
        $startDateAdd,
        $endDateAdd
    );

    $generateObj->generateInvoiceRecord();

}