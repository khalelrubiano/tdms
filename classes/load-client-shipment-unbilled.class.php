<?php
//PART OF NEW SYSTEM

if (!isset($_SESSION)) {
    session_start();
}
require_once "../config.php";


try {
    $configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT 
    shipment.shipment_id,
    shipment.shipment_number,
    shipment.date_of_delivery
    FROM shipment
    LEFT JOIN billedshipment
    ON shipment.shipment_id = billedshipment.shipment_id
    WHERE shipment.client_id = :client_id 
    AND shipment.shipment_status = 'Completed'
    AND billedshipment.billedshipment_id IS NULL";

    $stmt = $pdoVessel->prepare($sql);

    $stmt->bindParam(":client_id", $param1, PDO::PARAM_STR);

    $param1 = $_POST["clientAdd"];

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
