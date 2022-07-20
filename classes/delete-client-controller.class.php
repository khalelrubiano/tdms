<?php 
if ( !isset($_SESSION) ) {
    session_start();
}
include 'delete-client-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST" /*&& $_POST['accessTypeEdit'] != "Admin"*/){

    $clientIdDelete = $_POST['clientIdDelete'];

    $deleteObj = new DeleteClientModel($clientIdDelete);

    $deleteObj->deleteClientRecord();

}/*else{
    $_SESSION['prompt'] = "Cannot delete this account!";
    header('location: ../modal-prompt.php');
    exit();
}*/
