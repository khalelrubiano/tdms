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

    switch ($tabValue) {
        case "All":
            $sql = "SELECT 
            payroll.payroll_id,
            payroll.payroll_status,
            billing.billing_id,
            billing.invoice_number,
            billing.invoice_date
            FROM payroll
            INNER JOIN billing
            ON payroll.billing_id = billing.billing_id
            INNER JOIN client
            ON billing.client_id = client.client_id
            WHERE client.company_id = :company_id
            ORDER BY " . $orderBy . " LIMIT " . $startingLimitNumber . ',' . '4';
            break;
        case "Settled":
            $sql = "SELECT 
            payroll.payroll_id,
            payroll.payroll_status,
            billing.billing_id,
            billing.invoice_number,
            billing.invoice_date
            FROM payroll
            INNER JOIN billing
            ON payroll.billing_id = billing.billing_id
            INNER JOIN client
            ON billing.client_id = client.client_id
            WHERE client.company_id = :company_id
            AND payroll.payroll_status = 'Settled'
            ORDER BY " . $orderBy . " LIMIT " . $startingLimitNumber . ',' . '4';
            break;
        case "Unsettled":
            $sql = "SELECT 
            payroll.payroll_id,
            payroll.payroll_status,
            billing.billing_id,
            billing.invoice_number,
            billing.invoice_date
            FROM payroll
            INNER JOIN billing
            ON payroll.billing_id = billing.billing_id
            INNER JOIN client
            ON billing.client_id = client.client_id
            WHERE client.company_id = :company_id
            AND payroll.payroll_status = 'Unsettled'
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
