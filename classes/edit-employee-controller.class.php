
<?php
//PART OF NEW SYSTEM
include 'edit-employee-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $usernameEdit = $_POST['usernameEdit'];
    $passwordEdit = $_POST['passwordEdit'];
    $firstNameEdit = $_POST['firstNameEdit'];
    $middleNameEdit = $_POST['middleNameEdit'];
    $lastNameEdit = $_POST['lastNameEdit'];
    $roleNameEdit = $_POST["roleNameEdit"];

    $editObj = new EditEmployeeModel(
        $usernameEdit,
        $passwordEdit,
        $firstNameEdit,
        $middleNameEdit,
        $lastNameEdit,
        $roleNameEdit
    );

    $editObj->editEmployeeRecord();
    

    //echo $companyId;
}
