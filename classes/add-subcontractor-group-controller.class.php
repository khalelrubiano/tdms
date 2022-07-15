<?php
if (!isset($_SESSION)) {
    session_start();
}
//PART OF NEW SYSTEM
include 'add-subcontractor-group-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $groupNameAdd = $_POST['groupNameAdd'];
    $groupOwnerAdd = $_POST['groupOwnerAdd'];
    $companyId = $_SESSION["companyId"];

    $addObj = new AddSubcontractorGroupModel(
        $groupNameAdd,
        $groupOwnerAdd,
        $companyId
    );

    $addObj->addSubcontractorGroupRecord();
    

    //echo $companyId;
}
