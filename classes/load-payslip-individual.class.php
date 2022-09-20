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
            billing.billing_id, 
            billing.invoice_number,
            shipment.shipment_id, 
            shipment.shipment_number,
            shipment.destination,
            clientarea.area_name,
            clientarea.area_rate,
            shipmentprogress.created_at AS date_completed,
            vehicle.plate_number,
            subcontractor.first_name,
            subcontractor.middle_name,
            subcontractor.last_name,
            billingdate.created_at AS date_of_settlement,
            payroll.payroll_status,
            payroll.payroll_id,
            payroll.created_at,
            ownergroup.owner_id,
            payrolldate.created_at
            FROM billing
            INNER JOIN billedshipment
            ON billing.billing_id = billedshipment.billing_id
            INNER JOIN billingdate
            ON billing.billing_id = billingdate.billing_id
            INNER JOIN shipment
            ON billedshipment.shipment_id = shipment.shipment_id
            INNER JOIN clientarea
            ON shipment.area_id = clientarea.area_id
            INNER JOIN shipmentprogress
            ON shipment.shipment_id = shipmentprogress.shipment_id
            INNER JOIN vehicle
            ON shipment.vehicle_id = vehicle.vehicle_id
            INNER JOIN ownergroup
            ON vehicle.group_id = ownergroup.group_id
            INNER JOIN subcontractor
            ON ownergroup.owner_id = subcontractor.subcontractor_id
            INNER JOIN payroll
            ON shipment.shipment_id = payroll.shipment_id
            LEFT JOIN payrolldate
            ON payroll.payroll_id = payrolldate.payroll_id
            WHERE shipmentprogress.progress_description = 'Delivery Completed'
            AND ownergroup.owner_id = :owner_id
            GROUP BY vehicle.plate_number, billing.billing_id
            ORDER BY " . $orderBy;
            break;
        case "Settled":
            $sql = "SELECT 
            billing.billing_id, 
            billing.invoice_number,
            shipment.shipment_id, 
            shipment.shipment_number,
            shipment.destination,
            clientarea.area_name,
            clientarea.area_rate,
            shipmentprogress.created_at AS date_completed,
            vehicle.plate_number,
            subcontractor.first_name,
            subcontractor.middle_name,
            subcontractor.last_name,
            billingdate.created_at AS date_of_settlement,
            payroll.payroll_status,
            payroll.payroll_id,
            payroll.created_at,
            ownergroup.owner_id,
            payrolldate.created_at
            FROM billing
            INNER JOIN billedshipment
            ON billing.billing_id = billedshipment.billing_id
            INNER JOIN billingdate
            ON billing.billing_id = billingdate.billing_id
            INNER JOIN shipment
            ON billedshipment.shipment_id = shipment.shipment_id
            INNER JOIN clientarea
            ON shipment.area_id = clientarea.area_id
            INNER JOIN shipmentprogress
            ON shipment.shipment_id = shipmentprogress.shipment_id
            INNER JOIN vehicle
            ON shipment.vehicle_id = vehicle.vehicle_id
            INNER JOIN ownergroup
            ON vehicle.group_id = ownergroup.group_id
            INNER JOIN subcontractor
            ON ownergroup.owner_id = subcontractor.subcontractor_id
            INNER JOIN payroll
            ON shipment.shipment_id = payroll.shipment_id
            INNER JOIN payrolldate
            ON payroll.payroll_id = payrolldate.payroll_id
            WHERE shipmentprogress.progress_description = 'Delivery Completed'
            AND ownergroup.owner_id = :owner_id
            AND payroll.payroll_status = 'Settled'
            GROUP BY vehicle.plate_number, billing.billing_id
            ORDER BY " . $orderBy;
            break;
        case "Unsettled":
            $sql = "SELECT 
            billing.billing_id, 
            billing.invoice_number,
            shipment.shipment_id, 
            shipment.shipment_number,
            shipment.destination,
            clientarea.area_name,
            clientarea.area_rate,
            shipmentprogress.created_at AS date_completed,
            vehicle.plate_number,
            subcontractor.first_name,
            subcontractor.middle_name,
            subcontractor.last_name,
            billingdate.created_at AS date_of_settlement,
            payroll.payroll_status,
            payroll.payroll_id,
            payroll.created_at,
            ownergroup.owner_id
            FROM billing
            INNER JOIN billedshipment
            ON billing.billing_id = billedshipment.billing_id
            INNER JOIN billingdate
            ON billing.billing_id = billingdate.billing_id
            INNER JOIN shipment
            ON billedshipment.shipment_id = shipment.shipment_id
            INNER JOIN clientarea
            ON shipment.area_id = clientarea.area_id
            INNER JOIN shipmentprogress
            ON shipment.shipment_id = shipmentprogress.shipment_id
            INNER JOIN vehicle
            ON shipment.vehicle_id = vehicle.vehicle_id
            INNER JOIN ownergroup
            ON vehicle.group_id = ownergroup.group_id
            INNER JOIN subcontractor
            ON ownergroup.owner_id = subcontractor.subcontractor_id
            INNER JOIN payroll
            ON shipment.shipment_id = payroll.shipment_id
            WHERE shipmentprogress.progress_description = 'Delivery Completed'
            AND ownergroup.owner_id = :owner_id
            AND payroll.payroll_status = 'Unsettled'
            GROUP BY vehicle.plate_number, billing.billing_id
            ORDER BY " . $orderBy;
            break;
    }
/*
    $sql = "SELECT 
    billing.billing_id, 
    billing.invoice_number,
    shipment.shipment_id, 
    shipment.shipment_number,
    shipment.destination,
    clientarea.area_name,
    clientarea.area_rate,
    shipmentprogress.created_at AS date_completed,
    vehicle.plate_number,
    subcontractor.first_name,
    subcontractor.middle_name,
    subcontractor.last_name,
    billingdate.created_at AS date_of_settlement,
    payroll.payroll_status,
    payroll.payroll_id,
    payroll.created_at
    FROM billing
    INNER JOIN billedshipment
    ON billing.billing_id = billedshipment.billing_id
    INNER JOIN billingdate
    ON billing.billing_id = billingdate.billing_id
    INNER JOIN shipment
    ON billedshipment.shipment_id = shipment.shipment_id
    INNER JOIN clientarea
    ON shipment.area_id = clientarea.area_id
    INNER JOIN shipmentprogress
    ON shipment.shipment_id = shipmentprogress.shipment_id
    INNER JOIN vehicle
    ON shipment.vehicle_id = vehicle.vehicle_id
    INNER JOIN ownergroup
    ON vehicle.group_id = ownergroup.group_id
    INNER JOIN subcontractor
    ON ownergroup.owner_id = subcontractor.subcontractor_id
    INNER JOIN payroll
    ON shipment.shipment_id = payroll.shipment_id
    WHERE shipmentprogress.progress_description = 'Delivery Completed'
    AND subcontractor.company_id = :company_id
    AND billing.billing_status = 'Unsettled'
    ORDER BY " . $orderBy;
    break;
*/
    $stmt = $pdoVessel->prepare($sql);
    
    $stmt->bindParam(":owner_id", $param1, PDO::PARAM_STR);

    $param1 = $_SESSION["subcontractorId"];

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
