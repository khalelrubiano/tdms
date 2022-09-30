<?php
//PART OF NEW SYSTEM

if (!isset($_SESSION)) {
    session_start();
}
require_once "../config.php";

$tabValue = $_POST["tabValue"];
$orderBy = $_POST["orderBy"];

// billing_id, invoice_number, shipment_id, shipment_number, destination, area_name, area_rate, created_at (progress_description - 'Delivery Completed'), plate_number, created_at (billing date settled), first_name, middle_name, last_name


//billing, billedshipment, shipment, clientarea, shipmentprogress, vehicle, ownergroup, subcontractor

try {

    $configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();

    switch ($tabValue) {
        case "All":
            $sql = "SELECT 
            payroll.payroll_status, 
            payroll.plate_number, 
            payroll.date_settled, 
            billing.invoice_number, 
            subcontractor.first_name,
            subcontractor.middle_name,
            subcontractor.last_name,
            payroll.created_at,
            payroll.payroll_id
            FROM payroll 
            INNER JOIN billing
            ON payroll.billing_id = billing.billing_id
            INNER JOIN vehicle
            ON payroll.plate_number = vehicle.plate_number
            INNER JOIN ownergroup 
            ON vehicle.group_id = ownergroup.group_id
            INNER JOIN subcontractor 
            ON ownergroup.owner_id = subcontractor.subcontractor_id
            WHERE payroll.company_id = :company_id 
            AND ownergroup.owner_id = :subcontractor_id 
            ORDER BY " . $orderBy;
            break;
        case "Settled":
            $sql = "SELECT 
            payroll.payroll_status, 
            payroll.plate_number, 
            payroll.date_settled, 
            billing.invoice_number, 
            subcontractor.first_name,
            subcontractor.middle_name,
            subcontractor.last_name,
            payroll.created_at,
            payroll.payroll_id
            FROM payroll 
            INNER JOIN billing
            ON payroll.billing_id = billing.billing_id
            INNER JOIN vehicle
            ON payroll.plate_number = vehicle.plate_number
            INNER JOIN ownergroup 
            ON vehicle.group_id = ownergroup.group_id
            INNER JOIN subcontractor 
            ON ownergroup.owner_id = subcontractor.subcontractor_id
            WHERE payroll.company_id = :company_id 
            AND payroll.payroll_status = 'Settled' 
            AND ownergroup.owner_id = :subcontractor_id 
            ORDER BY " . $orderBy;
            break;
        case "Unsettled":
            $sql = "SELECT 
            payroll.payroll_status, 
            payroll.plate_number, 
            payroll.date_settled, 
            billing.invoice_number, 
            subcontractor.first_name,
            subcontractor.middle_name,
            subcontractor.last_name,
            payroll.created_at,
            payroll.payroll_id
            FROM payroll 
            INNER JOIN billing
            ON payroll.billing_id = billing.billing_id
            INNER JOIN vehicle
            ON payroll.plate_number = vehicle.plate_number
            INNER JOIN ownergroup 
            ON vehicle.group_id = ownergroup.group_id
            INNER JOIN subcontractor 
            ON ownergroup.owner_id = subcontractor.subcontractor_id
            WHERE payroll.company_id = :company_id 
            AND payroll.payroll_status = 'Unsettled' 
            AND ownergroup.owner_id = :subcontractor_id 
            ORDER BY " . $orderBy;
            break;
    }

    $stmt = $pdoVessel->prepare($sql);

    $stmt->bindParam(":company_id", $param1, PDO::PARAM_STR);
    $stmt->bindParam(":subcontractor_id", $param2, PDO::PARAM_STR);

    $param1 = $_SESSION["companyId"];
    $param2 = $_SESSION["subcontractorId"];

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
