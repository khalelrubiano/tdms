
<?php
//PART OF NEW SYSTEM
if (!isset($_SESSION)) {
    session_start();
}
include 'add-client-model.class.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $clientNameAdd = $_POST['clientNameAdd'];
    $clientAddressAdd = $_POST['clientAddressAdd'];
    $companyId = $_SESSION["companyId"];

    $addObj = new AddClientModel(
        $clientNameAdd,
        $clientAddressAdd,
        $companyId
    );

    $addObj->addClientRecord();
    

    //echo $companyId;
}
