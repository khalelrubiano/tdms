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
        *
        FROM shipment
        WHERE company_id = :company_id
        AND driver_id = :subcontractor_id";
    }
    if ($_SESSION["isHelper"] == "Yes") {
        $sql = "SELECT 
        *
        FROM shipment
        WHERE company_id = :company_id
        AND helper_id = :subcontractor_id";
    }
    
    if ($_SESSION["isOwner"] == "Yes") {
        $sql = "SELECT 
        *
        FROM shipment
        INNER JOIN vehicle
        ON shipment.plate_number = vehicle.plate_number
        INNER JOIN ownergroup
        ON vehicle.group_id = ownergroup.group_id
        WHERE shipment.company_id = :company_id
        AND ownergroup.owner_id = :subcontractor_id";
    }

    $stmt = $pdoVessel->prepare($sql);

    $stmt->bindParam(":company_id", $paramCompanyId, PDO::PARAM_STR);
    $stmt->bindParam(":subcontractor_id", $paramSubcontractorId, PDO::PARAM_STR);

    $paramCompanyId = $_SESSION["companyId"];
    $paramSubcontractorId = $_SESSION["subcontractorId"];

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
