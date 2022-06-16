<?php 
include 'edit-user-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $usernameEdit = $_POST['usernameEdit'];
    $passwordEdit = $_POST['passwordEdit'];
    $accessTypeEdit = $_POST['accessTypeEdit'];
    $firstNameEdit = $_POST['firstNameEdit'];
    $middleNameEdit = $_POST['middleNameEdit'];
    $lastNameEdit = $_POST['lastNameEdit'];
    $companyName = $_SESSION["companyName"];

    $addObj = new EditUserModel(
        $usernameEdit, 
        $passwordEdit, 
        $accessTypeEdit,
        $firstNameEdit, 
        $middleNameEdit, 
        $lastNameEdit,
        $companyName
    );

    $addObj->editUserRecord();

}