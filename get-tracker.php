<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once "config.php";

function getTrackingId()
{
    $configObj = new Config();

    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT tracking_id
    FROM tracking
    WHERE tracking_number = :tracking_number";

    if ($stmt = $pdoVessel->prepare($sql)) {

        $stmt->bindParam(":tracking_number", $param1, PDO::PARAM_STR);

        $param1 = $_GET['trackerId'];

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

function getShipmentId()
{
    $configObj = new Config();

    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT shipment.shipment_id
    FROM tracking
    INNER JOIN vehicle
    ON tracking.vehicle_id = vehicle.vehicle_id
    INNER JOIN shipment
    ON vehicle.plate_number = shipment.plate_number
    WHERE tracking.tracking_number = :tracking_number
    AND shipment.shipment_status = 'In-progress'";

    if ($stmt = $pdoVessel->prepare($sql)) {

        $stmt->bindParam(":tracking_number", $param1, PDO::PARAM_STR);

        $param1 = $_GET['trackerId'];

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

try {
    /*
    $trackerId = $_GET['trackerId'];
    $longitude = $_GET['longitude'];
    $latitude = $_GET['latitude'];
*/
    $configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();

    $sql = "INSERT INTO 
    trackingdata 
    (tracking_id,  
    shipment_id, 
    longitude, 
    latitude) 
    VALUES 
    (:tracking_id,  
    :shipment_id, 
    :longitude, 
    :latitude)";

    $stmt = $pdoVessel->prepare($sql);

    $stmt->bindParam(":tracking_id", $param1, PDO::PARAM_STR);
    $stmt->bindParam(":shipment_id", $param2, PDO::PARAM_STR);
    $stmt->bindParam(":longitude", $param3, PDO::PARAM_STR);
    $stmt->bindParam(":latitude", $param4, PDO::PARAM_STR);

    $param1 = getTrackingId();
    $param2 = getShipmentId();
    $param3 = $_GET['longitude'];
    $param4 = $_GET['latitude'];


    $stmt->execute();
    //$row = $stmt->fetchAll();
    //$json = json_encode($row);

    echo 'SUCCESS';
} catch (Exception $ex) {
    //session_start();
    //$_SESSION['prompt'] = "Something went wrong!";
    //header('location: ../modal-prompt.php');
    //exit();
}
