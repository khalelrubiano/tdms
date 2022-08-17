<?php
//PART OF NEW SYSTEM

if (!isset($_SESSION)) {
    session_start();
}
require_once "../config.php";


try {
    $configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();

    if ($_SESSION["isDriver"] == "Yes") {
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
        ON vehicle.vehicle_id = shipment.vehicle_id
        WHERE client.company_id = :company_id
        AND vehicle.driver_id = :subcontractor_id";
    }
    if ($_SESSION["isHelper"] == "Yes") {
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
        ON vehicle.vehicle_id = shipment.vehicle_id
        WHERE client.company_id = :company_id
        AND vehicle.helper_id = :subcontractor_id";
    }
    
    if ($_SESSION["isOwner"] == "Yes") {
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
        ON vehicle.vehicle_id = shipment.vehicle_id
        INNER JOIN ownergroup
        ON ownergroup.group_id = vehicle.group_id
        WHERE client.company_id = :company_id
        AND ownergroup.owner_id = :subcontractor_id";
    }

    $stmt = $pdoVessel->prepare($sql);

    $stmt->bindParam(":company_id", $paramCompanyId, PDO::PARAM_STR);
    $stmt->bindParam(":subcontractor_id", $paramSubcontractorId, PDO::PARAM_STR);

    $paramCompanyId = $_SESSION["companyId"];
    $paramSubcontractorId = $_SESSION["subcontractorId"];

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
