<?php 
if ( !isset($_SESSION) ) {
    session_start();
}
include 'delete-tracker-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST" /*&& $_POST['accessTypeEdit'] != "Admin"*/){

    $trackerIdDelete = $_POST['trackerIdDelete'];

    $deleteObj = new DeleteClientModel($trackerIdDelete);

    $deleteObj->deleteClientRecord();

}/*else{
    $_SESSION['prompt'] = "Cannot delete this account!";
    header('location: ../modal-prompt.php');
    exit();
}*/
