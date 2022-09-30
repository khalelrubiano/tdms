<?php
//PART OF NEW SYSTEM
if (!isset($_SESSION)) {
    session_start();
}
require_once "../config.php";

function getFees()
{
    $configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT 
    subcontractor.first_name,
    subcontractor.middle_name,
    subcontractor.last_name,
    payroll.plate_number,
    payroll.created_at, 
    payroll.remarks,
    payroll.truck_rate, 
    payroll.drop_off,
    payroll.penalty,
    vehicle.commission_rate
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

    $_SESSION["ownerHeader"] = $row[0][0] . ' ' . $row[0][1] . ' ' . $row[0][2];
    $_SESSION["plateNumberHeader"] = $row[0][3];
    $_SESSION["dateHeader"] = $row[0][4];
    $_SESSION["remarksHeader"] = $row[0][5];
    $_SESSION["truckRateTD"] = $row[0][6];
    $_SESSION["dropOffTD"] = $row[0][7];
    $_SESSION["penaltyTD"] = $row[0][8];
    $_SESSION["totalTD"] = (floatval($row[0][6]) + floatval($row[0][7])) - floatval($row[0][8]);
    $_SESSION["taxTD"] = ((floatval($row[0][6]) + floatval($row[0][7])) - floatval($row[0][8])) * 0.01;
    $_SESSION["lessTDHeader"] = $row[0][9];
    $_SESSION["lessTD"] = ((floatval($row[0][6]) + floatval($row[0][7])) - floatval($row[0][8])) * (floatval($row[0][9]) / 100);
    $_SESSION["netPayTD"] = floatval($_SESSION["totalTD"]) - (floatval($_SESSION["taxTD"]) + floatval($_SESSION["lessTD"]));
};

function getShipmentArray()
{
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
    ORDER BY shipment.created_at ASC";

    $stmt = $pdoVessel->prepare($sql);

    $stmt->bindParam(":payroll_id", $param1, PDO::PARAM_STR);

    $param1 = $_POST["payrollId"];


    $stmt->execute();
    $row = $stmt->fetchAll();

    $tablehtml = '';
    
    for ($i = 0; $i < count($row); $i++) {
        $tablehtml = '<tr><td>' . $row[$i][0] . '</td><td>' . $row[$i][1] . '</td><td>' . $row[$i][2] . '</td><td>' . $row[$i][3] . '</td><td>' . $row[$i][4] . '</td><td>' . $row[$i][5] . '</td><td>' . $row[$i][6] . '</td></tr>' . $tablehtml;

    }

    
    $_SESSION["shipmenthtml"] = $tablehtml;
};

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    getFees();
    getShipmentArray();
}
