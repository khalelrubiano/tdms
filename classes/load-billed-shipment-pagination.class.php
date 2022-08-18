<?php
//PART OF NEW SYSTEM

if (!isset($_SESSION)) {
    session_start();
}
require_once "../config.php";

$currentPageNumber = $_POST["currentPageNumber"];

//$test = 2;
$startingLimitNumber = ($currentPageNumber - 1) * 5;

//echo $startingLimitNumber;

try {
    $configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT clientarea.area_rate, shipment.shipment_number, vehicle.plate_number, shipmentprogress.created_at 
    FROM billedshipment
    INNER JOIN shipment
    ON billedshipment.shipment_id = shipment.shipment_id
    INNER JOIN clientarea
    ON shipment.area_id = clientarea.area_id
    INNER JOIN vehicle
    ON shipment.vehicle_id = vehicle.vehicle_id
    INNER JOIN shipmentprogress
    ON billedshipment.shipment_id = shipmentprogress.shipment_id
    WHERE billedshipment.billing_id = :billing_id AND shipmentprogress.progress_description = 'Delivery Completed'
    ORDER BY shipment.shipment_number ASC
    LIMIT " . $startingLimitNumber . ',' . '5';

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
