<?php
//PART OF NEW SYSTEM

if (!isset($_SESSION)) {
    session_start();
}
require_once "../config.php";

$tabValue = $_POST["tabValue"];
$currentPageNumber = $_POST["currentPageNumber"];
$orderBy = $_POST["orderBy"];
$startingLimitNumber = ($currentPageNumber - 1) * 4;

function getSubcontractorDetails($idVar)
{
    $configObj = new Config();

    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT 
    subcontractor_id,
    username, 
    first_name, 
    middle_name, 
    last_name
    FROM subcontractor
    WHERE company_id = :company_id";

    if ($stmt = $pdoVessel->prepare($sql)) {

        $stmt->bindParam(":company_id", $paramCompanyId, PDO::PARAM_STR);

        $paramCompanyId = $_SESSION["companyId"];

        if ($stmt->execute()) {
            $row = $stmt->fetchAll();

            for ($i = 0; $i < count($row); $i++) {

                if ($idVar == $row[$i][0]) {
                    $returnValue = $row[$i][2] . " " . $row[$i][4];
                }
            }
        } else {
        }

        unset($stmt);

        return $returnValue;
    }
    unset($pdoVessel);
}

function getMonthly($plateNumber)
{
    $configObj = new Config();

    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT 
    COUNT(shipment_number) 
    FROM shipment  
    WHERE date_of_delivery > now() - INTERVAL 30 day
    AND plate_number = :plate_number";

    if ($stmt = $pdoVessel->prepare($sql)) {

        $stmt->bindParam(":plate_number", $param1, PDO::PARAM_STR);

        $param1 = $plateNumber;

        if ($stmt->execute()) {
            $row = $stmt->fetchAll();
            $returnValue = $row[0][0];
        } else {
        }

        unset($stmt);

        return $returnValue;
    }
    unset($pdoVessel);
}

function getWeekly($plateNumber)
{
    $configObj = new Config();

    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT 
    COUNT(shipment_number) 
    FROM shipment  
    WHERE date_of_delivery > now() - INTERVAL 7 day
    AND plate_number = :plate_number";

    if ($stmt = $pdoVessel->prepare($sql)) {

        $stmt->bindParam(":plate_number", $param1, PDO::PARAM_STR);

        $param1 = $plateNumber;

        if ($stmt->execute()) {
            $row = $stmt->fetchAll();
            $returnValue = $row[0][0];
        } else {
        }

        unset($stmt);

        return $returnValue;
    }
    unset($pdoVessel);
}

function getLatest($plateNumber)
{
    $configObj = new Config();

    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT 
    date_of_delivery 
    FROM shipment  
    WHERE plate_number = :plate_number 
    ORDER BY date_of_delivery DESC";

    if ($stmt = $pdoVessel->prepare($sql)) {

        $stmt->bindParam(":plate_number", $param1, PDO::PARAM_STR);

        $param1 = $plateNumber;

        if ($stmt->execute()) {
            $row = $stmt->fetchAll();
            if (count($row) > 0) {
                $returnValue = $row[0][0];
                return $returnValue;
            } else {
                $returnValue = 'n/a';
                return $returnValue;
            }
        } else {
        }

        unset($stmt);
    }
    unset($pdoVessel);
}

