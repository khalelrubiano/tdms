
<?php
//PART OF NEW SYSTEM
include 'add-employee-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $employeeNumberAdd = $_POST['employeeNumberAdd'];
    $usernameAdd = $_POST['usernameAdd'];
    $passwordAdd = $_POST['passwordAdd'];
    $firstNameAdd = $_POST['firstNameAdd'];
    $middleNameAdd = $_POST['middleNameAdd'];
    $lastNameAdd = $_POST['lastNameAdd'];
    $roleNameAdd = $_POST["roleNameAdd"];

    $addObj = new AddEmployeeModel(
        $employeeNumberAdd,
        $usernameAdd,
        $passwordAdd,
        $firstNameAdd,
        $middleNameAdd,
        $lastNameAdd,
        $roleNameAdd
    );

    $addObj->addEmployeeRecord();
    

    //echo $companyId;
}
