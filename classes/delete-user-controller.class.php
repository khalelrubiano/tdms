<?php 
if ( !isset($_SESSION) ) {
    session_start();
}
include 'delete-user-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST" /*&& $_POST['accessTypeEdit'] != "Admin"*/){

    $usernameDelete = $_POST['usernameDelete'];
    $companyName = $_SESSION["companyName"];

    $deleteObj = new DeleteUserModel($usernameDelete, $companyName);

    $deleteObj->deleteUserRecord();

}/*else{
    $_SESSION['prompt'] = "Cannot delete this account!";
    header('location: ../modal-prompt.php');
    exit();
}*/
