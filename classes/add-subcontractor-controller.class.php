
<?php
if (!isset($_SESSION)) {
    session_start();
}
//PART OF NEW SYSTEM
include 'add-subcontractor-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $usernameAdd = $_POST['usernameAdd'];
    $passwordAdd = $_POST['passwordAdd'];
    $firstNameAdd = $_POST['firstNameAdd'];
    $middleNameAdd = $_POST['middleNameAdd'];
    $lastNameAdd = $_POST['lastNameAdd'];
    $companyId = $_SESSION["companyId"];

    $addObj = new AddSubcontractorModel(
        $usernameAdd,
        $passwordAdd,
        $firstNameAdd,
        $middleNameAdd,
        $lastNameAdd,
        $companyId
    );

    $addObj->addSubcontractorRecord();
    

    //echo $companyId;
}
