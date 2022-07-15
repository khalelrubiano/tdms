<?php 
if ( !isset($_SESSION) ) {
    session_start();
}
include 'delete-subcontractor-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST" /*&& $_POST['accessTypeEdit'] != "Admin"*/){

    $usernameDelete = $_POST['usernameDelete'];

    $deleteObj = new DeleteSubcontractorModel($usernameDelete);

    $deleteObj->deleteSubcontractorRecord();

}/*else{
    $_SESSION['prompt'] = "Cannot delete this account!";
    header('location: ../modal-prompt.php');
    exit();
}*/
