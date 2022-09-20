
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
    $destinationAdd = $_POST['destinationAdd'];
    $typeAdd = $_POST['typeAdd'];

    $addObj = new AddClientAreaModel(
        $areaNameAdd,
        $areaRateAdd,
        $clientId,
        $destinationAdd,
        $typeAdd
    );

    $addObj->addClientAreaRecord();
    

    //echo $companyId;
}
