<?php
if ( !isset($_SESSION) ) {
    session_start();
}
require_once "../config.php";


try {
	$configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT trackingdata.longitude, trackingdata.latitude, trackingdata.created_at 
    FROM trackingdata
    INNER JOIN tracking
    ON trackingdata.tracking_id = tracking.tracking_id 
    INNER JOIN vehicle 
    ON tracking.vehicle_id = vehicle.vehicle_id 
    WHERE vehicle.plate_number = :vehicle_id AND trackingdata.shipment_id = :shipment_id ORDER BY created_at ASC";

    $stmt = $pdoVessel->prepare($sql);

    $stmt->bindParam(":vehicle_id", $param1, PDO::PARAM_STR);
    $stmt->bindParam(":shipment_id", $param2, PDO::PARAM_STR);

    $param1 = $_POST["vehicleId"];
    $param2 = $_POST["shipmentId"];

    $stmt->execute();
    $row = $stmt->fetchAll();
    $json = json_encode($row);

    echo $json;

} catch (Exception $ex) {
    session_start();
    $_SESSION['prompt'] = "Something went wrong!";
    header('location: ../modal-prompt.php');
    exit();
}


  