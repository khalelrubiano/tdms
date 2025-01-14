<?php
//PART OF NEW SYSTEM

if (!isset($_SESSION)) {
    session_start();
}
require_once "../config.php";

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
                    $returnValue = $row[$i][2] . " " . $row[$i][3] . " " . $row[$i][4];
                }
            }
        } else {
        }

        unset($stmt);

        return $returnValue;
    }
    unset($pdoVessel);
}


try {
    /*
    $configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT
    vehicle_id,
    plate_number,
    commission_rate, 
    driver_id, 
    helper_id,
    vehicle_status 
    FROM vehicle
    WHERE vehicle_id = :vehicle_id";

    $stmt = $pdoVessel->prepare($sql);

    $stmt->bindParam(":vehicle_id", $paramVehicleId, PDO::PARAM_STR);

    $paramVehicleId = $vehicleId;

    $stmt->execute();
    $row = $stmt->fetchAll();
*/
    $driverId = $_POST["driverId"];
    $helperId = $_POST["helperId"];

    $parentArray = array();



    $childArray = array(getSubcontractorDetails($driverId), getSubcontractorDetails($helperId));

    array_push($parentArray, $childArray);


    $jsonData = json_encode($parentArray);

    echo $jsonData;
} catch (Exception $ex) {

    session_start();
    $_SESSION['prompt'] = "Something went wrong!";
    header('location: ../prompt.php');
    exit();
}
