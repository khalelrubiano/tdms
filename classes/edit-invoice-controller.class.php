<?php 
if ( !isset($_SESSION) ) {
    session_start();
}
include 'edit-invoice-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $billingInvoiceNumberEdit = $_POST['billingInvoiceNumberEdit'];
    $billingStatusEdit = $_POST['billingStatusEdit'];
    $companyName = $_SESSION["companyName"];

    $editObj = new EditInvoiceModel(
        $billingInvoiceNumberEdit,
        $billingStatusEdit, 
        $companyName
    );

    $editObj->editInvoiceRecord();

}