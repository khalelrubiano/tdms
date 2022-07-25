<?php
//PART OF NEW SYSTEM

if (!isset($_SESSION)) {
    session_start();
}
require_once "../config.php";

/*
shipment table
shipment_id
shipment_number
shipment_description
shipment_progress
destination
dateOfDelivery

clientarea table
area_id
area_name
area_rate
client_id

client table
client_id
client_name


plateNumber

progress_id
*/
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
    vehicle.plate_number
    FROM shipment
    INNER JOIN clientarea
    ON shipment.area_id = clientarea.area_id
    INNER JOIN client
    ON clientarea.client_id = client.client_id
    INNER JOIN vehicle
    ON shipment.vehicle_id = shipment.vehicle_id
    WHERE client.company_id = :company_id";

    $stmt = $pdoVessel->prepare($sql);

    $stmt->bindParam(":company_id", $paramCompanyId, PDO::PARAM_STR);

    $paramCompanyId = $_SESSION["companyId"];

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
