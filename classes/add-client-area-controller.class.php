
<?php
//PART OF NEW SYSTEM
if (!isset($_SESSION)) {
    session_start();
}
include 'add-client-area-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $areaNameAdd = $_POST['areaNameAdd'];
    $areaRateAdd = $_POST['areaRateAdd'];
    $clientId = $_POST['clientId'];

    $addObj = new AddClientAreaModel(
        $areaNameAdd,
        $areaRateAdd,
        $clientId
    );

    $addObj->addClientAreaRecord();
    

    //echo $companyId;
}
