<?php
//PART OF NEW SYSTEM

if (!isset($_SESSION)) {
    session_start();
}
require_once "../config.php";

/*
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
*/

try {

    $configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT shipment_number, date_of_delivery  
    FROM shipment 
    WHERE shipment_status = 'In-progress'";

    $stmt = $pdoVessel->prepare($sql);

    $stmt->execute();
    $row = $stmt->fetchAll();

    $parentArray = array();

    for ($i = 0; $i < count($row); $i++) {
        //echo $row[$i][1] . "<br>";

        $childArray = array('title' => 'Shipment #' . $row[$i][0], 'description' => "Shipment #" . $row[$i][0] . " is expected to be delivered on " . $row[$i][1], 'start' => $row[$i][1], 'color' => '#ffff99', 'textColor' => '#000000');

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


/*
title(shipment_number or logo?), start(date_completed), description()
*/