<?php
if (!isset($_SESSION)) {
    session_start();
}
//PART OF NEW SYSTEM
include 'edit-subcontractor-group-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $groupIdEdit = $_POST['groupIdEdit'];
    $groupNameEdit = $_POST['groupNameEdit'];
    $groupOwnerEdit = $_POST['groupOwnerEdit'];
    $companyId = $_SESSION["companyId"];

    $editObj = new EditSubcontractorGroupModel(
        $groupIdEdit,
        $groupNameEdit,
        $groupOwnerEdit,
        $companyId
    );

    $editObj->editSubcontractorGroupRecord();
    

    //echo $companyId;
}
