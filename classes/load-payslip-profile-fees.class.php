<?php
//PART OF NEW SYSTEM

if (!isset($_SESSION)) {
    session_start();
}
require_once "../config.php";

// billing_id, invoice_number, shipment_id, shipment_number, destination, area_name, area_rate, created_at (progress_description - 'Delivery Completed'), plate_number, created_at (billing date settled), first_name, middle_name, last_name


//billing, billedshipment, shipment, clientarea, shipmentprogress, vehicle, ownergroup, subcontractor

try {

    $configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT 
    billing.invoice_number,
    payroll.plate_number,
    subcontractor.first_name,
    subcontractor.middle_name,
    subcontractor.last_name,
    payroll.created_at, 
    payroll.truck_rate, 
    payroll.drop_off,
    payroll.penalty,
    vehicle.commission_rate,
    payroll.remarks
    FROM payroll 
    INNER JOIN billing
    ON payroll.billing_id = billing.billing_id
    INNER JOIN vehicle
    ON payroll.plate_number = vehicle.plate_number
    INNER JOIN ownergroup 
    ON vehicle.group_id = ownergroup.group_id
    INNER JOIN subcontractor 
    ON ownergroup.owner_id = subcontractor.subcontractor_id
    WHERE payroll.payroll_id = :payroll_id";

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
