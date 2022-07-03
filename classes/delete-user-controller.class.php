<?php 
if ( !isset($_SESSION) ) {
    session_start();
}
include 'delete-user-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST" /*&& $_POST['accessTypeEdit'] != "Admin"*/){

    $usernameDelete = $_POST['usernameDelete'];

    $deleteObj = new DeleteUserModel($usernameDelete);

    $deleteObj->deleteUserRecord();

}/*else{
    $_SESSION['prompt'] = "Cannot delete this account!";
    header('location: ../modal-prompt.php');
    exit();
}*/
