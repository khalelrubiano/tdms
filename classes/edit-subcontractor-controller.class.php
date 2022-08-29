
<?php
if (!isset($_SESSION)) {
    session_start();
}
//PART OF NEW SYSTEM
include 'edit-subcontractor-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $usernameEdit = $_POST['usernameEdit'];
    $passwordEdit = $_POST['passwordEdit'];
    $firstNameEdit = $_POST['firstNameEdit'];
    $middleNameEdit = $_POST['middleNameEdit'];
    $lastNameEdit = $_POST['lastNameEdit'];
    $companyId = $_SESSION["companyId"];

    $editObj = new EditSubcontractorModel(
        $usernameEdit,
        $passwordEdit,
        $firstNameEdit,
        $middleNameEdit,
        $lastNameEdit,
        $companyId
    );

    $editObj->editSubcontractorRecord();
    

    //echo $companyId;
}
