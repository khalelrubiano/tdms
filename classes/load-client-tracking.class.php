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
    shipment.shipment_id,
    shipment.shipment_number,
    shipment.shipment_status,
    shipment.shipment_description,
    shipment.destination,
    shipment.date_of_delivery,
    client.client_name,
    vehicle.plate_number,
    shipment.vehicle_id,
    shipment.area_id
    FROM shipment
    INNER JOIN clientarea
    ON shipment.area_id = clientarea.area_id
    INNER JOIN client
    ON clientarea.client_id = client.client_id
    INNER JOIN vehicle
    ON vehicle.vehicle_id = shipment.vehicle_id
    WHERE shipment.shipment_number = :shipment_number";

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
