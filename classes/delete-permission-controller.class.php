<?php 
if ( !isset($_SESSION) ) {
    session_start();
}
include 'delete-permission-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST" /*&& $_POST['accessTypeEdit'] != "Admin"*/){

    $permissionIdDelete = $_POST['permissionIdDelete'];

    $deleteObj = new DeletePermissionModel($permissionIdDelete);

    $deleteObj->deletePermissionRecord();

}/*else{
    $_SESSION['prompt'] = "Cannot delete this account!";
    header('location: ../modal-prompt.php');
    exit();
}*/
