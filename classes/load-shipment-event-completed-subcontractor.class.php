<?php
//PART OF NEW SYSTEM

if (!isset($_SESSION)) {
    session_start();
}
require_once "../config.php";


try {
    $configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();

    if ($_SESSION["isDriver"] == "Yes") {
        $sql = "SELECT 
        shipment.shipment_number,
        shipment.date_of_delivery
        FROM shipment
        WHERE shipment.driver_id = :subcontractor_id
        AND shipment.shipment_status = 'Completed'";
    }


    if ($_SESSION["isHelper"] == "Yes") {
        $sql = "SELECT 
        shipment.shipment_number,
        shipment.date_of_delivery
        FROM shipment
        WHERE shipment.helper_id = :subcontractor_id
        AND shipment.shipment_status = 'Completed'";
    }

    if ($_SESSION["isOwner"] == "Yes") {
        $sql = "SELECT 
        shipment.shipment_number,
        shipment.date_of_delivery
        FROM shipment
        INNER JOIN vehicle
        ON shipment.plate_number = vehicle.plate_number
        INNER JOIN ownergroup
        ON vehicle.group_id = ownergroup.group_id
        WHERE ownergroup.owner_id = :subcontractor_id
        AND shipment.shipment_status = 'Completed'";
    }

    $stmt = $pdoVessel->prepare($sql);

    $stmt->bindParam(":subcontractor_id", $paramSubcontractorId, PDO::PARAM_STR);

    $paramSubcontractorId = $_SESSION["subcontractorId"];

    $stmt->execute();
    $row = $stmt->fetchAll();

    $parentArray = array();

    for ($i = 0; $i < count($row); $i++) {
        //echo $row[$i][1] . "<br>";

        $childArray = array('title' => 'Shipment #' . $row[$i][0], 'description' => "Shipment #" . $row[$i][0] . " was succesfully delivered on " . $row[$i][1], 'start' => $row[$i][1], 'color' => '#c8e6c9', 'textColor' => '#000000');

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
