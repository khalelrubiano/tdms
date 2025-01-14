<?php
//PART OF NEW SYSTEM

if (!isset($_SESSION)) {
    session_start();
}
require_once "../config.php";

try {
    $configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT shipment.area_rate, shipment.shipment_number, shipment.plate_number, shipment.date_of_delivery 
    FROM billedshipment
    INNER JOIN shipment
    ON billedshipment.shipment_id = shipment.shipment_id
    WHERE billedshipment.billing_id = :billing_id";

    $stmt = $pdoVessel->prepare($sql);

    $stmt->bindParam(":billing_id", $param1, PDO::PARAM_STR);

    $param1 = $_POST["billingId"];

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
