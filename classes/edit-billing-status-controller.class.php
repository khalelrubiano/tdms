<?php
if (!isset($_SESSION)) {
    session_start();
}
//PART OF NEW SYSTEM
include 'edit-billing-status-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $billingId = $_POST['billingId'];

    $editObj = new EditBillingModel(
        $billingId
    );

    $editObj->editBillingRecord();
    

    //echo $companyId;
}
