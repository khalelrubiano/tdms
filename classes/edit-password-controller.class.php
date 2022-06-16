<?php 
include 'edit-password-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $passwordEdit = $_POST['passwordEdit'];

    $editObj = new EditPasswordModel($passwordEdit);

    $editObj->editPasswordRecord();

}