
<?php
//PART OF NEW SYSTEM
if (!isset($_SESSION)) {
    session_start();
}
require_once "../config.php";



try {
    $configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT 
    subcontractor.subcontractor_id,
    subcontractor.username, 
    subcontractor.first_name, 
    subcontractor.middle_name, 
    subcontractor.last_name
    FROM subcontractor
    LEFT JOIN vehicle
    ON subcontractor.subcontractor_id = vehicle.driver_id
    OR subcontractor.subcontractor_id = vehicle.helper_id
    LEFT JOIN ownergroup
    ON subcontractor.subcontractor_id = ownergroup.owner_id
    WHERE vehicle.driver_id IS NULL
    AND vehicle.helper_id IS NULL
    AND ownergroup.owner_id IS NULL
    AND subcontractor.company_id = :company_id";

    $stmt = $pdoVessel->prepare($sql);

    $stmt->bindParam(":company_id", $paramCompanyId, PDO::PARAM_STR);

    $paramCompanyId = $_SESSION["companyId"];

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
