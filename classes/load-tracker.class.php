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
    WHERE vehicle_id = :vehicle_id ORDER BY created_at ASC";

    $stmt = $pdoVessel->prepare($sql);

    $stmt->bindParam(":vehicle_id", $param1, PDO::PARAM_STR);
    $param1 = $_POST["vehicleId"];
    
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


  