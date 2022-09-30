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

    $var1 = $row[0][0] . ' ' . $row[0][1] . ' ' . $row[0][2];
    $var2 = $row[0][3];
    $var3 = $row[0][4];
    $var4 = $row[0][5];
    $var5 = $row[0][6];
    $var6 = $row[0][7];
    $var7 = $row[0][8];
    $var8 = (floatval($row[0][6]) + floatval($row[0][7])) - floatval($row[0][8]);
    $var9 = ((floatval($row[0][6]) + floatval($row[0][7])) - floatval($row[0][8])) * 0.01;
    $var10 = $row[0][9];
    $var11 = ((floatval($row[0][6]) + floatval($row[0][7])) - floatval($row[0][8])) * (floatval($row[0][9]) / 100);
    $var12 = (floatval($var8) + floatval($var10)) - floatval($var7);

    return array($var1, $var2, $var3, $var4, $var5, $var6, $var7, $var8, $var9, $var10, $var11, $var12);
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


    $var13 = $tablehtml;

    return $var13;
};


/*
for ($x = 0; $x < count($parentarray); $x++) {
    echo $parentarray[$x] . '<br>';
}
*/

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $parentarray = getFees();
    $singleVar = getShipmentArray();

    array_push($parentarray, $singleVar);

    $jsonData = json_encode($parentarray);

    echo $jsonData;
}
