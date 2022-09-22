<?php
//PART OF NEW SYSTEM

if (!isset($_SESSION)) {
    session_start();
}
require_once "../config.php";

$tabValue = $_POST["tabValue"];
$currentPageNumber = $_POST["currentPageNumber"];
$orderBy = $_POST["orderBy"];

if (isset($_SESSION["isOwner"])) {
    $isOwner = $_SESSION["isOwner"];
};

if (isset($_SESSION["isDriver"])) {
    $isDriver = $_SESSION["isDriver"];
};

if (isset($_SESSION["isHelper"])) {
    $isHelper = $_SESSION["isHelper"];
};
/*
if (isset($_SESSION["isPreviousDriver"])) {
    $isPreviousDriver = $_SESSION["isPreviousDriver"];
};

if (isset($_SESSION["isPreviousHelper"])) {
    $isPreviousHelper = $_SESSION["isPreviousHelper"];
};
*/
//$isPreviousHelper = $_SESSION["isPreviousHelper"];

//$test = 2;
$startingLimitNumber = ($currentPageNumber - 1) * 4;

//echo $startingLimitNumber;


try {
    $configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();

    if ($isDriver == "Yes") {

        switch ($tabValue) {
            case "All":
                $sql = "SELECT 
                *
                FROM shipment
                INNER JOIN client 
                ON shipment.client_id = client.client_id
                WHERE shipment.company_id = :company_id
                AND shipment.driver_id = :subcontractor_id
                ORDER BY " . $orderBy . " LIMIT " . $startingLimitNumber . ',' . '4';

                break;
            case "In-progress":
                $sql = "SELECT 
                *
                FROM shipment
                INNER JOIN client 
                ON shipment.client_id = client.client_id
                WHERE shipment.company_id = :company_id
                AND shipment.driver_id = :subcontractor_id
                AND shipment.shipment_status = 'In-progress' 
                ORDER BY " . $orderBy . " LIMIT " . $startingLimitNumber . ',' . '4';
                break;
            case "Completed":
                $sql = "SELECT 
                *
                FROM shipment
                INNER JOIN client 
                ON shipment.client_id = client.client_id
                WHERE shipment.company_id = :company_id
                AND shipment.driver_id = :subcontractor_id
                AND shipment.shipment_status = 'Completed' 
                ORDER BY " . $orderBy . " LIMIT " . $startingLimitNumber . ',' . '4';
                break;
            case "Cancelled":
                $sql = "SELECT 
                *
                FROM shipment
                INNER JOIN client 
                ON shipment.client_id = client.client_id
                WHERE shipment.company_id = :company_id
                AND shipment.driver_id = :subcontractor_id
                AND shipment.shipment_status = 'Cancelled' 
                ORDER BY " . $orderBy . " LIMIT " . $startingLimitNumber . ',' . '4';
                break;
        }
        //return $sql;
    }

    if ($isHelper == "Yes") {

        switch ($tabValue) {
            case "All":
                $sql = "SELECT 
                *
                FROM shipment
                INNER JOIN client 
                ON shipment.client_id = client.client_id
                WHERE shipment.company_id = :company_id
                AND shipment.helper_id = :subcontractor_id
                ORDER BY " . $orderBy . " LIMIT " . $startingLimitNumber . ',' . '4';

                break;
            case "In-progress":
                $sql = "SELECT 
                *
                FROM shipment
                INNER JOIN client 
                ON shipment.client_id = client.client_id
                WHERE shipment.company_id = :company_id
                AND shipment.helper_id = :subcontractor_id
                AND shipment.shipment_status = 'In-progress' 
                AND vehicle.helper_id = :subcontractor_id
                ORDER BY " . $orderBy . " LIMIT " . $startingLimitNumber . ',' . '4';
                break;
            case "Completed":
                $sql = "SELECT 
                *
                FROM shipment
                INNER JOIN client 
                ON shipment.client_id = client.client_id
                WHERE shipment.company_id = :company_id
                AND shipment.helper_id = :subcontractor_id
                AND shipment.shipment_status = 'Completed' 
                ORDER BY " . $orderBy . " LIMIT " . $startingLimitNumber . ',' . '4';
                break;
            case "Cancelled":
                $sql = "SELECT 
                *
                FROM shipment
                INNER JOIN client 
                ON shipment.client_id = client.client_id
                WHERE shipment.company_id = :company_id
                AND shipment.helper_id = :subcontractor_id
                AND shipment.shipment_status = 'Cancelled' 
                ORDER BY " . $orderBy . " LIMIT " . $startingLimitNumber . ',' . '4';
                break;
        }
        //return $sql;
    }

    if ($isOwner == "Yes") {

        switch ($tabValue) {
            case "All":
                $sql = "SELECT 
                *
                FROM shipment
                INNER JOIN client 
                ON shipment.client_id = client.client_id
                INNER JOIN vehicle
                ON shipment.plate_number = vehicle.plate_number
                INNER JOIN ownergroup
                ON vehicle.group_id = ownergroup.group_id
                WHERE shipment.company_id = :company_id
                AND ownergroup.owner_id = :subcontractor_id
                ORDER BY " . $orderBy . " LIMIT " . $startingLimitNumber . ',' . '4';

                break;
            case "In-progress":
                $sql = "SELECT 
                *
                FROM shipment
                INNER JOIN client 
                ON shipment.client_id = client.client_id
                INNER JOIN vehicle
                ON shipment.plate_number = vehicle.plate_number
                INNER JOIN ownergroup
                ON vehicle.group_id = ownergroup.group_id
                WHERE shipment.company_id = :company_id
                AND ownergroup.owner_id = :subcontractor_id
                AND shipment.shipment_status = 'In-progress' 
                ORDER BY " . $orderBy . " LIMIT " . $startingLimitNumber . ',' . '4';
                break;
            case "Completed":
                $sql = "SELECT 
                *
                FROM shipment
                INNER JOIN client 
                ON shipment.client_id = client.client_id
                INNER JOIN vehicle
                ON shipment.plate_number = vehicle.plate_number
                INNER JOIN ownergroup
                ON vehicle.group_id = ownergroup.group_id
                WHERE shipment.company_id = :company_id
                AND ownergroup.owner_id = :subcontractor_id
                AND shipment.shipment_status = 'Completed' 
                ORDER BY " . $orderBy . " LIMIT " . $startingLimitNumber . ',' . '4';
                break;
            case "Cancelled":
                $sql = "SELECT 
                *
                FROM shipment
                INNER JOIN client 
                ON shipment.client_id = client.client_id
                INNER JOIN vehicle
                ON shipment.plate_number = vehicle.plate_number
                INNER JOIN ownergroup
                ON vehicle.group_id = ownergroup.group_id
                WHERE shipment.company_id = :company_id
                AND ownergroup.owner_id = :subcontractor_id
                AND shipment.shipment_status = 'Cancelled' 
                ORDER BY " . $orderBy . " LIMIT " . $startingLimitNumber . ',' . '4';
                break;
        }
        //return $sql;
    }

    /*
    switch ($tabValue) {
        case "All":
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
            WHERE client.company_id = :company_id
            AND vehicle.driver_id = :subcontractor_id
            ORDER BY " . $orderBy . " LIMIT " . $startingLimitNumber . ',' . '4';
            break;
        case "In-progress":
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
            WHERE client.company_id = :company_id
            AND shipment.shipment_status = 'In-progress' 
            AND vehicle.driver_id = :subcontractor_id
            ORDER BY " . $orderBy . " LIMIT " . $startingLimitNumber . ',' . '4';
            break;
        case "Completed":
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
            WHERE client.company_id = :company_id
            AND shipment.shipment_status = 'Completed' 
            AND vehicle.driver_id = :subcontractor_id
            ORDER BY " . $orderBy . " LIMIT " . $startingLimitNumber . ',' . '4';
            break;
        case "Cancelled":
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
            WHERE client.company_id = :company_id
            AND shipment.shipment_status = 'Cancelled' 
            AND vehicle.driver_id = :subcontractor_id
            ORDER BY " . $orderBy . " LIMIT " . $startingLimitNumber . ',' . '4';
            break;
    }*/
    /*
    $sql = "SELECT 
    shipment.shipment_id,
    shipment.shipment_number,
    shipment.shipment_status,
    shipment.starting_point,
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
    WHERE client.company_id = :company_id
    ORDER BY " . $orderBy . " LIMIT " . $startingLimitNumber . ',' . '4';*/

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
/*
use isOwner session variable then haave if statements

also need to disable updateBtn is the user isOwner
*/