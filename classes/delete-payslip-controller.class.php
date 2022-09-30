<?php 
if ( !isset($_SESSION) ) {
    session_start();
}
include 'delete-payslip-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST" /*&& $_POST['accessTypeEdit'] != "Admin"*/){

    $payrollId = $_POST['payrollId'];

    $deleteObj = new DeleteModel($payrollId);

    $deleteObj->deleteRecord();

}/*else{
    $_SESSION['prompt'] = "Cannot delete this account!";
    header('location: ../modal-prompt.php');
    exit();
}*/
