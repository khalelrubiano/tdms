
<?php
//PART OF NEW SYSTEM
include 'add-user-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $usernameAdd = $_POST['usernameAdd'];
    $passwordAdd = $_POST['passwordAdd'];
    $firstNameAdd = $_POST['firstNameAdd'];
    $middleNameAdd = $_POST['middleNameAdd'];
    $lastNameAdd = $_POST['lastNameAdd'];
    $roleNameAdd = $_POST["roleNameAdd"];

    $addObj = new AddUserModel(
        $usernameAdd,
        $passwordAdd,
        $firstNameAdd,
        $middleNameAdd,
        $lastNameAdd,
        $roleNameAdd
    );

    $addObj->addUserRecord();
    

    //echo $companyId;
}
