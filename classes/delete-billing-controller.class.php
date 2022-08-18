<?php 
if ( !isset($_SESSION) ) {
    session_start();
}
include 'delete-billing-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST" /*&& $_POST['accessTypeEdit'] != "Admin"*/){

    $billingId = $_POST['billingId'];

    $deleteObj = new DeleteModel($billingId);

    $deleteObj->deleteRecord();

}/*else{
    $_SESSION['prompt'] = "Cannot delete this account!";
    header('location: ../modal-prompt.php');
    exit();
}*/
