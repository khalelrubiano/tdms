<?php 
if ( !isset($_SESSION) ) {
    session_start();
}
include 'delete-type-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST" /*&& $_POST['accessTypeEdit'] != "Admin"*/){

    $typeId = $_POST['typeId'];

    $deleteObj = new DeletePermissionModel($typeId);

    $deleteObj->deletePermissionRecord();

}/*else{
    $_SESSION['prompt'] = "Cannot delete this account!";
    header('location: ../modal-prompt.php');
    exit();
}*/
