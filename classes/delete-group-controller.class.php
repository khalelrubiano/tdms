<?php 
if ( !isset($_SESSION) ) {
    session_start();
}
include 'delete-group-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST" /*&& $_POST['accessTypeEdit'] != "Admin"*/){

    $usernameDelete = $_POST['usernameDelete'];

    $deleteObj = new DeleteGroupModel($usernameDelete);

    $deleteObj->deleteGroupRecord();

}/*else{
    $_SESSION['prompt'] = "Cannot delete this account!";
    header('location: ../modal-prompt.php');
    exit();
}*/