try {

    $configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();

    switch ($tabValue) {
        case "All":
            $sql = "SELECT
            vehicle.vehicle_id,
            vehicle.plate_number,
            vehicle.commission_rate, 
            vehicle.driver_id, 
            vehicle.helper_id,
            vehicle.vehicle_status,
            tracking.tracking_id,
            tracking.tracking_number,
            vehicle.vehicle_type,
            vehicle.status_remark
            FROM vehicle
            INNER JOIN ownergroup
            ON vehicle.group_id = ownergroup.group_id
            INNER JOIN subcontractor
            ON subcontractor.subcontractor_id = ownergroup.owner_id
            LEFT JOIN tracking
            ON vehicle.vehicle_id = tracking.vehicle_id
            WHERE subcontractor.company_id = :company_id
            ORDER BY " . $orderBy . " LIMIT " . $startingLimitNumber . ',' . '4';
            break;
        case "Available":
            $sql = "SELECT
            vehicle.vehicle_id,
            vehicle.plate_number,
            vehicle.commission_rate, 
            vehicle.driver_id, 
            vehicle.helper_id,
            vehicle.vehicle_status,
            tracking.tracking_id,
            tracking.tracking_number,
            vehicle.vehicle_type,
            vehicle.status_remark
            FROM vehicle
            INNER JOIN ownergroup
            ON vehicle.group_id = ownergroup.group_id
            INNER JOIN subcontractor
            ON subcontractor.subcontractor_id = ownergroup.owner_id
            LEFT JOIN tracking
            ON vehicle.vehicle_id = tracking.vehicle_id
            WHERE subcontractor.company_id = :company_id
            AND vehicle.vehicle_status = 'Available'
            ORDER BY " . $orderBy . " LIMIT " . $startingLimitNumber . ',' . '4';
            break;
        case "On-Delivery":
            $sql = "SELECT
            vehicle.vehicle_id,
            vehicle.plate_number,
            vehicle.commission_rate, 
            vehicle.driver_id, 
            vehicle.helper_id,
            vehicle.vehicle_status,
            tracking.tracking_id,
            tracking.tracking_number,
            vehicle.vehicle_type,
            vehicle.status_remark
            FROM vehicle
            INNER JOIN ownergroup
            ON vehicle.group_id = ownergroup.group_id
            INNER JOIN subcontractor
            ON subcontractor.subcontractor_id = ownergroup.owner_id
            LEFT JOIN tracking
            ON vehicle.vehicle_id = tracking.vehicle_id
            WHERE subcontractor.company_id = :company_id
            AND vehicle.vehicle_status = 'On-Delivery'
            ORDER BY " . $orderBy . " LIMIT " . $startingLimitNumber . ',' . '4';
            break;
        case "Unavailable":
            $sql = "SELECT
            vehicle.vehicle_id,
            vehicle.plate_number,
            vehicle.commission_rate, 
            vehicle.driver_id, 
            vehicle.helper_id,
            vehicle.vehicle_status,
            tracking.tracking_id,
            tracking.tracking_number,
            vehicle.vehicle_type,
            vehicle.status_remark
            FROM vehicle
            INNER JOIN ownergroup
            ON vehicle.group_id = ownergroup.group_id
            INNER JOIN subcontractor
            ON subcontractor.subcontractor_id = ownergroup.owner_id
            LEFT JOIN tracking
            ON vehicle.vehicle_id = tracking.vehicle_id
            WHERE subcontractor.company_id = :company_id
            AND vehicle.vehicle_status = 'Unavailable'
            ORDER BY " . $orderBy . " LIMIT " . $startingLimitNumber . ',' . '4';
            break;
    }
    /*
    $sql = "SELECT
    vehicle_id,
    plate_number,
    commission_rate, 
    driver_id, 
    helper_id,
    vehicle_status 
    FROM vehicle
    INNER JOIN ownergroup
    ON vehicle.group_id = ownergroup.group_id
    INNER JOIN subcontractor
    on subcontractor.subcontractor_id = ownergroup.owner_id
    WHERE subcontractor.company_id = :company_id";
*/
    $stmt = $pdoVessel->prepare($sql);

    $stmt->bindParam(":company_id", $paramCompanyId, PDO::PARAM_STR);

    $paramCompanyId = $_SESSION["companyId"];

    $stmt->execute();
    $row = $stmt->fetchAll();

    $parentArray = array();

    for ($i = 0; $i < count($row); $i++) {
        //echo $row[$i][1] . "<br>";

        $childArray = array($row[$i][0], $row[$i][1], $row[$i][2], $row[$i][5], getSubcontractorDetails($row[$i][3]), getSubcontractorDetails($row[$i][4]), $row[$i][6], $row[$i][7], $row[$i][8], $row[$i][9], getWeekly($row[$i][1]), getMonthly($row[$i][1]), getLatest($row[$i][1]));

        array_push($parentArray, $childArray);
    }

    $jsonData = json_encode($parentArray);

    echo $jsonData;
} catch (Exception $ex) {

    session_start();
    $_SESSION['prompt'] = "Something went wrong!";
    header('location: ../prompt.php');
    exit();
}
