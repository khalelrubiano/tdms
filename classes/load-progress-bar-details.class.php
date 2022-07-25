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
    progress_id,
    progress_description,
    created_at
    FROM shipmentprogress
    WHERE shipment_id = :shipment_id";

    $stmt = $pdoVessel->prepare($sql);

    $stmt->bindParam(":shipment_id", $paramShipmentId, PDO::PARAM_STR);

    $paramShipmentId = $shipmentId;

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
