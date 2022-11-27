<?php
//PART OF NEW SYSTEM

if (!isset($_SESSION)) {
    session_start();
}
require_once "../config.php";

$tabValue = $_POST["tabValue"];
$currentPageNumber = $_POST["currentPageNumber"];
$orderBy = $_POST["orderBy"];

//$test = 2;
$startingLimitNumber = ($currentPageNumber - 1) * 4;

//echo $startingLimitNumber;


try {
    $configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();

    switch ($tabValue . $orderBy) {
        case "Allbilling.invoice_number":
            $sql = "SELECT 
            *
            FROM billing
            INNER JOIN client
            ON billing.client_id = client.client_id
            WHERE client.company_id = :company_id
            ORDER BY CAST(" . $orderBy . " AS UNSIGNED) LIMIT " . $startingLimitNumber . ',' . '4';
            break;
        case "Allbilling.invoice_date":
            $sql = "SELECT 
                *
                FROM billing
                INNER JOIN client
                ON billing.client_id = client.client_id
                WHERE client.company_id = :company_id
                ORDER BY " . $orderBy . " LIMIT " . $startingLimitNumber . ',' . '4';
            break;
        case "Settledbilling.invoice_number":
            $sql = "SELECT 
            *
            FROM billing
            INNER JOIN client
            ON billing.client_id = client.client_id
            WHERE client.company_id = :company_id
            AND billing.billing_status = 'Settled'
            ORDER BY CAST(" . $orderBy . " AS UNSIGNED) LIMIT " . $startingLimitNumber . ',' . '4';
            break;
        case "Settledbilling.invoice_date":
            $sql = "SELECT 
                *
                FROM billing
                INNER JOIN client
                ON billing.client_id = client.client_id
                WHERE client.company_id = :company_id
                AND billing.billing_status = 'Settled'
                ORDER BY " . $orderBy . " LIMIT " . $startingLimitNumber . ',' . '4';
            break;
        case "Unsettledbilling.invoice_number":
            $sql = "SELECT 
            *
            FROM billing
            INNER JOIN client
            ON billing.client_id = client.client_id
            WHERE client.company_id = :company_id
            AND billing.billing_status = 'Unsettled'
            ORDER BY CAST(" . $orderBy . " AS UNSIGNED) LIMIT " . $startingLimitNumber . ',' . '4';
            break;
        case "Unsettledbilling.invoice_date":
            $sql = "SELECT 
                *
                FROM billing
                INNER JOIN client
                ON billing.client_id = client.client_id
                WHERE client.company_id = :company_id
                AND billing.billing_status = 'Unsettled'
                ORDER BY " . $orderBy . " LIMIT " . $startingLimitNumber . ',' . '4';
            break;
    }
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
