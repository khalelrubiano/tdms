<?php
//PART OF NEW SYSTEM

if (!isset($_SESSION)) {
    session_start();
}
require_once "../config.php";

// billing_id, invoice_number, shipment_id, shipment_number, destination, area_name, area_rate, created_at (progress_description - 'Delivery Completed'), plate_number, created_at (billing date settled), first_name, middle_name, last_name


//billing, billedshipment, shipment, clientarea, shipmentprogress, vehicle, ownergroup, subcontractor

$currentPageNumber = $_POST["currentPageNumber"];

//$test = 2;
$startingLimitNumber = ($currentPageNumber - 1) * 5;

//echo $startingLimitNumber;

try {

    $configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();


    $sql = "SELECT 
    shipment.date_of_delivery,
    shipment.shipment_number,
    shipment.destination,
    shipment.area_name,
    shipment.area_rate,
    shipmentfees.drop_fee,
    shipmentfees.penalty
    FROM shipment
    INNER JOIN shipmentfees 
    ON shipment.shipment_id = shipmentfees.shipment_id
    INNER JOIN payrollshipment
    ON shipment.shipment_id = payrollshipment.shipment_id
    WHERE payrollshipment.payroll_id = :payroll_id
    ORDER BY shipment.created_at ASC
    LIMIT " . $startingLimitNumber . ',' . '5';

    $stmt = $pdoVessel->prepare($sql);

    $stmt->bindParam(":payroll_id", $param1, PDO::PARAM_STR);

    $param1 = $_POST["payrollId"];


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
