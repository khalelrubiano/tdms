<?php
//PART OF NEW SYSTEM

if (!isset($_SESSION)) {
    session_start();
}
require_once "../config.php";

//$shipmentNumber = $_POST["shipmentNumber"];

//echo $startingLimitNumber;


try {
    $configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();


    $sql = "SELECT 
    *
    FROM shipment 
    INNER JOIN client 
    ON shipment.client_id = client.client_id
    WHERE shipment_number = :shipment_number";

    $stmt = $pdoVessel->prepare($sql);

    $stmt->bindParam(":shipment_number", $param1, PDO::PARAM_STR);

    $param1 = $_POST["shipmentNumber"];

    $stmt->execute();
    $row = $stmt->fetchAll();
    $json = json_encode($row);

    echo $json;
} catch (Exception $ex) {
    session_start();
    $_SESSION['prompt'] = "Something went wrong!";
    header('location: ../prompt.php');
    exit();
}
