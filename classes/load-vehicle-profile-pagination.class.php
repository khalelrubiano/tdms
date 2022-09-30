<?php
//PART OF NEW SYSTEM

if (!isset($_SESSION)) {
    session_start();
}
require_once "../config.php";


$currentPageNumber = $_POST["currentPageNumber"];

$startingLimitNumber = ($currentPageNumber - 1) * 5;

function getBilling($shipmentId)
{
    $configObj = new Config();

    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT 
    billing_id 
    FROM billedshipment 
    WHERE shipment_id = :shipment_id";

    if ($stmt = $pdoVessel->prepare($sql)) {

        $stmt->bindParam(":shipment_id", $param1, PDO::PARAM_STR);

        $param1 = $shipmentId;

        if ($stmt->execute()) {
            $row = $stmt->fetchAll();
            if (count($row) > 0) {
                $returnValue = "true";
            } else {
                $returnValue = "false";
            }
        } else {
        }

        unset($stmt);

        return $returnValue;
    }
    unset($pdoVessel);
}

function getPayroll($shipmentId)
{
    $configObj = new Config();

    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT 
    payroll_id 
    FROM payrollshipment 
    WHERE shipment_id = :shipment_id";

    if ($stmt = $pdoVessel->prepare($sql)) {

        $stmt->bindParam(":shipment_id", $param1, PDO::PARAM_STR);

        $param1 = $shipmentId;

        if ($stmt->execute()) {
            $row = $stmt->fetchAll();
            if (count($row) > 0) {
                $returnValue = "true";
            } else {
                $returnValue = "false";
            }
        } else {
        }

        unset($stmt);

        return $returnValue;
    }
    unset($pdoVessel);
}

try {
    $configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT
    shipment_id,
    shipment_number,
    shipment_status
    FROM shipment
    WHERE plate_number = :plate_number";

    $stmt = $pdoVessel->prepare($sql);

    $stmt->bindParam(":plate_number", $param1, PDO::PARAM_STR);
    $param1 = $_SESSION["plateNumberVehicle"];

    $stmt->execute();
    $row = $stmt->fetchAll();
    $parentArray = array();

    for ($i = 0; $i < count($row); $i++) {
        //echo $row[$i][1] . "<br>";

        $childArray = array($row[$i][1], $row[$i][2], getBilling($row[$i][0]), getPayroll($row[$i][0]));

        array_push($parentArray, $childArray);
    }

    $jsonData = json_encode($parentArray);

    echo $jsonData;
} catch (Exception $ex) {
    echo $ex;
    /*
    session_start();
    $_SESSION['prompt'] = "Something went wrong!";
    header('location: ../prompt.php');
    exit();
    */
}
