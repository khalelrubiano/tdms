<?php 
if ( !isset($_SESSION) ) {
    session_start();
}

include 'delete-invoice-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $billingInvoiceNumberDelete = $_POST['billingInvoiceNumberDelete'];
    $companyName = $_SESSION["companyName"];

    $deleteObj = new DeleteInvoiceModel($billingInvoiceNumberDelete, $companyName);

    $deleteObj->deleteInvoiceRecord();

}
