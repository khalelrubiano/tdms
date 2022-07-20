<?php 
if ( !isset($_SESSION) ) {
    session_start();
}
include 'delete-client-area-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST" /*&& $_POST['accessTypeEdit'] != "Admin"*/){

    $clientAreaIdDelete = $_POST['clientAreaIdDelete'];

    $deleteObj = new DeleteClientAreaModel($clientAreaIdDelete);

    $deleteObj->deleteClientAreaRecord();

}/*else{
    $_SESSION['prompt'] = "Cannot delete this account!";
    header('location: ../modal-prompt.php');
    exit();
}*/
