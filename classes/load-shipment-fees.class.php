<?php
//PART OF NEW SYSTEM

if (!isset($_SESSION)) {
    session_start();
}
require_once "../config.php";


$shipmentId = $_POST["shipmentId"];

try {
    $configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT 
    shipment.area_rate,
    shipmentfees.drop_fee,
    shipmentfees.parking_fee,
    shipmentfees.toll_fee,
    shipmentfees.fuel_charge,
    shipmentfees.extra_helper,
    shipmentfees.demurrage,
    shipmentfees.other_charges,
    shipmentfees.penalty
    FROM shipment 
    INNER JOIN shipmentfees 
    ON shipment.shipment_id = shipmentfees.shipment_id 
    WHERE shipmentfees.shipment_id = :shipment_id";

    $stmt = $pdoVessel->prepare($sql);

    $stmt->bindParam(":shipment_id", $param1, PDO::PARAM_STR);

    $param1 = $_POST["shipmentId"];

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
