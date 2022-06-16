<?php 
include 'add-user-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $usernameAdd = $_POST['usernameAdd'];
    $passwordAdd = $_POST['passwordAdd'];
    $accessTypeAdd = $_POST['accessTypeAdd'];
    $firstNameAdd = $_POST['firstNameAdd'];
    $middleNameAdd = $_POST['middleNameAdd'];
    $lastNameAdd = $_POST['lastNameAdd'];
    $companyName = $_SESSION["companyName"];

    $addObj = new AddUserModel(
        $usernameAdd, 
        $passwordAdd, 
        $accessTypeAdd,
        $firstNameAdd,
        $middleNameAdd,
        $lastNameAdd,
        $companyName
    );

    $addObj->addUserRecord();

}